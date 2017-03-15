@extends('back.template.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Commandes
                <small>Vue d'ensemble</small>
            </h1>
        </div>
    </div>
    @if(session()->has('flash'))
        <div class="row" style="">
            <div class="col-lg-12">
                <div class="alert alert-{{ session('flash')['code'] == 1 ? 'success' : 'danger' }} alert-with-icon">
                    <div class="col-xs-1 text-right"><i
                                class="fa fa-{{ session('flash')['code'] == 1 ? 'check' : 'times' }} fa-2x fa-fw"></i>
                    </div>
                    <div class="col-xs-11">
                        <strong>{{ session('flash')['code'] == 1 ? 'Succès' : 'Erreur' }}:</strong>
                        {{ session('flash')['message'] }}
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Date de Commande</th>
                    <th>Par</th>
                    <th>Montant</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                @forelse($orders as $o)
                    <tr>
                        <td class="vert-align">{{ $o->id }}</td>
                        <td class="vert-align">
                            le {{ $o->created_at->format('d/m/Y à H:i:s') }}
                        </td>
                        <td class="vert-align">{{ $o->user->getFullName() }}</td>
                        <td class="vert-align">{{ $o->getTotal() }} €</td>
                        <td class="vert-align">{!! $o->getStatusText()  !!}</td>
                        <td class="vert-align">
                            @if(!is_null($o->viewer))
                                Vu
                                {{ $o->viewed_at->diffForHumans() }} par
                                <strong>{{ $o->viewer->getFullName() }}</strong>
                            @endif
                        </td>
                        <td class="vert-align button">
                            <a href="{{ route('orders.edit', $o->id) }}" class="btn btn-info">
                                Voir
                                <i class="fa fa-arrow-circle-right fa-fw"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Aucune commande enregistré...</td>
                    </tr>
                @endforelse
            </table>
            <div class="text-center">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
@stop


