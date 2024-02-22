@extends('main')

@section('title', 'Editar Imagen de Producto')

@section('content')
    <div class="container">
        <h1>Editar Imagen de Producto</h1>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        <dl class="row">
            <div class="col-sm-6">
                <dt class="col-sm-2">ID:</dt>
                <dd class="col-sm-10">{{$product->id}}</dd>
                <dt class="col-sm-2">Nombre:</dt>
                <dd class="col-sm-10">{{$product->name}}</dd>
                <dt class="col-sm-2">Categoría:</dt>
                <dd class="col-sm-10">{{$product->category->name}}</dd>
                <dt class="col-sm-2">Stock:</dt>
                <dd class="col-sm-10">{{$product->stock}} unidades</dd>
                <dt class="col-sm-2">Precio:</dt>
                <dd class="col-sm-10">{{$product->price}}€</dd>
                <form action="{{ route("product.updateImage", $product->id) }}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group mb-3">
                        <label for="image"><strong>Imagen:</strong></label> <br>
                        <input accept="image/*" class="form-control-file" id="image" name="image" required type="file">
                        <small class="text-danger"></small>
                    </div>

                    <button class="btn btn-primary mb-5" type="submit">Actualizar</button>
                    <a class="btn btn-secondary mx-2 mb-5" href="{{ route('product.index') }}">Volver</a>
                </form>
            </div>
            <div class="col-sm-6">
                <dd class="col-sm-10">
                    <img alt="Imagen del client" class="img-fluid"
                         src="{{ $product->getImageUrl() }}"
                         width="300" height="300">
                </dd>
            </div>
        </dl>
    </div>
@endsection
