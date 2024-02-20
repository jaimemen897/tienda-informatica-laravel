@php use App\Models\Client; @endphp
@extends('main')

@section('title', 'Crear Cliente')

@section('content')
    <h1>Crear Cliente</h1>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
            @foreach ($errors->all() as $error)
                {{ $error }} <br>
            @endforeach
        </div>
    @endif

    <form action="{{ route("client.store") }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input class="form-control" id="name" name="name" type="text" value="{{ old('name') }}" required>
        </div>
        <div class="form-group">
            <label for="surname">Apellido:</label>
            <input class="form-control" id="surname" name="surname" type="text" value="{{ old('surname') }}" required>
        </div>
        <div class="form-group">
            <label for="phone">Teléfono:</label>
            <input class="form-control" id="phone" name="phone" type="text" value="{{ old('phone') }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input class="form-control" id="email" name="email" type="email" step="0.01" value="{{ old('email') }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="password">Contraseña:</label>
            <input class="form-control" id="password" name="password" type="password" required>
        </div>

        <button class="btn btn-primary" type="submit">Crear</button>
        <a class="btn btn-secondary mx-2" href="{{ route('client.index') }}">Volver</a>
    </form>

@endsection
