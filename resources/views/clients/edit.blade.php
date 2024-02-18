@php use App\Models\Client; @endphp
@extends('main')

@section('title', 'Editar Cliente')

@section('content')
    <div class="container">
        <h1>Actualizar Cliente</h1>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        <form action="{{ route("client.update", $client->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input class="form-control" id="name" name="name" type="text" required value="{{$client->name}}">
            </div>
            <div class="form-group">
                <label for="surname">Apellidos:</label>
                <input class="form-control" id="surname" name="surname" type="text" required value="{{$client->surname}}">
            </div>
            <div class="form-group">
                <label for="phone">Teléfono:</label>
                <input class="form-control" id="phone" name="phone" type="text" required value="{{$client->phone}}">
            </div>
            <div class="form-group mb-3">
                <label for="email">Correo:</label>
                <input class="form-control" id="email" name="email" type="email" required value="{{$client->email}}">
            </div>

            <button class="btn btn-primary" type="submit">Actualizar</button>
            <a class="btn btn-secondary mx-2" href="{{ route('client.index') }}">Volver</a>
        </form>
    </div>
@endsection
