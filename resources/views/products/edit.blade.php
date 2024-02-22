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
    <form action="{{ route("product.update", $product->id) }}" method="post" class="mb-5">
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
            <label for="supplier">Proveedor:</label>
            <select class="form-select" id="supplier" name="supplier_id" required>
                <option value="" disabled>Seleccione un proveedor</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{$supplier->id === $product->supplier_id ? 'selected' : ''}}>{{ $supplier->name }}</option>
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

        <button class="btn btn-primary mb-5" type="submit">Crear</button>
        <a class="btn btn-secondary mx-2 mb-5" href="{{ route('product.index') }}">Volver</a>
    </form>

@endsection
