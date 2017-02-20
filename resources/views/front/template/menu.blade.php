<section class="hidden-bar right-align">
    <div class="hidden-bar-closer">
        <button class="btn"><i class="fa fa-close"></i></button>
    </div>

    <div class="hidden-bar-wrapper">

        <div class="logo">
            <h1>
                <a href="{{ route('home') }}" style="position: relative;z-index: 15">
                    <strong>Olympic</strong> Drive
                </a>
            </h1>
        </div>

        <div class="side-menu">
            <ul class="navigation">
                <li class="{{ Request::is('/*') ? 'current' : '' }}">
                    <a href="{{ route('home') }}">Accueil</a>
                </li>
                <li class="{{ Request::is('/product/*') ? 'current' : '' }} dropdown">
                    <a href="{{ route('products.index') }}">Produits</a>
                    <ul>
                        <li><a href="{{ route('fruits') }}">Fruits</a></li>
                        <li><a href="{{ route('vegetables') }}">Légumes</a></li>
                    </ul>
                </li>
                <li class="{{ Request::is('/baskets') ? 'current' : '' }}">
                    <a href="{{ route('baskets.index') }}">Paniers</a>
                </li>
                <li class="{{ Request::is('/contact') ? 'current' : '' }}">
                    <a href="{{ route('contact') }}">Nous Contacter</a>
                </li>
                <li class="{{ Request::is('/account/*') ? 'current' : '' }} dropdown">
                    <a href="#">Mon compte</a>
                    <ul>
                        <li><a href="{{ route('register') }}">M'inscrire</a></li>
                        <li><a href="{{ route('front.login') }}">Me connecter</a></li>
                        <li><a href="{{ route('cart') }}">Mon panier</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="social-icons">
            <ul>
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
            </ul>
        </div>

    </div>
</section>