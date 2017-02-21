<header class="main-header">
    <div class="main-box">
        <div class="auto-container">
            <div class="outer-container clearfix">
                <div class="logo-box">
                    <div class="logo">
                        <h1 style="display: flex; align-items: center">
                            <a href="{{ route('home') }}" style="margin-top: 10px;">
                                Olympic Drive
                            </a>
                        </h1>
                    </div>
                </div>
                <div class="nav-outer clearfix">
                    <nav class="main-menu">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                    data-target=".navbar-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                        <div class="navbar-collapse collapse clearfix">
                            <ul class="navigation clearfix">
                                <li class="{{ Request::is('/*') ? 'current' : '' }}">
                                    <a href="{{ route('home') }}">Accueil</a>
                                </li>
                                <li class="{{ Request::is('/product/*') ? 'current' : '' }}">
                                    <a href="{{ route('shop.index') }}">Produits</a>
                                </li>
                                <li class="{{ Request::is('/baskets') ? 'current' : '' }}">
                                    <a href="{{ route('paniers.index') }}">Paniers</a>
                                </li>
                                <li class="{{ Request::is('/contact') ? 'current' : '' }}">
                                    <a href="{{ route('contact') }}">Nous Contacter</a>
                                </li>
                                <li class="{{ Request::is('/account/*') ? 'current' : '' }} dropdown">
                                    <a href="#">{{ Auth::check() ? Auth::user()->getFullName() : 'Mon compte' }}</a>
                                    <ul>
                                        @if(!Auth::check())
                                            <li><a href="{{ route('register') }}">M'inscrire</a></li>
                                            <li><a href="{{ route('front.login') }}">Me connecter</a></li>
                                            <li>
                                                <a href="{{ route('cart') }}">
                                                    Mon panier
                                                    <span class="label label-default cart_items">
                                                        {{ session()->has('cart') ? count(session('cart')) : 0 }}
                                                    </span>
                                                </a>
                                            </li>
                                        @else
                                            @if(Auth::user()->isAdminOrEditor())
                                                <li>
                                                    <a href="{{ route('dashboard') }}">Administration</a>
                                                </li>
                                            @endif
                                            <li>
                                                <a href="{{ route('infos') }}">
                                                    Mes informations
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('commandes.index') }}">
                                                    Mes commandes
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('cart') }}">
                                                    Mon panier
                                                    <span class="label label-default cart_items">
                                                        {{ session()->has('cart') ? count(session('cart')) : 0 }}
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('logout') }}">
                                                    Déconnexion
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>

                <div class="nav-toggler">
                    <button class="hidden-bar-opener"><span class="icon fa fa-bars"></span></button>
                </div>
            </div>
        </div>
</header>

