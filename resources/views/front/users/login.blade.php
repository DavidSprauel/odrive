@extends('front.template.template')

@section('title')
    M'inscrire
@stop

@section('content')
    <section class="page-title" style="background-image:url({{ asset('front/images/background/bg-page-title-1.jpg') }});">
        <div class="auto-container">
            <h1>Inscription</h1>
        </div>
    </section>

    <div class="checkout-page">
        <div class="auto-container">

            <div class="row clearfix">
                <div class="col-xs-12">
                    @if(session()->has('flash'))
                        <ul class="alert-success alert">
                            <li>{{ session('flash')['message'] }}</li>
                        </ul>
                    @endif

                    <div class="billing-details">
                        <div class="shop-form">
                            {{ Form::open(['route' => 'front.post.login', 'method' => 'post']) }}
                                <div class="default-title"><h2>Connexion</h2></div>

                                <div class="row clearfix">
                                    <div class="form-group {{ $errors->has('email') ? 'has-error has-feedback' : '' }} col-sm-6 col-xs-12 col-sm-offset-3">
                                        <div class="field-label">Addresse Email</div>
                                        {{ Form::email('email', null) }}
                                        <small class="text-danger pull-right">{{ $errors->first('email') }}</small>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="form-group {{ $errors->has('password') ? 'has-error has-feedback' : '' }} col-sm-6 col-xs-12 col-sm-offset-3">
                                        <div class="field-label">Mot de passe <sup>*</sup></div>
                                        {{ Form::password('password', null) }}
                                        <small class="text-danger pull-right">{{ $errors->first('password') }}</small>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-sm-6 col-xs-12 col-sm-offset-3">
                                        <button type="submit" class="theme-btn btn-style-two btn-block">
                                            Me Connecter
                                        </button>
                                    </div>
                                </div>

                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop