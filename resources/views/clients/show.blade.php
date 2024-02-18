@php use App\Models\Client; @endphp

@extends('main')

@section('title', 'Detalles Cliente')

@section('content')
    <div class="container">
        <h1>Detalles del Cliente</h1>
        <dl class="row mt-4">
            <div class="col-sm-6">
                <dt class="col-sm-2">ID:</dt>
                <dd class="col-sm-10">{{ $client->id }}</dd>

                <dt class="col-sm-2">Nombre:</dt>
                <dd class="col-sm-10">{{ $client->name }}</dd>

                <dt class="col-sm-2">Apellido:</dt>
                <dd class="col-sm-10">{{ $client->surname }}</dd>

                <dt class="col-sm-2">Teléfono:</dt>
                <dd class="col-sm-10">{{ $client->phone }}</dd>

                <dt class="col-sm-2">Email:</dt>
                <dd class="col-sm-10">{{ $client->email }}</dd>

                <div class="mt-3">
                    <a class="btn btn-primary" href="{{ route('client.index') }}">Volver</a>
                </div>
            </div>
            <div class="col-sm-6">
                <dt class="col-sm-2">Imagen:</dt>
                <dd class="col-sm-10">
                    @if($client->image != Client::$IMAGE_DEFAULT)
                        <img alt="Imagen del client" class="img-fluid" src="{{ asset('storage/clients/' . $client->image) }}" width="280" height="280">
                    @else
                        <img alt="Imagen por defecto" class="img-fluid" src="{{ Client::$IMAGE_DEFAULT }}" width="280" height="280">
                    @endif
                </dd>
            </div>
        </dl>

    </div>
@endsection
