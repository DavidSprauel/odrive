@extends('front.template.template')

@section('title')
    Commande Validée
@stop

@section('content')
    <section class="page-title"
             style="background-image:url({{ asset('front/images/background/bg-page-title-1.jpg') }});">
        <div class="auto-container">
            <h1>Commande Validée</h1>
        </div>
    </section>

    <div class="checkout-page">
        <div class="auto-container">
            @if(session()->has('flash'))
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="alert alert-{{ session('flash')['code'] == 1 ? 'success' : 'danger' }} alert-with-icon clearfix">
                            <div class="col-xs-1 text-right">
                                <i class="fa fa-{{ session('flash')['code'] == 1 ? 'check' : 'times' }} fa-2x fa-fw"></i>
                            </div>
                            <div class="col-xs-11">
                                <strong>{{ session('flash')['code'] == 1 ? 'Succès' : 'Erreur' }}:</strong>
                                {!! session('flash')['message'] !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row clearfix">
                <div class=" alert {{ session()->has('answser') || session('answer') ? 'alert-success': 'alert-danger' }} clearfix alert-with-icon">
                    @if(session()->has('answser') || session('answer'))
                        <div class="col-xs-1">
                            <i class="fa fa-check fa-fw fa-4x"></i>
                        </div>
                        <div class="col-xs-11">
                            Votre commande a bien été enregistré. Vous allez recevoir un récapitulatif de votre commande par email. Vous pouvez aussi voir l'historique de vos commandes dans votre espace personnel.
                            <br><br>
                            Olympic Drive vous remercie et vous dit à bientôt.
                        </div>
                    @else
                        <div class="col-xs-1">
                            <i class="fa fa-times fa-fw fa-4x"></i>
                        </div>
                        <div class="col-xs-11">
                            Une erreur est survenue lors du traitement de votre commande. Veuillez contacter le support si cela se renouvelle.<br><br>
                            Toute l'équipe d'Olympic Drive s'excuse de la gêne occasionée.
                        </div>
                    @endif
                </div>
                <a href="{{ route('home') }}" class="theme-btn btn-style-one pull-right"> Retour à l'accueil</a>
            </div>
        </div>
    </div>
@stop