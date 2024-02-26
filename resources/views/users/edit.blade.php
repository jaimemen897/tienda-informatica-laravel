@php use App\Models\User; @endphp

@extends('main')

@section('title', 'Editar Perfil')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif

    <form action="{{ route("profile.update", $user->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input class="form-control" id="name" name="name" type="text" required value="{{$user->name}}">
        </div>
        <div class="form-group">
            <label for="surname">Apellido:</label>
            <input class="form-control" id="surname" name="surname" type="text" required value="{{$user->surname}}">
        </div>
        <div class="form-group mb-3">
            <label for="password">Contraseña:</label>
            <input class="form-control" id="password" name="password" type="text" required>
        </div>

        <button class="btn btn-primary mb-5" type="submit">Actualizar</button>
        <a class="btn btn-secondary mx-2 mb-5" href="{{ route('profile.index') }}">Volver</a>
    </form>
@endsection

