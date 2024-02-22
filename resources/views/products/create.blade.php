@extends('main')

@section('title', 'Crear Producto')

@section('content')
    <h1>Crear Producto</h1>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
            @foreach ($errors->all() as $error)
                {{ $error }} <br>
            @endforeach
        </div>
    @endif

    <form action="{{ route("product.store") }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input class="form-control" id="name" name="name" type="text" required value="{{old('name')}}">
        </div>
        <div class="form-group">
            <label for="price">Precio:</label>
            <input class="form-control" id="price" name="price" type="number" step="0.01" required
                   value="{{old('price')}}">
        </div>
        <div class="form-group">
            <label for="category">Categoría:</label>
            <select class="form-select" id="category" name="category_id" required>
                <option value="" disabled selected>Seleccione una categoría</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="supplier">Proveedor:</label>
            <select class="form-select" id="supplier" name="supplier_id" required>
                <option value="" disabled selected>Seleccione un proveedor</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="stock">Stock:</label>
            <input class="form-control" id="stock" name="stock" type="number" required value="{{old('stock')}}">
        </div>
        <div class="form-group mb-3">
            <label for="description">Descripción:</label>
            <textarea class="form-control" id="description" name="description" rows="3"
                      required>{{old('description')}}</textarea>
        </div>
        <button class="btn btn-primary mb-5" type="submit">Crear</button>
        <a class="btn btn-secondary mx-2 mb-5" href="{{ route('product.index') }}">Volver</a>
    </form>

@endsection
