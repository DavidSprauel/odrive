@extends('front.template.template')

@section('title')
    Details de la commande {{ $order->id }}
@stop

@section('content')
    <section class="page-title"
             style="background-image:url({{ asset('front/images/background/bg-page-title-1.jpg') }});">
        <div class="auto-container">
            <h1>Commande #{{ $order->id }}</h1>
        </div>
    </section>

    <section class="cart-section">
        <div class="auto-container">

            <div class="col-xs-12 col-sm-6">
                <h3>Général:</h3>
                <ul class="list-group">
                    <li class="list-group-item">
                        Commande:
                        <small class="pull-right">#{{ $order->id }}</small>
                    </li>

                    <li class="list-group-item">
                        Status:
                        <small class="pull-right">{!! $order->getStatusText() !!}</small>
                    </li>

                    <li class="list-group-item">
                        Date de la commande:
                        <small class="pull-right">{{ $order->formatFrenchDate() }}</small>
                    </li>

                    <li class="list-group-item">
                        Total articles:
                        <small class="pull-right">{{ $order->products->count() + $order->baskets->count() }}</small>
                    </li>
                </ul>
            </div>

            <div class="col-xs-12 col-sm-6">
                <h3>Addresse de facturation:</h3>
                <ul class="list-group">
                    @if($order->user->informations->billing == 1)
                        <li class="list-group-item">
                            Nom / Prénom:
                            <small class="pull-right">
                                {{ $order->user->informations->billing_firstname.' '.$order->user->informations->billing_lastname }}
                            </small>
                        </li>
                        <li class="list-group-item">
                            Adresse:
                            <small class="pull-right">
                                {{ $order->user->informations->billing_address }}
                            </small>
                        </li>
                        <li class="list-group-item">
                            Code postal / Ville:
                            <small class="pull-right">
                                {{ $order->user->informations->billing_zipcode }}
                                {{ $order->user->informations->billing_city }}
                            </small>
                        </li>
                        <li class="list-group-item">
                            Pays:
                            <small class="pull-right">
                                {{ $order->user->informations->getCountryText(true) }}
                            </small>
                        </li>
                    @else
                        <li class="list-group-item">
                            Nom / Prénom:
                            <small class="pull-right">
                                {{ $order->user->firstname.' '.$order->user->lastname }}
                            </small>
                        </li>
                        <li class="list-group-item">
                            Adresse:
                            <small class="pull-right">
                                {{ $order->user->informations->address }}
                            </small>
                        </li>
                        <li class="list-group-item">
                            Code postal / Ville:
                            <small class="pull-right">
                                {{ $order->user->informations->zipcode }} {{ $order->user->informations->city }}
                            </small>
                        </li>
                        <li class="list-group-item">
                            Pays:
                            <small class="pull-right">
                                {{ $order->user->informations->getCountryText() }}
                            </small>
                        </li>
                    @endif
                </ul>
            </div>


            <div class="cart-outer">
                <div class="table-outer">
                    <table class="cart-table">
                        <thead class="cart-header">
                            <tr>
                                <th class="prod-column">Produit</th>
                                <th></th>
                                <th class="price">Prix unitaire</th>
                                <th>Quantité</th>
                                <th class="price">Prix</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0; ?>
                            @forelse($order->baskets as $p)
                                <tr>
                                    <td colspan="2" class="prod-column">
                                        <div class="column-box">
                                            <figure class="prod-thumb" style="align-items: center; display: flex;">
                                                <img src="{{ $p->getShopThumb() }}" alt="">
                                            </figure>
                                            <div class="prod-title">
                                                {{ $p->name }}
                                                <div>
                                                    <small>
                                                        {{ $p->products->count() }} produits dans ce panier
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $p->price }} €</td>
                                    <td>{{ $p->pivot->quantity }}</td>
                                    <td>{{ $p->pivot->quantity * $p->price }} €</td>
                                    <?php $total += $p->pivot->quantity * $p->price ?>
                                </tr>
                            @empty
                            @endforelse
                            @forelse($order->products as $p)
                                <tr>
                                    <td colspan="2" class="prod-column">
                                        <div class="column-box">
                                            <figure class="prod-thumb" style="align-items: center; display: flex;">
                                                <img src="{{ $p->getShopThumb() }}" alt="">
                                            </figure>
                                            <div class="prod-title">
                                                {{ $p->name }}
                                                <div>
                                                    <small>
                                                        {{ $p->weight.$p->getUnitsText() }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $p->price }} €</td>
                                    <td>{{ $p->pivot->quantity }}</td>
                                    <td>
                                        {{ number_format((float)$p->pivot->quantity * $p->price, 2, '.', '') }} €
                                    </td>
                                    <?php $total += $p->pivot->quantity * $p->price ?>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>

                    <div class="row clearfix">
                        <div class="column pull-right col-md-4 col-sm-8 col-xs-12">
                            <!--Totals Table-->
                            <ul class="totals-table">
                                <li class="clearfix total">
                                    <span class="col">Total</span>
                                    <span class="col">{{ number_format((float)$total, 2, '.', '') }} <i class="fa fa-fw fa-euro"></i></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{ route('commandes.index') }}" class="btn btn-primary">
                <i class="fa fa-fw fa-arrow-circle-left"></i>
                Retour
            </a>
        </div>
    </section>
@stop


