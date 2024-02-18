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
        <br/>
    @endif

    <form action="{{ route("client.store") }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input class="form-control" id="name" name="name" type="text" required>
        </div>
        <div class="form-group mb-3">
            <label for="email">Email:</label>
            <input class="form-control" id="email" name="email" type="email" step="0.01" required>
        </div>

        <button class="btn btn-primary" type="submit">Crear</button>
        <a class="btn btn-secondary mx-2" href="{{ route('client.index') }}">Volver</a>
    </form>

@endsection
