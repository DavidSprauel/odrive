@extends('front.template.template')

@section('title')
    Accueil
@stop

@section('content')
    @include('front.template.slider')


    <!--Products Section One-->
    <section class="products-section-one">
        <div class="auto-container">
            <!--Section Title-->
            <div class="sec-title-one">
                <h2>Nos produits frais</h2>
            </div>

            <div class="row clearfix">
                <!--Product Style One-->
                <div class="product-style-one orange-theme col-md-4 col-sm-6 col-xs-12">
                    <div class="inner-box">
                        <div class="content">
                            <h3>Nos poduits frais</h3>
                            <div class="text">Fruits et Légumes</div>
                            <a href="{{ route('shop.index') }}" class="default-link">Voir nos produits</a>
                        </div>
                        <figure class="food-image wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <img src="{{ asset('front/images/resource/main-products-1.png') }}" alt="">
                        </figure>
                    </div>
                </div>

                <!--Product Style One-->
                <div class="product-style-one light-theme col-md-4 col-sm-6 col-xs-12">
                    <div class="inner-box">
                        <div class="content">
                            <h3>Nos paniers</h3>
                            <div class="text">Composé par nos soins</div>
                            <a href="{{ route('baskets.index') }}" class="default-link">Voir les paniers</a>
                        </div>
                        <figure class="food-image wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                            <img src="{{ asset('front/images/resource/main-products-2.png') }}" alt="">
                        </figure>
                    </div>
                </div>

                <!--Product Style One-->
                <div class="product-style-one green-theme col-md-4 col-sm-6 col-xs-12">
                    <div class="inner-box">
                        <div class="content">
                            <h3>Commander</h3>
                            <div class="text">Simple et Rapide</div>
                            <a href="{{ route('register') }}" class="default-link">M'inscrire</a>
                        </div>
                        <figure class="food-image wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1500ms">
                            <img src="{{ asset('front/images/resource/main-products-3.png') }}" alt="">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Featured Package Section-->
    <section class="featured-package-section">
        <div class="auto-container">
            <div class="package-box">
                <div class="inner">
                    <div class="row clearfix">
                        <!--Image Column-->
                        <div class="image-column col-md-6 col-sm-6 col-xs-12">
                            <figure class="image-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                                <img src="{{ asset('front/images/man-with-food.png') }}" alt="">
                            </figure>
                        </div>
                        <!--Content Column-->
                        @if(!is_null($basket))
                            <div class="content-column col-md-6 col-sm-12 col-xs-12">
                            <div class="content-box">
                                <div class="info">
                                    <div class="sub-title">Paniers Composé de la semaine</div>
                                    <div class="title">{{ $basket->name }}</div>
                                    <div class="pricing">
                                        <span class="old-price">{{ ($basket->price) + 2 }}€</span>
                                        {{ $basket->price }}€
                                    </div>
                                </div>
                                <div class="text">
                                    {!! nl2br($basket->description) !!}
                                </div>

                                <!--Countdown Timer-->
                                <!--
                                    <div class="time-counter"><div class="time-countdown clearfix" data-countdown="2017/02/16"></div></div>
                                -->

                                <div class="link-box">
                                    <a href="{{ route('paniers.show', $basket->id) }}" class="theme-btn btn-style-four">Voir produit</a>
                                </div>

                            </div>
                        </div>
                        @else
                            <div class="content-column col-md-6 col-sm-12 col-xs-12">
                                <div class="content-box">
                                    <div class="text text-center">
                                        Aucun panier en ce moment.
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Products Section Two-->
    <section class="products-section-two">
        <div class="auto-container">
            <!--Section Title-->
            <div class="sec-title-one">
                <h2>Nos derniers produits</h2>
            </div>

            <div class="row clearfix">
                @forelse($products as $p)
                    <!--Product Tyle TWo-->
                    <div class="product-style-two col-md-6 col-sm-6 col-xs-12">
                        <div class="inner-box">
                            <div class="clearfix">
                                <!--Image Column-->
                                <div class="image-column col-lg-5 col-md-12 col-sm-12 col-xs-12">
                                    <figure class="image">
                                        <a href="{{ route('shop.show', $p->id) }}">
                                            <img src="{{ $p->getThumb() }}" alt="">
                                        </a>
                                    </figure>
                                </div>
                                <!--Content Column-->
                                <div class="content-column col-lg-7 col-md-12 col-sm-12 col-xs-12">
                                    <div class="inner">
                                        <h3>{{ $p->name }}</h3>
                                        <div class="price"> {{ $p->price }}€</div>
                                        <div class="text">
                                            <ul>
                                                <li>{{ $p->weight.$p->getUnitsText() }}</li>
                                                <li>Origine: {{ $p->origin }}</li>
                                            </ul>
                                        </div>
                                        <div class="link-box">
                                            <a href="{{ route('shop.show', $p->id) }}" class="theme-btn btn-style-four">Voir Produit</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p> Aucun produit présent pour le moment...</p>
                @endforelse
            </div>

            <!--Button Outer-->
            <div class="more-btn-outer text-center">
                <a href="shop.html" class="theme-btn btn-style-four">
                    Voir plus
                </a>
            </div>

        </div>
    </section>



@stop