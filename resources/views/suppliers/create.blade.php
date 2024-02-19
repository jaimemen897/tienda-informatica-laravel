@php use App\Models\Supplier; @endphp

@extends('main')

@section('title', 'Crear Proveedor')

@section('content')
    <h1>Crear Proveedor</h1>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
            @foreach ($errors->all() as $error)
                {{ $error }} <br>
            @endforeach
        </div>
    @endif

    <form action="{{ route("supplier.store") }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input class="form-control" id="name" name="name" type="text" required>
        </div>
        <div class="form-group">
            <label for="contact">Contacto:</label>
            <input class="form-control" id="contact" name="contact" type="text" required>
        </div>
        <div class="form-group mb-3">
            <label for="address">Dirección:</label>
            <input class="form-control" id="address" name="address" type="text" required>
        </div>

        <button class="btn btn-primary" type="submit">Crear</button>
        <a class="btn btn-secondary mx-2" href="{{ route('supplier.index') }}">Volver</a>
    </form>
@endsection
