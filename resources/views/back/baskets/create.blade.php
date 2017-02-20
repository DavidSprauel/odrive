@extends('back.template.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Paniers
                <small>Ajouter un panier</small>
                <a class="btn btn-md btn-primary pull-right" href="{{ route('baskets.index') }}">
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
            {{ Form::open(['route' => 'baskets.store', 'method' => 'post', 'files' => true]) }}

            <div class="form-group {{ $errors->has('name') ? 'has-error has-feedback' : '' }}">
                {{ Form::label('name', 'Nom', ['class' => 'control-label']) }}
                {{ Form::text('name', null, ['class' => 'form-control']) }}
                <small class="text-danger pull-right">{{ $errors->first('name') }}</small>
            </div>

            <div class="form-group {{ $errors->has('description') ? 'has-error has-feedback' : '' }}">
                {{ Form::label('description', 'Description', ['class' => 'control-label']) }}
                {{ Form::textarea('description', null, ['class' => 'form-control']) }}
                <small class="text-danger pull-right">{{ $errors->first('description') }}</small>
            </div>

            <div class="row">
                <div class="form-group {{ $errors->has('price') ? 'has-error has-feedback' : '' }} col-sm-6 col-xs-12">
                    {{ Form::label('price', 'Prix HT (Utiliser le ".")', ['class' => 'control-label']) }}
                    {{ Form::text('price', null, ['class' => 'form-control', 'id' => 'price']) }}
                    <small class="text-danger pull-right">{{ $errors->first('price') }}</small>
                </div>

                <div class="form-group {{ $errors->has('status') ? 'has-error has-feedback' : '' }} col-sm-6 col-xs-12">
                    {{ Form::label('status', 'Status', ['class' => 'control-label']) }}
                    {{ Form::select('status', $status, null, ['class' => 'form-control', 'id' => 'status']) }}
                    <small class="text-danger pull-right">{{ $errors->first('status') }}</small>
                </div>
            </div>

            <div class="form-group {{ $errors->has('picture') ? 'has-error has-feedback' : '' }}">
                {{ Form::label('picture', 'Modifier image (max: 2Mo)', ['class' => 'control-label']) }}
                {{ Form::file('picture') }}
                <small class="text-danger pull-right">{{ $errors->first('picture') }}</small><br />
            </div>

            <h4>Ajouter des produits</h4>
            <hr />
            <?php
                $quantity = [];
                for($i = 1; $i <= 5; $i++) {
                    $quantity[$i] = $i;
                }
            ?>

            <div class="productAddBlock">
                <div class="row productAdd">
                    <div class="form-group {{ $errors->has('product') ? 'has-error has-feedback' : '' }} col-xs-12 col-sm-8">
                        {{ Form::label('product', 'Produit', ['class' => 'control-label']) }}
                        {{ Form::select('products[]', $products, null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group {{ $errors->has('product') ? 'has-error has-feedback' : '' }} col-xs-12 col-sm-3">
                        {{ Form::label('quantity', 'Quantité', ['class' => 'control-label']) }}
                        {{ Form::select('quantity[]', $quantity, 0, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="row productAdd templateProduct">
                    <div class="form-group {{ $errors->has('product') ? 'has-error has-feedback' : '' }} col-xs-12 col-sm-8">
                        {{ Form::select('products[]', $products, null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group {{ $errors->has('product') ? 'has-error has-feedback' : '' }} col-xs-11 col-sm-3">
                        {{ Form::select('quantity[]', $quantity, 0, ['class' => 'form-control']) }}
                    </div>
                </div>
            </div>

            <button class="btn btn-success" id="addProduct" type="button">
                <i class="fa fa-fw fa-plus"></i> Ajouter des produits
            </button>

            <button type="submit" class="btn btn-primary btn-block" style="margin-top: 30px;">
                Ajouter nouveau panier
            </button>
            {{ Form::close() }}
        </div>
    </div>
@stop

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#addProduct').on('click', function(){
                var btn = $(this);
                var block = $('.templateProduct:first');
                var newBlock = block.clone();
                newBlock.append('<div class="col-sm-1 deleteProduct" title="Supprimer" style="cursor: pointer;margin-top: 3px"><i class="fa fa-fw fa-2x fa-minus-circle text-danger"></i></div>')

                newBlock.appendTo($('.productAddBlock'));
            });

            $(document).on('click', '.deleteProduct', function(){
                var btn = $(this);
                var block = btn.parent('.productAdd');
                block.remove();
            });
        });
    </script>
@stop