@extends('front.template.template')

@section('title')
    Valider la commande
@stop

@section('content')
    <section class="page-title"
             style="background-image:url({{ asset('front/images/background/bg-page-title-1.jpg') }});">
        <div class="auto-container">
            <h1>Validation de votre commande</h1>
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
                {{ Form::open(['route' => 'post.checkout', 'method' => 'post']) }}
                    <div class="col-md-8 col-sm-12 col-xs-12">
                        <div class="billing-details">
                            <div class="shop-form">
                                @if(!Auth::check())
                                    <ul class="default-links">
                                        <li>
                                            Déjà client ? <a href="{{ route('front.login') }}">Cliquer ici pour vous
                                                connecter</a>
                                        </li>
                                    </ul>
                                @endif
                                <div class="default-title"><h2>Détails de livraison</h2></div>

                                <div class="row clearfix">
                                    <div class="form-group {{ $errors->has('firstname') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12">
                                        <div class="field-label">Prénom <sup>*</sup></div>
                                        {{ Form::text('firstname', Auth::user()->firstname ?? null) }}
                                        <small class="text-danger pull-right">{{ $errors->first('firstname') }}</small>
                                    </div>

                                    <div class="form-group {{ $errors->has('lastname') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12">
                                        <div class="field-label">Nom <sup>*</sup></div>
                                        {{ Form::text('lastname', Auth::user()->lastname ?? null) }}
                                        <small class="text-danger pull-right">{{ $errors->first('lastname') }}</small>
                                    </div>

                                    <div class="form-group {{ $errors->has('company') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12">
                                        <div class="field-label">Entrerpise</div>
                                        {{ Form::text('company', Auth::user()->informations->company ?? null) }}
                                        <small class="text-danger pull-right">{{ $errors->first('company') }}</small>
                                    </div>

                                    <div class="form-group {{ $errors->has('email') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12">
                                        <div class="field-label">Adresse Email <sup>*</sup></div>
                                        {{ Form::email('email', Auth::user()->email ?? null) }}
                                        <small class="text-danger pull-right">{{ $errors->first('email') }}</small>
                                    </div>

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
                                            {{ Form::checkbox('billing', null,  Auth::user()->informations->billing ?? false) }}
                                            &nbsp;
                                            Adresse de facturation différente ?
                                        </div>
                                    </div>

                                    @if(!Auth::check())
                                        <div class="form-group {{ $errors->has('lastname') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12">
                                            <div class="field-label">
                                                {{ Form::checkbox('account', null) }}
                                                &nbsp;
                                                Créer un compte ?
                                            </div>
                                        </div>
                                    @endif

                                    <div class="form-group {{ $errors->has('password') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12 password-input">
                                        <div class="field-label">Mot de passe</div>
                                        {{ Form::password('password') }}
                                        <small class="text-danger pull-right">{{ $errors->first('password') }}</small>
                                    </div>

                                    <div class="form-group {{ $errors->has('password_conf') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12 password-input-conf">
                                        <div class="field-label">mot de passe</div>
                                        {{ Form::password('password_conf') }}
                                        <small class="text-danger pull-right">{{ $errors->first('password_conf') }}</small>
                                    </div>
                                </div>

                                <div class="sec-title-one billing">
                                    <h2>Adresse de facturation</h2>
                                </div>

                                <div class="row clearfix billing">
                                    <div class="form-group {{ $errors->has('lastname') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12">
                                        <div class="field-label">Nom</div>
                                        {{ Form::text('billing_lastname', Auth::user()->lastname ?? null) }}
                                        <small class="text-danger pull-right">{{ $errors->first('lastname') }}</small>
                                    </div>

                                    <div class="form-group {{ $errors->has('firstname') ? 'has-error has-feedback' : '' }} col-md-6 col-sm-6 col-xs-12">
                                        <div class="field-label">Prénom</div>
                                        {{ Form::text('billing_firstname', Auth::user()->firstname ?? null) }}
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
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <!--Your Order-->
                        <div class="your-order">
                            <div class="default-title"><h2>Votre commande</h2></div>
                            <!--Orders Table-->
                            <ul class="orders-table">
                                <li class="table-header clearfix">
                                    <div class="col">Produit</div>
                                    <div class="col">Total</div>
                                </li>
                                @foreach($cart as $key => $item)
                                    <?php
                                        $item = (object)$item;
                                        $product = $item->product;
                                        $quantity = $item->quantity;
                                        $type = $item->type;
                                        $total += $product->price * $quantity;
                                        $json = json_encode(['id' => $product->id, 'quantity' => $quantity, 'type' => $type]);
                                    ?>
                                    <li class="clearfix">
                                        {{ Form::hidden('product[]', $json) }}
                                        <div class="col">{{ $product->name }}</div>
                                        <div class="col">{{ number_format((float)$product->price * $quantity, 2, '.', '') }} <i class="fa fa-fw fa-euro"></i> </div>
                                    </li>
                                @endforeach
                                <li class="clearfix">
                                    <div class="col">Livraison</div>
                                    <div class="col">Livraison gratuite</div>
                                </li>
                                <li class="total clearfix">
                                    <div class="col">Total</div>
                                    <div class="col">{{ $total }} <i class="fa fa-fw fa-euro"></i> </div>
                                </li>
                            </ul>

                        </div><!--End Your Order-->

                        <!--Place Order-->
                        <div class="place-order">
                            <div class="default-title"><h2>Méthode de paiement</h2></div>

                            <!--Payment Options-->
                            <div class="payment-options">
                                <ul>
                                    <li>
                                        <div class="radio-option">
                                            <input type="radio" name="payment-group" id="payment-1" checked>
                                            <label for="payment-1">
                                                <strong>Paiement au retrait de la commande</strong>
                                                <span class="small-text">
                                                    Les poids ne pouvant être exactes, tout les réglement se feront lors de du retrait de votre commande dans l'un de nos point de retrait.
                                                </span>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <button type="submit" class="theme-btn btn-style-two">Passer commande</button>


                        </div><!--End Place Order-->
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>

@stop

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            if (!$('input[name=billing]').is(':checked')) {
                $('.billing').hide();
            }
            $('.password-input').hide();
            $('.password-input-conf').hide();

            var account = $('input[name=account]');
            $(document).on('change', account, function(){
                if(account.is(':checked')) {
                    $('.password-input').show();
                    $('.password-input-conf').show();
                } else {
                    $('.password-input').hide();
                    $('.password-input-conf').hide();
                }
            });



            $(document).on('change', 'input[name=billing]', function () {
                if ($(this).is(':checked')) {
                    $('.billing').show();
                } else {
                    $('.billing').hide();
                }
            })
        });
    </script>
@stop