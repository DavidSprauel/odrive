@extends('front.template.template')

@section('title')
    {{ $product->name }}
@stop

@section('content')
    <section class="page-title"
             style="background-image:url({{ asset('front/images/background/bg-page-title-1.jpg') }});">
        <div class="auto-container">
            <h1>{{ $product->name }}</h1>
        </div>
    </section>

    <div class="shop-single">
        <!--Product Details Section-->
        <section class="product-details">
            <div class="auto-container">
                <!--Basic Details-->
                <div class="basic-details">
                    <div class="row clearfix">
                        <div class="image-column col-md-4 col-sm-5 col-xs-12">
                            <figure class="image-box">
                                <a href="{{ $product->picture }}" class="lightbox-image" title="{{ $product->name }}">
                                    <img src="{{ $product->getThumb() }}" alt="">
                                </a>
                            </figure>
                        </div>
                        <div class="info-column col-md-8 col-sm-7 col-xs-12">
                            <div class="details-header">
                                <h4>
                                    {{ $product->name }}
                                    <small>{{ $product->weight.$product->getUnitsText() }}</small>
                                </h4>
                                {{--<div class="rating">
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star-half-empty"></span>
                                    <span class="txt">(Customer Review)</span>
                                </div>--}}
                                <div class="item-price">{{ $product->price }} <i class="fa fa-fw fa-euro"></i></div>
                            </div>

                            <div class="text">{{ is_null($product->description) ? 'Aucune description pour ce produit' :  $product->description}}</div>
                            <div class="availablity">
                                {!! $product->getAvailabilityText() !!}
                            </div>

                            <div class="clearfix">
                                <div class="item-quantity">
                                    <div class="quantity-spinner">
                                        <button type="button" class="minus">
                                            <span class="fa fa-minus"></span>
                                        </button>
                                        <input type="text" name="quantity" value="1" class="prod_qty"/>
                                        <button type="button" class="plus">
                                            <span class="fa fa-plus"></span>
                                        </button>
                                    </div>
                                </div>
                                <button type="button" class="theme-btn btn-style-one add-to-cart" id="add-to-cart"
                                        data-id="{{ $product->id }}">
                                    Ajouter au panier <span class="icon fa fa-shopping-cart"></span>
                                </button>
                            </div>

                        </div>
                    </div>
                </div><!--Basic Details-->

                <section class="related-products">
                    <div class="auto-container">
                        <div class="sec-title-one">
                            <h2>Produits similaires</h2>
                        </div>
                        <div class="row clearfix">
                        @forelse($related as $p)
                            @if($p->id != $product->id)
                                <!--Default Shop Item-->
                                    <div class="default-shop-item col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image">
                                                    <a href="shop-single.html">
                                                        <img src="{{ $p->getShopThumb() }}" alt="">
                                                    </a>
                                                </figure>
                                            </div>
                                            <div class="lower-content">
                                                <h3>
                                                    <a href="{{ route('shop.show', $p->id) }}">{{ $p->name }}</a>
                                                    <small>{{  $p->getWeight() }}</small>
                                                </h3>
                                                <div class="price"><span class="price-txt">{{ $p->price }} €</span>
                                                </div>
                                            </div>

                                            <!--Overlay Box-->
                                            <div class="overlay-box">
                                                <div class="prod-options">
                                                    <a href="{{ route('shop.show', $p->id) }}"
                                                       class="theme-btn add-cart-btn"
                                                       style="margin-bottom: 10px; width: 215px;">
                                                        Voir le produit <span class="fa fa-eye"></span>
                                                    </a>
                                                    <button type="button" class="theme-btn add-cart-btn add-cart"
                                                            style="width: 215px;"
                                                            data-id="{{ $p->id }}">
                                                        Ajouter au panier <span class="fa fa-shopping-cart"></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @empty
                                <p class="text-center">Aucun produits similaire..</p>
                            @endif
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </div>
@stop

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            var btn = $('#add-to-cart');

            btn.on('click', function () {
                var btn = $(this);

                var data = {
                    product: btn.data('id'),
                    quantity: $('input[name=quantity]').val(),
                    type: 2
                }

                $.ajax({
                    url: '/shop/cart/add',
                    method: 'POST',
                    data: data,
                    success: function (data) {
                        if (data.success) {
                            $(document).find('.cart_items').text(data.cart;
                            swal('Ajouté au panier', 'Le produit a bien été ajouté au panier', 'success');
                        }
                    }
                });
            });

            var btnRelated = $('.add-cart');

            btnRelated.on('click', function () {
                var btn = $(this);

                var data = {
                    product: btn.data('id'),
                    quantity: $('input[name=quantity]').val(),
                    type: 2
                }

                $.ajax({
                    url: '/shop/cart/add',
                    method: 'POST',
                    data: data,
                    success: function (data) {
                        if (data.success) {
                            $(document).find('.cart_items').text(data.cart);
                            swal('Ajouté au panier', 'Le produit a bien été ajouté au panier', 'success');
                        }
                    }
                });
            });
        });
    </script>
@stop