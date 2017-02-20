@extends('back.template.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Tableau de bord
                <small>Vue d'ensemble</small>
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-info-circle"></i>
                <strong>Bienvenue {{ Auth::user()->firstname }}</strong>
            </div>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <!-- ORDERS -->
        <div class="{{ Auth::user()->isAdmin() ? 'col-lg-3 col-md-6' : 'col-lg-4 col-md-4' }}">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $orderCount }}</div>
                            <div>Commandes</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('orders.index') }}">
                    <div class="panel-footer">
                        <span class="pull-left">Gérer Commandes</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <!-- PRODUCTS -->
        <div class="{{ Auth::user()->isAdmin() ? 'col-lg-3 col-md-6' : 'col-lg-4 col-md-4' }}">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-table fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $productsCount }}</div>
                            <div>Produits</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('products.index') }}">
                    <div class="panel-footer">
                        <span class="pull-left">Gérer Produits</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <!-- USERS -->
        @if(Auth::user()->isAdmin())
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-users fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $usersCount }}</div>
                                <div>Utilisateurs</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('users.index') }}">
                        <div class="panel-footer">
                            <span class="pull-left">Gérer Utilisateurs</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
    @endif

    <!-- BASKETS -->
        <div class="{{ Auth::user()->isAdmin() ? 'col-lg-3 col-md-6' : 'col-lg-4 col-md-4' }}">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-basket fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $basketsCount }}</div>
                            <div>Paniers</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('baskets.index') }}">
                    <div class="panel-footer">
                        <span class="pull-left">Gérer paniers</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">

        <!-- PRODUCTS -->
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-clock-o fa-fw"></i>
                        Derniers produits ajoutés
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        @forelse($lastProducts as $p)
                            <a href="{{ route('products.edit', $p->id) }}" class="list-group-item">
                                <span class="badge">{{ $p->created_at->diffForHumans() }}</span>
                                <i class="fa fa-fw fa-arrow-right"></i> {{ $p->name }}
                            </a>
                        @empty
                            <p class="text-center">Aucun produit enregitré...</p>
                        @endforelse
                    </div>
                    <div class="text-right">
                        <a href="{{ route('products.index') }}">
                            Voir tous les produits
                            <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- BASKETS -->
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-shopping-basket fa-fw"></i> Dernières paniers ajoutés
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        @forelse($lastBaskets as $p)
                            <a href="{{ route('baskets.edit', $p->id) }}" class="list-group-item">
                                <span class="badge">{{ $p->created_at->diffForHumans() }}</span>
                                <i class="fa fa-fw fa-arrow-right"></i> {{ $p->name }}
                            </a>
                        @empty
                            <p class="text-center">Aucun paniers enregitré...</p>
                        @endforelse
                    </div>
                    <div class="text-right">
                        <a href="{{ route('baskets.index') }}">
                            Voir tous les paniers
                            <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- ORDERS -->
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-money fa-fw"></i> Dernières commandes non vues
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Montant</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse($lastOrders as $c)
                                    <tr>
                                        <td>{{ $c->id }}</td>
                                        <td>{{ $c->created_at->format('d/m/Y à H:i') }}</td>
                                        <td>{{ $c->getTotal() }}<i class="fa fa-euro"></i> </td>
                                        <td>{!! $c->getStatusText() !!} </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Aucune commande enregistrée..</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="text-right">
                        <a href="{{ route('orders.index') }}">
                            Voir toutes les commandes <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
@stop