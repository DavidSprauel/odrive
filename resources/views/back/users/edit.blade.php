@extends('back.template.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Utilisateurs
                <small>Modifier {{ $user->firstname }}</small>
                <a class="btn btn-md btn-primary pull-right" href="{{ route('users.index') }}">
                    <i class="fa fa-fw fa-arrow-circle-left"></i> Retour
                </a>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-sm-offset-3">
            @if(session()->has('flash'))
                <div class="row" style="">
                    <div class="col-lg-12">
                        <div class="alert alert-danger alert-with-icon">
                            <div class="col-xs-1 text-right"><i class="fa fa-times fa-2x fa-fw"></i></div>
                            <div class="col-xs-11">
                                <strong>Erreur:</strong>
                                {{ session('flash')['message'] }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{ Form::open(['route' => ['users.update', $user->id], 'method' => 'put']) }}

            <div class="form-group {{ $errors->has('lastname') ? 'has-error has-feedback' : '' }}">
                {{ Form::label('lastname', 'Nom', ['class' => 'control-label']) }}
                {{ Form::text('lastname', $user->lastname, ['class' => 'form-control']) }}
                <small class="text-danger pull-right">{{ $errors->first('lastname') }}</small>
            </div>

            <div class="form-group {{ $errors->has('firstname') ? 'has-error has-feedback' : '' }}">
                {{ Form::label('firstname', 'Prénom', ['class' => 'control-label']) }}
                {{ Form::text('firstname', $user->firstname, ['class' => 'form-control']) }}
                <small class="text-danger pull-right">{{ $errors->first('firstname') }}</small>
            </div>

            <div class="form-group {{ $errors->has('email') ? 'has-error has-feedback' : '' }}">
                {{ Form::label('email', 'Adresse Email', ['class' => 'control-label']) }}
                {{ Form::email('email', $user->email, ['class' => 'form-control']) }}
                <small class="text-danger pull-right">{{ $errors->first('email') }}</small>
            </div>

            <div class="form-group {{ $errors->has('password') ? 'has-error has-feedback' : '' }}">
                {{ Form::label('password', 'Mot de passe', ['class' => 'control-label']) }}
                {{ Form::password('password', ['class' => 'form-control', 'id' => 'password']) }}
                <small class="text-danger pull-right">{{ $errors->first('password') }}</small>
            </div>

            <div class="form-group {{ $errors->has('password') ? 'has-error has-feedback' : '' }}">
                {{ Form::label('password_conf', 'Confirmer mot de passe', ['class' => 'control-label']) }}
                {{ Form::password('password_conf', ['class' => 'form-control', 'id' => 'password_conf']) }}
                <small class="text-danger pull-right">{{ $errors->first('password') }}</small>
            </div>

            <div class="form-group {{ $errors->has('role') ? 'has-error has-feedback' : '' }}">
                {{ Form::label('role', 'Rôle', ['class' => 'control-label']) }}
                {{ Form::select('role', $roles, $user->role_id, ['class' => 'form-control', 'id' => 'role']) }}
                <small class="text-danger pull-right">{{ $errors->first('role') }}</small>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-info alert-with-icon">
                        <div class="col-xs-2">
                            <i class="fa fa-info-circle fa-5x pull-right"></i>
                        </div>
                        <div class="col-xs-10">
                            <strong>Administrateur</strong> :
                            <p>Autoriser à la gestion maximale du site, utlisateurs, commandes, paniers</p>

                            <strong>Editeur</strong> :
                            <p>Autoriser à la gestion des commandes, paniers mais pas des utiliateurs</p>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block" style="margin-top: 30px;">
                Sauvegarder
            </button>
            {{ Form::close() }}
        </div>
    </div>
@stop