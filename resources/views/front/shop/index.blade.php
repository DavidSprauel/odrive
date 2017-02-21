@extends('front.template.template')

@section('title')
    Boutique fruit et légumes
@stop

@section('content')
    <section class="page-title"
             style="background-image:url({{ asset('front/images/background/bg-page-title-1.jpg') }});">
        <div class="auto-container">
            <h1>Boutique fruit et légumes</h1>
        </div>
    </section>

    <section class="shop-section">
        <div class="auto-container">

            <!--Sort By-->
            <div class="items-sorting">
                <div class="row clearfix">
                    <div class="results-column col-md-6 col-sm-12 col-xs-12">
                        <div class="text">Affiche {{ $products->firstItem() }} - {{ $products->lastItem() }}
                            sur {{ $products->count() }} résultats
                        </div>
                    </div>
                    <div class="select-column col-md-3 col-sm-12 col-xs-12">
                        {{ Form::open(['route' => 'search', 'method' => 'post']) }}
                        <div class="form-group search-input">
                            {{ Form::text('search', null, ['placeholder' => 'Rechercher...']) }}
                            <i class="fa fa-fw fa-search pull-right"></i>
                        </div>
                    </div>
                    <div class="select-column col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <select name="sort-by">
                                <option value="0">Voir Tout</option>
                                <option value="1">Voir Légumes</option>
                                <option value="2">Voir fruits</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                @forelse($products as $p)
                    <div class="default-shop-item col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image" style="width:270px; height: 250px;">
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
                                <div class="price"><span class="price-txt">{{ $p->price }} €</span></div>
                            </div>

                            <!--Overlay Box-->
                            <div class="overlay-box">
                                <div class="prod-options">
                                    <a href="{{ route('shop.show', $p->id) }}" class="theme-btn add-cart-btn"
                                       style="margin-bottom: 10px; width: 215px;">
                                        Voir le produit <span class="fa fa-eye"></span>
                                    </a>
                                    <a class="theme-btn add-cart-btn add-cart" style="width: 215px;" data-id="{{ $p->id }}">
                                        Ajouter au panier <span class="fa fa-shopping-cart"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="no-item text-center col-xs-12 hidden">
                        Aucun produits dans la boutique...
                    </div>
                @endforelse
            </div>
        </div>

        {{ $products->links() }}

    </section>
@stop

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            var btn = $('.add-cart');

            btn.on('click', function () {
                var btn = $(this);

                var data = {
                    product: btn.data('id'),
                    quantity: 1,
                    type: 1
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