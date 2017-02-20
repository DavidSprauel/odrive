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
                                </h4>
                                <div class="item-price">{{ $product->price }} <i class="fa fa-fw fa-euro"></i></div>
                            </div>

                            <div class="text">{!!   is_null($product->description) ? 'Aucune description pour ce produit' :  nl2br($product->description) !!}</div>
                            <div class="availablity">
                                <span class="text-success">Disponible</span>
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
                            $(document).find('.cart_items').text(data.cart);
                            swal('Ajouté au panier', 'Le produit a bien été ajouté au panier', 'success');
                        }
                    }
                });
            });
        });
    </script>
@stop