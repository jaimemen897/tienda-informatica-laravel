@extends('main')

@section('title', 'Editar Categoría')

@section('content')
    <div class="container">
        <h1>Actualizar Categoría</h1>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        <form action="{{ route("category.update", $category->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input class="form-control" id="name" name="name" type="text" required value="{{$category->name}}">
            </div>
            <button class="btn btn-primary mb-5" type="submit">Actualizar</button>
            <a class="btn btn-secondary mx-2 mb-5" href="{{ route('category.index') }}">Volver</a>
        </form>
    </div>
@endsection
