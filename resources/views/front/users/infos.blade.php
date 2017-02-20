@extends('front.template.template')

@section('title')
    {{ Auth::user()->getFullName() }}
@stop

@section('content')
    <section class="page-title" style="background-image:url({{ asset('front/images/background/bg-page-title-1.jpg') }});">
        <div class="auto-container">
            <h1>Informations</h1>
        </div>
    </section>

    <div class="checkout-page">
        <div class="auto-container">
            @if(session()->has('flash'))
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="alert alert-{{ session('flash')['code'] == 1 ? 'success' : 'danger' }} alert-with-icon clearfix">
                            <div class="col-xs-1 text-right">
                                <i class="fa fa-{{ session('flash')['code'] == 1 ? 'check' : 'times' }} fa-2x fa-fw"></i>
                            </div>
                            <div class="col-xs-11">
                                <strong>{{ session('flash')['code'] == 1 ? 'Succès' : 'Erreur' }}:</strong>
                                {!! session('flash')['message'] !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row clearfix">
                <div class="col-xs-12">
                    <div class="billing-details">
                        <div class="shop-form">
                            {{ Form::open(['route' => 'post.infos', 'method' => 'post']) }}
                            <div class="sec-title-one">
                                <h2>Détails</h2>
                            </div>

                            <div class="row clearfix">
                                <div class="form-group {{ $errors->has('firstname') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Prénom <sup>*</sup></div>
                                    {{ Form::text('firstname', Auth::user()->firstname) }}
                                    <small class="text-danger pull-right">{{ $errors->first('firstname') }}</small>
                                </div>

                                <div class="form-group {{ $errors->has('lastname') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Nom <sup>*</sup></div>
                                    {{ Form::text('lastname', Auth::user()->lastname) }}
                                    <small class="text-danger pull-right">{{ $errors->first('lastname') }}</small>
                                </div>

                                <div class="form-group {{ $errors->has('company') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Entrerpise</div>
                                    {{ Form::text('company', Auth::user()->informations->company ?? null) }}
                                    <small class="text-danger pull-right">{{ $errors->first('company') }}</small>
                                </div>

                                <div class="form-group {{ $errors->has('email') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Adresse Email <sup>*</sup></div>
                                    {{ Form::email('email', Auth::user()->email) }}
                                    <small class="text-danger pull-right">{{ $errors->first('email') }}</small>
                                </div>

                                <div class="form-group {{ $errors->has('password') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Modifier Mot de passe</div>
                                    {{ Form::password('password') }}
                                    <small class="text-danger pull-right">{{ $errors->first('password') }}</small>
                                </div>

                                <div class="form-group {{ $errors->has('password_conf') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Confirmer mot de passe</div>
                                    {{ Form::password('password_conf') }}
                                    <small class="text-danger pull-right">{{ $errors->first('password_conf') }}</small>
                                </div>

                            </div>


                            <div class="sec-title-one">
                                <h2>Coordonnées</h2>
                            </div>
                            <div class="row clearfix">
                                <div class="form-group {{ $errors->has('address') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Adresse <sup>*</sup></div>
                                    {{ Form::text('address', Auth::user()->informations->address ?? null) }}
                                    <small class="text-danger pull-right">{{ $errors->first('address') }}</small>
                                </div>

                                <div class="form-group {{ $errors->has('address_comp') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Complément d'adresse</div>
                                    {{ Form::text('address_comp', Auth::user()->informations->address_comp ?? null) }}
                                    <small class="text-danger pull-right">{{ $errors->first('address_comp') }}</small>
                                </div>

                                <div class="form-group {{ $errors->has('zipcode') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Code postal <sup>*</sup></div>
                                    {{ Form::text('zipcode', Auth::user()->informations->zipcode ?? null) }}
                                    <small class="text-danger pull-right">{{ $errors->first('zipcode') }}</small>
                                </div>

                                <div class="form-group {{ $errors->has('city') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Ville <sup>*</sup></div>
                                    {{ Form::text('city', Auth::user()->informations->city ?? null) }}
                                    <small class="text-danger pull-right">{{ $errors->first('city') }}</small>
                                </div>

                                <div class="form-group {{ $errors->has('country') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Country <sup>*</sup></div>
                                    {{ Form::select('country', $countries , Auth::user()->informations->country ?? null) }}
                                    <small class="text-danger pull-right">{{ $errors->first('country') }}</small>
                                </div>

                                <div class="form-group {{ $errors->has('phone') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Téléphone <sup>*</sup></div>
                                    {{ Form::text('phone', Auth::user()->informations->phone ?? null) }}
                                    <small class="text-danger pull-right">{{ $errors->first('phone') }}</small>
                                </div>

                                <div class="form-group {{ $errors->has('lastname') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">
                                        {{ Form::checkbox('billing', null,  Auth::user()->informations->billing ?? false) }} &nbsp;
                                        Adresse de facturation différente ?
                                    </div>

                                </div>
                            </div>

                            <div class="sec-title-one billing">
                                <h2>Adresse de facturation</h2>
                            </div>

                            <div class="row clearfix billing">
                                <div class="form-group {{ $errors->has('lastname') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Nom</div>
                                    {{ Form::text('billing_lastname', Auth::user()->lastname) }}
                                    <small class="text-danger pull-right">{{ $errors->first('lastname') }}</small>
                                </div>

                                <div class="form-group {{ $errors->has('firstname') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Prénom</div>
                                    {{ Form::text('billing_firstname', Auth::user()->firstname) }}
                                    <small class="text-danger pull-right">{{ $errors->first('firstname') }}</small>
                                </div>

                                <div class="form-group {{ $errors->has('address') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Adresse</div>
                                    {{ Form::text('billing_address', Auth::user()->informations->address ?? null) }}
                                    <small class="text-danger pull-right">{{ $errors->first('address') }}</small>
                                </div>

                                <div class="form-group {{ $errors->has('address_comp') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Complément d'adresse</div>
                                    {{ Form::text('billing_address_comp', Auth::user()->informations->address_comp ?? null) }}
                                    <small class="text-danger pull-right">{{ $errors->first('address_comp') }}</small>
                                </div>

                                <div class="form-group {{ $errors->has('zipcode') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Code postal</div>
                                    {{ Form::text('billing_zipcode', Auth::user()->informations->zipcode ?? null) }}
                                    <small class="text-danger pull-right">{{ $errors->first('zipcode') }}</small>
                                </div>

                                <div class="form-group {{ $errors->has('city') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Ville</div>
                                    {{ Form::text('billing_city', Auth::user()->informations->city ?? null) }}
                                    <small class="text-danger pull-right">{{ $errors->first('city') }}</small>
                                </div>

                                <div class="form-group {{ $errors->has('country') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Country</div>
                                    {{ Form::select('billing_country', $countries , Auth::user()->informations->country ?? null) }}
                                    <small class="text-danger pull-right">{{ $errors->first('country') }}</small>
                                </div>

                                <div class="form-group {{ $errors->has('phone') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Téléphone</div>
                                    {{ Form::text('billing_phone', Auth::user()->informations->phone ?? null) }}
                                    <small class="text-danger pull-right">{{ $errors->first('phone') }}</small>
                                </div>
                            </div>

                            <button type="submit" class="theme-btn btn-style-two btn-block">Sauvegarder</button>

                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            if(!$('input[name=billing]').is(':checked')) {
                $('.billing').hide();
            }


             $(document).on('change', 'input[name=billing]', function(){
                 if($(this).is(':checked')) {
                     $('.billing').show();
                 } else {
                     $('.billing').hide();
                 }
             })
        });
    </script>
@stop