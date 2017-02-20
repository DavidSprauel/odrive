@extends('front.template.template')

@section('title')
    Votre panier
@stop

@section('content')
    <section class="page-title"
             style="background-image:url({{ asset('front/images/background/bg-page-title-1.jpg') }});">
        <div class="auto-container">
            <h1>Mon panier</h1>
        </div>
    </section>

    <section class="cart-section">
        <div class="auto-container">
            <!--Cart Outer-->
            <div class="cart-outer">
                <div class="table-outer">
                    <table class="cart-table">
                        <thead class="cart-header">
                            <tr>
                                <th class="prod-column">PRODUIT</th>
                                <th>&nbsp;</th>
                                <th class="price">Prix</th>
                                <th>QUANTITÉ</th>
                                <th>Total</th>
                                <th><span class="fa fa-trash-o"></span></th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($cart as $key => $item)
                                <?php
                                    $item = (object)$item;
                                    $product = $item->product;
                                    $quantity = $item->quantity;
                                    $type = $item->type;
                                    $subTotal += $product->price * $quantity;
                                    $total += $product->price * $quantity;
                                ?>
                                <tr>
                                    <td colspan="2" class="prod-column">
                                        <div class="column-box">
                                            <figure class="prod-thumb" style="align-items: center; display: flex;">
                                                <img src="{{ $product->getShopThumb() }}" alt="">
                                            </figure>
                                            <div class="prod-title">
                                                {{ $product->name }}
                                                @if($type == 1)
                                                    <div>
                                                        <small>
                                                            {{ $product->weight.$product->getUnitsText() }}
                                                        </small>
                                                    </div>
                                                @else
                                                    <div>
                                                        <small>
                                                            {{ $product->products->count() }} produits dans ce panier
                                                        </small>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="price">{{ $product->price }}<i class="fa fa-fw fa-euro"></i> </td>
                                    <td class="qty">
                                        <div class="quantity-spinner">
                                            <button type="button" class="minus">
                                                <span class="fa fa-minus"></span>
                                            </button>
                                            <input type="text" name="product_{{ $product->id }}_{{ $type }}" value="{{ $quantity }}" class="prod_qty" />
                                            <button type="button" class="plus">
                                                <span class="fa fa-plus"></span>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="sub-total">
                                        {{ number_format((float)$product->price * $quantity, 2, '.', '') }}
                                        <i class="fa fa-fw fa-euro"></i>
                                    </td>
                                    <td class="remove">
                                        <a class="remove-btn" data-id="{{ $product->id }}" data-type="{{ $type }}">
                                            <span class="fa fa-remove"></span>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Votre panier est vide...</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="cart-options clearfix">
                    <div class="pull-right">
                        <button type="button" class="theme-btn btn-style-one updateCart">
                            Mettre à jour le panier
                        </button>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="column pull-right col-md-4 col-sm-8 col-xs-12">
                        <div class="normal-title"><h3>Total panier</h3></div>
                        <!--Totals Table-->
                        <ul class="totals-table">
                            <li class="clearfix">
                                <span class="col">Sous Total</span>
                                <span class="col">{{ number_format((float)$subTotal, 2, '.', '') }} <i class="fa fa-fw fa-euro"></i></span>
                            </li>
                            <li class="clearfix total">
                                <span class="col">Total</span>
                                <span class="col">{{ number_format((float)$total, 2, '.', '') }} <i class="fa fa-fw fa-euro"></i></span>
                            </li>
                        </ul>

                        <div class="">
                            <a href="{{ route('checkout') }}" type="submit" class="theme-btn btn-style-two proceed-btn" {{ session()->has('cart') ? '' : 'disabled' }}>
                                Procéder à la commande &ensp;
                                <span class="fa fa-long-arrow-right"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            var btn = $('.updateCart');

            btn.on('click', function () {
                var btn = $(this);
                var products = [];

                $.each($('input.prod_qty'), function() {
                    var val = $(this).val();
                    var infos = $(this).attr('name').split('_');
                    var data = {
                        product: infos[1],
                        quantity: val,
                        type: infos[2]
                    }
                    products.push(data);
                });


                $.ajax({
                    url: '/shop/cart/update',
                    method: 'POST',
                    data: { products: products},
                    success: function (data) {
                        if (data.success) {
                            location.reload();
                        }
                    }
                });
            });

            $('.remove-btn').on('click', function(){
                var btn = $(this);
                $.ajax({
                    url: '/shop/cart/remove',
                    method: 'POST',
                    data: { product: btn.data('id'), type: btn.data('type')},
                    success: function(data) {
                        if(data) {
                           location.reload();
                        }
                    }
                });
            });
        });
    </script>
@stop