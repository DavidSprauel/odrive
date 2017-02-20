@extends('back.template.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Commandes
                <small>Commande n° "{{ $order->id }}"</small>
                <a class="btn btn-md btn-primary pull-right" href="{{ route('orders.index') }}">
                    <i class="fa fa-fw fa-arrow-circle-left"></i> Retour
                </a>
            </h1>
        </div>
    </div>
    <div class="row">
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

        <div class="row">
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
        </div>


        <div class="row">
            <div class="col-xs-12">
                <h3>Details de la commande</h3>
                <table class="table orderTable">
                    <thead>
                    <tr>
                        <th>Produit</th>
                        <th></th>
                        <th>Prix unitaire</th>
                        <th>Quantité</th>
                        <th>Prix</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $total = 0; ?>
                    @forelse($order->baskets as $p)
                        <tr>
                            <td colspan="2">
                                <div class="column-box">
                                    <figure class="prod-thumb"
                                            style="align-items: center; display: flex; width: 100px; height: 140px;">
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
                            <td style="text-align: right">{{ $p->pivot->quantity * $p->price }} €</td>
                            <?php $total += $p->pivot->quantity * $p->price ?>
                        </tr>
                    @empty
                    @endforelse
                    @forelse($order->products as $p)
                        <tr>
                            <td colspan="2">
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
                            <td>{{ $p->pivot->quantity * $p->price }} €</td>
                            <?php $total += $p->pivot->quantity * $p->price ?>
                        </tr>
                    @empty
                    @endforelse
                    </tbody>
                    <tfoot>
                    <tr class="portTr">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Frais de port:</td>
                        <td>Gratuit</td>
                    </tr>
                    <tr class="totalTr">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="text-align: right">TOTAL (TTC):</td>
                        <td><strong>{{ $total }} €</strong></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-info alert-with-icon">
                        <div class="col-xs-1">
                            <i class="fa fa-info-circle fa-5x"></i>
                        </div>
                        <div class="col-xs-11">
                            <h4>Status:</h4>
                            <ul>
                                <li>
                                    <strong>Validée</strong>: Le client peux récupérer sa commande.
                                </li>
                                <li>
                                    <strong>Annulée</strong>: La commande a été annulé ou ne peux pas être honorée
                                </li>
                                <li>
                                    <strong>Informations</strong>: En attente d'informations du client
                                </li>
                                <li>
                                    <strong>Cloturée</strong>: Le client a reçu sa commande
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        <hr>

        <div class="row">
            <div class="col-xs-3">
                <button type="button"
                        data-status="3"
                        class="btn btn-success btn-block statusBtn"
                        {{ in_array($order->status, [0, 7, 3]) ? 'disabled' : '' }}>
                    <i class="fa fa-fw fa-check-circle"></i>
                    Valider cette commande
                </button>
            </div>

            <div class="col-xs-3">
                <button type="button"
                        data-status="0"
                        class="btn btn-danger btn-block statusBtn"
                        {{ in_array($order->status, [0, 7]) ? 'disabled' : '' }}>
                    <i class="fa fa-fw fa-times-circle"></i>
                    Annuler cette commande
                </button>
            </div>

            <div class="col-xs-3">
                <button type="button"
                        data-status="6"
                        class="btn btn-info btn-block statusBtn"
                        {{ in_array($order->status, [0, 7, 6]) ? 'disabled' : '' }}>
                    <i class="fa fa-fw fa-info-circle"></i>
                    Demande d'informations
                </button>
            </div>

            <div class="col-xs-3">
                <button type="button"
                        data-status="7"
                        class="btn btn-primary btn-block statusBtn"
                        {{ in_array($order->status, [0, 7]) ? 'disabled' : '' }}>
                    <i class="fa fa-fw fa-minus-circle"></i>
                    Clôturer commande
                </button>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script type="text/javascript">
        $(document).ready(function () {

            $('.statusBtn').on('click', function () {
                var status = $(this).data('status');

                if (status == 0) {
                    swal({
                            title: "Annuler la commande?",
                            text: "La commande sera annulée et ne pourras plus être validée",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Je confirme",
                            cancelButtonText: "Annuler",
                            closeOnConfirm: false
                        },
                        function () {
                            $.ajax({
                                url: "/admin/orders/{{ $order->id }}",
                                method: "put",
                                data: {status: status},
                                success: function (data) {
                                    location.reload();
                                },
                                error: function (data) {
                                    swal('Erreur', data.errors, 'error');
                                }
                            });
                        });

                } else {

                    $.ajax({
                        url: "/admin/orders/{{ $order->id }}",
                        method: "put",
                        data: {status: status},
                        success: function (data) {
                            location.reload();
                        },
                        error: function (data) {
                            swal('Erreur', data.errors, 'error');
                        }
                    });
                }

            });
        });
    </script>
@stop

