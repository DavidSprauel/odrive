@extends('back.template.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Produits
                <small>Modifer "{{ $product->name }}"</small>
                <a class="btn btn-md btn-primary pull-right" href="{{ route('products.index') }}">
                    <i class="fa fa-fw fa-arrow-circle-left"></i> Retour
                </a>
            </h1>
        </div>
    </div>
    <div class="row">
        @if(session()->has('flash'))
            <div class="row" style="">
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-with-icon">
                        <div class="col-xs-1 text-right"><i class="fa fa-times fa-2x fa-fw"></i></div>
                        <div class="col-xs-11">
                            <strong>Erreur:</strong>
                            {{ session('flash')['message'] }}
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="col-xs-12 col-sm-6 col-sm-offset-3">
            {{ Form::open(['route' => ['products.update', $product->id], 'method' => 'put', 'files' => true]) }}

            <div class="row">
                <div class="form-group {{ $errors->has('type') ? 'has-error has-feedback' : '' }} col-sm-6 col-xs-12">
                    {{ Form::label('type', 'Type de produit', ['class' => 'control-label']) }}
                    {{ Form::select('type', $types, $product->type, ['class' => 'form-control', 'id' => 'type']) }}
                    <small class="text-danger pull-right">{{ $errors->first('type') }}</small>
                </div>

                <div class="form-group {{ $errors->has('status') ? 'has-error has-feedback' : '' }} col-sm-6 col-xs-12">
                    {{ Form::label('status', 'Status', ['class' => 'control-label']) }}
                    {{ Form::select('status', $status, $product->status, ['class' => 'form-control', 'id' => 'status']) }}
                    <small class="text-danger pull-right">{{ $errors->first('status') }}</small>
                </div>
            </div>

            <div class="form-group {{ $errors->has('name') ? 'has-error has-feedback' : '' }}">
                {{ Form::label('name', 'Nom', ['class' => 'control-label']) }}
                {{ Form::text('name', $product->name, ['class' => 'form-control']) }}
                <small class="text-danger pull-right">{{ $errors->first('name') }}</small>
            </div>

            <div class="row">
                <div class="form-group {{ $errors->has('weight') ? 'has-error has-feedback' : '' }} col-sm-6 col-xs-12">
                    {{ Form::label('weight', 'Poid (par unité)', ['class' => 'control-label']) }}
                    {{ Form::text('weight', $product->weight, ['class' => 'form-control']) }}
                    <small class="text-danger pull-right">{{ $errors->first('weight') }}</small>
                </div>

                <div class="form-group {{ $errors->has('units') ? 'has-error has-feedback' : '' }} col-sm-6 col-xs-12">
                    {{ Form::label('units', 'Unité de poid', ['class' => 'control-label']) }}
                    {{ Form::select('units', [0 => 'Kilogrammes (Kg)', 1 =>'Grammes (Gr)'], $product->units, ['class' => 'form-control']) }}
                    <small class="text-danger pull-right">{{ $errors->first('units') }}</small>
                </div>
            </div>

            <div class="row">
                <div class="form-group {{ $errors->has('origin') ? 'has-error has-feedback' : '' }} col-sm-6 col-xs-12">
                    {{ Form::label('origin', 'Origine', ['class' => 'control-label']) }}
                    {{ Form::text('origin', $product->origin, ['class' => 'form-control', 'id' => 'origin']) }}
                    <small class="text-danger pull-right">{{ $errors->first('origin') }}</small>
                </div>

                <div class="form-group {{ $errors->has('reference') ? 'has-error has-feedback' : '' }} col-sm-6 col-xs-12">
                    {{ Form::label('reference', 'Référence', ['class' => 'control-label']) }}
                    {{ Form::text('reference', $product->reference, ['class' => 'form-control', 'id' => 'reference']) }}
                    <small class="text-danger pull-right">{{ $errors->first('reference') }}</small>
                </div>
            </div>

            <div class="row">
                <div class="form-group {{ $errors->has('price') ? 'has-error has-feedback' : '' }} col-sm-6 col-xs-12">
                    {{ Form::label('price', 'Prix HT (Utiliser le ".")', ['class' => 'control-label']) }}
                    {{ Form::text('price', $product->price, ['class' => 'form-control', 'id' => 'price']) }}
                    <small class="text-danger pull-right">{{ $errors->first('price') }}</small>
                </div>

                <div class="form-group {{ $errors->has('reference') ? 'has-error has-feedback' : '' }} col-sm-6 col-xs-12">
                    {{ Form::label('taxes', 'TVA ?', ['class' => 'control-label']) }}<br/>
                    <input type="checkbox"
                           name="taxes"
                           data-toggle="toggle"
                           data-on="Oui"
                           data-off="Non"
                           data-onstyle="success"
                           data-offstyle="danger"
                           data-size="medium"
                           {{ $product->taxes ? 'checked' : '' }}
                    />
                </div>
            </div>


            <div class="form-group {{ $errors->has('picture') ? 'has-error has-feedback' : '' }}">
                {{ Form::label('picture', 'Modifier image (max: 2Mo)', ['class' => 'control-label']) }}
                {{ Form::file('picture') }}
                <small class="text-danger pull-right">{{ $errors->first('picture') }}</small><br />
                <img src="{{ $product->picture }}" alt="{{ $product->name }}" width="490" />
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-info alert-with-icon">
                        <div class="col-xs-2">
                            <i class="fa fa-info-circle fa-5x"></i>
                        </div>
                        <div class="col-xs-10">
                            <strong>Administrateur</strong> :
                            <p>Autoriser à la gestion maximale du site, utlisateurs, commandes, paniers</p>

                            <strong>Editeur</strong> :
                            <p>Autoriser à la gestion des commandes, paniers mais pas des utilisateurs</p>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block" style="margin-top: 30px;">
                Sauvegarder
            </button>
            {{ Form::close() }}
        </div>
    </div>
@stop