@extends('main')

@section('title', 'Detalles Categoría')

@section('content')
    <div class="container">
        <h1>Detalles de la categoría</h1>
        <dl class="row mt-4">
            <div class="col-sm-6">
                <dt class="col-sm-2">ID:</dt>
                <dd class="col-sm-10">{{ $category->id }}</dd>

                <dt class="col-sm-2">Nombre:</dt>
                <dd class="col-sm-10">{{ $category->name }}</dd>

                <div class="mt-3">
                    <a class="btn btn-primary" href="{{ route('category.index') }}">Volver</a>
                </div>
            </div>
        </dl>
    </div>
@endsection
