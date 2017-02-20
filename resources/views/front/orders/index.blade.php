@extends('front.template.template')

@section('title')
    Mes commandes
@stop

@section('content')
    <section class="page-title"
             style="background-image:url({{ asset('front/images/background/bg-page-title-1.jpg') }});">
        <div class="auto-container">
            <h1>Mes commandes</h1>
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
                                <th>#</th>
                                <th>Date de Commande</th>
                                <th>Montant</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($orders as $o)
                                <tr>
                                    <td class="vert-align">
                                        <a href="{{ route('commandes.show', $o->id) }}">
                                        #{{ $o->id }}
                                        </a>
                                    </td>
                                    <td class="vert-align">
                                        le {{ $o->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="vert-align">{{ $o->getTotal() }} €</td>
                                    <td class="vert-align">{!! $o->getStatusText()  !!}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Aucune commande enregistré...</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop


