@extends('back.template.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Utilisateurs
                <small>Vue d'ensemble</small>
                <a class="btn btn-md btn-primary pull-right" href="{{ route('users.create') }}">
                    <i class="fa fa-plus fa-fw"></i> Ajouter un utilisateur
                </a>
            </h1>
        </div>
    </div>
    @if(session()->has('flash'))
        <div class="row" style="">
            <div class="col-lg-12">
                <div class="alert alert-{{ session('flash')['code'] == 1 ? 'success' : 'danger' }} alert-with-icon">
                    <div class="col-xs-1 text-right"><i
                                class="fa fa-{{ session('flash')['code'] == 1 ? 'check' : 'times' }} fa-2x fa-fw"></i>
                    </div>
                    <div class="col-xs-11">
                        <strong>{{ session('flash')['code'] == 1 ? 'Succès' : 'Erreur' }}:</strong>
                        {{ session('flash')['message'] }}
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>Utilisateur</th>
                    <th>Rôle</th>
                    <th>Email</th>
                    <th>Date d'ajout</th>
                    <th>Date d'edition</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                @forelse($users as $u)
                    <tr>
                        <td class="vert-align">{{ $u->getFullName() }}</td>
                        <td class="vert-align">
                            @if($u->role_id == 1)
                                <strong class="text-success">{{ $u->getRoleText() }}</strong>
                            @else
                                {{ $u->getRoleText() }}
                            @endif
                        </td>
                        <td class="vert-align">{{ $u->email }}</td>
                        <td class="vert-align">le {{ $u->created_at->format('d/m/Y à H:i') }}</td>
                        <td class="vert-align">le {{ $u->updated_at->format('d/m/Y à H:i') }}</td>
                        <td class="vert-align button">
                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('users.edit', ['id' => $u->id]) }}" class="btn btn-warning btn-xs">
                                    Modifier
                                </a>
                            @endif
                        </td>
                        <td class="vert-align button">

                            @if(Auth::user()->isAdmin())
                                <input type="checkbox"
                                       class="activateAccount"
                                       data-id="{{ $u->id }}"
                                       {{ $u->active ? 'checked' : '' }}
                                       data-toggle="toggle"
                                       data-on="Actif"
                                       data-off="Inactif"
                                       data-onstyle="success"
                                       data-offstyle="danger"
                                       data-size="mini"
                                       />
                            @else
                                {{ $u->getActiveText() }}
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Aucun utilisateur enregistré...</td>
                    </tr>
                @endforelse
            </table>
            <div class="text-center">
                {{ $users->links() }}
            </div>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-lg-6">
            <div class="alert alert-info alert-with-icon">
                <div class="col-xs-2">
                    <i class="fa fa-info-circle fa-5x"></i>
                </div>
                <div class="col-xs-10">
                    <strong>Administrateur</strong> :
                    <p>Autoriser à la gestion maximale du site, utlisateurs, commandes, paniers</p>

                    <strong>Editeur</strong> :
                    <p>Autoriser à la gestion des commandes, paniers mais pas des utilisateurs</p>

                    <strong>Client</strong> :
                    <p>N'ont pas accés à cette partie du site, seulement leurs commandes passées et en cours.</p>
                </div>
            </div>
    </div>

        <div class="col-lg-6">
            <div class="alert alert-warning alert-with-icon">
                <div class="col-xs-2">
                    <i class="fa fa-warning fa-5x"></i>
                </div>
                <div class="col-xs-10">
                    <ul>
                        <li>Si un utilisateur est inactif, il ne pourra plus accéder à la plateforme.</li>
                        <li>D'autres comptes utilisateurs existent, mais ne sont pas encore mis en place</li>
                        <li>Si vous avez besoin de fonctionnalitées en plus, veuillez contacter votre webmaster</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){

            $('.activateAccount').on('change', function(){
                var checkbox = $(this);
                var id = checkbox.data('id');
                var isChecked = checkbox.prop('checked');

                if(isChecked) {
                    isChecked = 1;
                } else {
                    isChecked = 0;
                }

                checkbox.prop('disabled', true);

                $.ajax({
                    url: "/admin/users/" + id,
                    method: 'DELETE',
                    data: { active: isChecked },
                    error: function(){
                        swal('Erreur', 'Une erreur de comminucation est aparu, veuillez contacter votre webmaster', 'error');
                    },
                    success: function(data) {
                        if(data.code) {
                            swal('Succès', data.message, 'success');
                        } else {
                            swal('Erreur', data.message, 'error');
                        }
                    },
                    complete: function() {
                        checkbox.prop('disabled', false);
                    }
                });
            });

        });
    </script>
@stop

