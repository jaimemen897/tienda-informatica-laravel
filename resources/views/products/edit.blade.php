@extends('main')

@section('title', 'Actualizar Producto')

@section('content')
    <h1>Actualizar Producto</h1>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
            @foreach ($errors->all() as $error)
                {{ $error }} <br>
            @endforeach
        </div>
    @endif

    <form action="{{ route("product.update", $product->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input class="form-control" id="name" name="name" type="text" required value="{{$product->name}}">
        </div>
        <div class="form-group">
            <label for="price">Precio:</label>
            <input class="form-control" id="price" name="price" type="number" step="0.01" required
                   value="{{$product->price}}">
        </div>
        <div class="form-group">
            <label for="category">Categoría:</label>
            <select class="form-select" id="category" name="category_id" required>
                <option value="" disabled>Seleccione una categoría</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{$category->id === $product->category_id ? 'selected' : ''}}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="stock">Stock:</label>
            <input class="form-control" id="stock" name="stock" type="number" required value="{{$product->stock}}">
        </div>
        <div class="form-group mb-3">
            <label for="description">Descripción:</label>
            <textarea class="form-control" id="description" name="description" rows="3"
                      required>{{$product->description}}</textarea>
        </div>

        <button class="btn btn-primary" type="submit">Crear</button>
        <a class="btn btn-secondary mx-2" href="{{ route('product.index') }}">Volver</a>
    </form>

@endsection
