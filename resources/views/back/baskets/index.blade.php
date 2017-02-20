@extends('back.template.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Paniers
                <small>Vue d'ensemble</small>
                <a class="btn btn-md btn-primary pull-right" href="{{ route('baskets.create') }}">
                    <i class="fa fa-plus fa-fw"></i> Ajouter un panier
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
                    <th></th>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Date d'ajout</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                @forelse($baskets as $b)

                    <tr>
                        <td style="width: 89px;">
                            @if(is_null($b->picture))

                                <div style="height: 50px;width: 89px; background: lightgrey; font-size:9px; color: white;display: inline-flex; align-items: center;" class="text-center">
                                    <i class="fa fa-image fa-3x fa-fw" style="margin-left:25px"></i>
                                </div>
                            @else
                                <img src="{{ asset($b->getThumb()) }}" alt="{{ $b->name }}" height="50" />
                            @endif
                        </td>
                        <td class="vert-align">
                            {{ $b->id }}
                        </td>
                        <td class="vert-align">{{ $b->name }}</td>
                        <td class="vert-align">
                            {{ $b->price }}<i class="fa fa-euro"></i>
                        </td>
                        <td class="vert-align">{{ $b->created_at->format('d/m/Y à H:i') }}</td>
                        <td class="vert-align">
                            <span class="text-{{ $b->status == 1 ? 'success' : 'danger' }}">{{ $b->status == 1 ? 'Actif' : 'Inactif' }}</span>
                        </td>
                        <td class="vert-align">
                            <a href="{{ route('baskets.edit', $b->id) }}" class="btn btn-warning btn-xs pull-right">
                                Modifier
                            </a>
                        </td>
                        <td class="vert-align">
                            {{ Form::open(['route' => ['baskets.destroy', $b->id], 'method' => 'delete']) }}
                            <button class="btn btn-danger btn-xs pull-right" type="submit">
                                Supprimer
                            </button>
                            {{ Form::close() }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Aucun panier enregistré...</td>
                    </tr>
                @endforelse
            </table>
            <div class="text-center">
                {{ $baskets->links() }}
            </div>
        </div>
    </div>
@stop
