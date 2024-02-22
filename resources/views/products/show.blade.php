@extends('main')

@section('title', 'Detalles Cliente')

@section('content')
    <div class="container">
        <h1>Detalles del producto</h1>
        <dl class="row mt-4">
            <div class="col-sm-6">
                <dt class="col-sm-2">Nombre:</dt>
                <dd class="col-sm-10">{{ $product->name }}</dd>

                <dt class="col-sm-2">Categoria:</dt>
                <dd class="col-sm-10">{{ $product->category->name }}</dd>

                <dt class="col-sm-2">Precio:</dt>
                <dd class="col-sm-10">{{ $product->price }}€</dd>

                <dt class="col-sm-2">Stock:</dt>
                <dd class="col-sm-10">{{ $product->stock }} unidades</dd>

                <dt class="col-sm-2">Descripción:</dt>
                <dd class="col-sm-10">{{ $product->description }}</dd>

                <dt class="col-sm-2">Proveedor:</dt>
                <dd class="col-sm-10">{{ $product->supplier->name }}</dd>

                <div class="mt-3">
                    <a class="btn btn-primary mb-5" href="{{ route('product.index') }}">Volver</a>
                </div>
            </div>
            <div class="col-sm-6">
                <dd class="col-sm-10">
                    <img alt="Imagen del producto" class="img-fluid" src="{{ $product->getImageUrl() }}" width="280"
                         height="280">
                </dd>
            </div>
        </dl>

    </div>
@endsection
