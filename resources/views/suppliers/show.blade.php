@php use App\Models\Supplier; @endphp

@extends('main')

@section('title', 'Detalles Proveedor')

@section('content')
    <div class="container">
        <h1>Detalles del Proveedor</h1>
        <dl class="row mt-4">
            <div class="col-sm-6">
                <dt class="col-sm-2">ID:</dt>
                <dd class="col-sm-10">{{ $supplier->id }}</dd>

                <dt class="col-sm-2">Nombre:</dt>
                <dd class="col-sm-10">{{ $supplier->name }}</dd>

                <dt class="col-sm-2">Contacto:</dt>
                <dd class="col-sm-10">{{ $supplier->contact }}</dd>

                <dt class="col-sm-2">Dirección:</dt>
                <dd class="col-sm-10">{{ $supplier->address }}</dd>
            </div>
            <div class="col-sm-6">
                <h4 class="mt-4">Productos</h4>
                <ul>
                    @foreach ($supplier->products as $product)
                        <li class="mb-1">{{ $product->name }}</li>
                    @endforeach
                </ul>

            </div>
            <div class="mt-3">
                <a class="btn btn-primary mb-5" href="{{ route('supplier.index') }}">Volver</a>
            </div>
        </dl>
    </div>
@endsection
