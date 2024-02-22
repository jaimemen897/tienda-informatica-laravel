@php use App\Models\Supplier; @endphp

@extends('main')

@section('title', 'Editar Proveedor')

@section('content')
    <div class="container">
        <h1>Actualizar Proveedor</h1>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        <form action="{{ route("supplier.update", $supplier->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input class="form-control" id="name" name="name" type="text" required value="{{$supplier->name}}">
            </div>
            <div class="form-group">
                <label for="contact">Contacto:</label>
                <input class="form-control" id="contact" name="contact" type="text" required value="{{$supplier->contact}}">
            </div>
            <div class="form-group mb-3">
                <label for="address">Dirección:</label>
                <input class="form-control" id="address" name="address" type="text" required value="{{$supplier->address}}">
            </div>

            <button class="btn btn-primary mb-5" type="submit">Actualizar</button>
            <a class="btn btn-secondary mx-2 mb-5" href="{{ route('supplier.index') }}">Volver</a>
        </form>
    </div>
@endsection
