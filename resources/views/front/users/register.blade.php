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
                    <!--Default Links-->
                    <ul class="default-links">
                        <li>Vous avez déjà un compte ? <a href="{{ route('front.login') }}">Cliquez ici pour vous connecter</a></li>
                    </ul>

                    <div class="billing-details">
                        <div class="shop-form">
                            {{ Form::open(['route' => 'post.register', 'method' => 'post']) }}
                            <div class="default-title"><h2>Détails</h2></div>

                            <div class="row clearfix">
                                <div class="form-group {{ $errors->has('lastname') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Nom <sup>*</sup></div>
                                    {{ Form::text('lastname', null) }}
                                    <small class="text-danger pull-right">{{ $errors->first('lastname') }}</small>
                                </div>

                                <div class="form-group {{ $errors->has('firstname') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Prénom <sup>*</sup></div>
                                    {{ Form::text('firstname', null) }}
                                    <small class="text-danger pull-right">{{ $errors->first('firstname') }}</small>
                                </div>
                                
                                <div class="form-group {{ $errors->has('company') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Entrerpise</div>
                                    {{ Form::text('company', null) }}
                                    <small class="text-danger pull-right">{{ $errors->first('company') }}</small>
                                </div>
                                
                                <div class="form-group {{ $errors->has('email') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Adresse Email <sup>*</sup></div>
                                    {{ Form::email('email', null) }}
                                    <small class="text-danger pull-right">{{ $errors->first('email') }}</small>
                                </div>
                                
                                <div class="form-group {{ $errors->has('phone') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Téléphone <sup>*</sup></div>
                                    {{ Form::text('phone', null) }}
                                    <small class="text-danger pull-right">{{ $errors->first('phone') }}</small>
                                </div>
                                
                                <div class="form-group {{ $errors->has('address') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Adresse <sup>*</sup></div>
                                    {{ Form::text('address', null) }}
                                    <small class="text-danger pull-right">{{ $errors->first('address') }}</small>
                                </div>

                                <div class="form-group {{ $errors->has('address_comp') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Complément d'adresse</div>
                                    {{ Form::text('address_comp', null) }}
                                    <small class="text-danger pull-right">{{ $errors->first('address_comp') }}</small>
                                </div>

                                <div class="form-group {{ $errors->has('country') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Country <sup>*</sup></div>
                                    {{ Form::select('country', $countries ,null) }}
                                    <small class="text-danger pull-right">{{ $errors->first('country') }}</small>
                                </div>
                                
                                <div class="form-group {{ $errors->has('zipcode') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Code postal <sup>*</sup></div>
                                    {{ Form::text('zipcode', null) }}
                                    <small class="text-danger pull-right">{{ $errors->first('zipcode') }}</small>
                                </div>

                                <div class="form-group {{ $errors->has('city') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Ville <sup>*</sup></div>
                                    {{ Form::text('city', null) }}
                                    <small class="text-danger pull-right">{{ $errors->first('city') }}</small>
                                </div>

                                <div class="form-group {{ $errors->has('password') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Mot de passe <sup>*</sup></div>
                                    {{ Form::password('password') }}
                                    <small class="text-danger pull-right">{{ $errors->first('password') }}</small>
                                </div>

                                <div class="form-group {{ $errors->has('password_conf') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Confirmer mot de passe <sup>*</sup></div>
                                    {{ Form::password('password_conf') }}
                                    <small class="text-danger pull-right">{{ $errors->first('password_conf') }}</small>
                                </div>
                            </div>

                            <button type="submit" class="theme-btn btn-style-two btn-block">M'inscrire</button>

                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop