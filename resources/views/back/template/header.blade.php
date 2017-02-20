<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <a class="navbar-brand" href="index.html">Olympic Drive Administration</a>
    </div>

@if(Auth::check())
    <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b
                            class="caret"></b></a>
                <ul class="dropdown-menu alert-dropdown">
                    <li>
                        <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                    </li>
                    <li>
                        <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                    </li>
                    <li>
                        <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                    </li>
                    <li>
                        <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                    </li>
                    <li>
                        <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                    </li>
                    <li>
                        <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">View All</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-user"></i>
                    {{ Auth::user()->firstname.' '.Auth::user()->lastname }}
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-fw fa-gear"></i> Configuration</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="{{ route('logout') }}"><i class="fa fa-fw fa-power-off"></i>Déconnexion</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->

        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                </li>
                <li class="{{ Request::is('admin/orders*') ? 'active' : '' }}">
                    <a href="{{ route('orders.index') }}"><i class="fa fa-fw fa-shopping-cart"></i> Commandes</a>
                </li>
                <li class="{{ Request::is('admin/products*') ? 'active' : '' }}">
                    <a href="{{ route('products.index') }}"><i class="fa fa-fw fa-table"></i> Produits</a>
                </li>
                <li class="{{ Request::is('admin/baskets*') ? 'active' : '' }}">
                    <a href="{{ route('baskets.index') }}"><i class="fa fa-fw fa-shopping-basket"></i> Paniers</a>
                </li>
                @if(Auth::user()->isAdmin())
                    <li class="{{ Request::is('admin/users*') ? 'active' : '' }}">
                        <a href="{{ route('users.index') }}"><i class="fa fa-fw fa-user"></i> Utilisateurs</a>
                    </li>
                @endif

                <li>
                    <a href="{{ route('home') }}"><i class="fa fa-fw fa-arrow-circle-left"></i> Retour au site</a>
                </li>
            </ul>
        </div>
@endif
<!-- /.navbar-collapse -->
</nav>