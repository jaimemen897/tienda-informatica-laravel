@extends('main')

@section('title', 'Crear Categoría')

@section('content')
    <h1>Crear Categoría</h1>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
            @foreach ($errors->all() as $error)
                {{ $error }} <br>
            @endforeach
        </div>
    @endif

    <form action="{{ route("category.store") }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input class="form-control" id="name" name="name" type="text" required>
        </div>
        <button class="btn btn-primary mb-5" type="submit">Crear</button>
        <a class="btn btn-secondary mx-2 mb-5" href="{{ route('category.index') }}">Volver</a>
    </form>
@endsection
