@extends('back.template.layout')

@section('content')
    <div class="container">
        <div class="col-xs-12 col-sm-6 col-sm-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4>Olympic Drive - Login Administrateur</h4>
                </div>
                <div class="panel-body">
                    @if(session()->has('flash'))
                        <div class="row" style="">
                            <div class="col-lg-12">
                                <div class="alert alert-danger alert-with-icon">
                                    <div class="col-xs-1"><i class="fa fa-times fa-2x fa-fw"></i></div>
                                    <div class="col-xs-11">
                                        <strong>Erreur:</strong>
                                        {{ session('flash')['message'] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{ Form::open(['route' => 'login', 'method' => 'post']) }}
                        <div class="form-group">
                            {{ Form::label('email', 'Adresse Email') }}
                            {{ Form::email('email', null, ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('password', 'Mot de passe') }}
                            {{ Form::password('password', ['class' => 'form-control', 'id' => 'password']) }}
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">
                            Se connecter
                        </button>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@stop