@php use App\Models\Client; @endphp
@extends('main')

@section('title', 'Clientes')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
            @foreach ($errors->all() as $error)
                {{ $error }} <br>
            @endforeach
        </div>
    @endif
    <div class="container mt-4 mb-5">
        <h1 class="mb-4">Listado de Clientes</h1>

        <form action="{{ route('client.index') }}" class="mb-3" method="get">
            @csrf
            <div class="input-group">
                <input type="text" class="form-control" id="search" name="search"
                       placeholder="Nombre, email o número de teléfono">
                <div class="input-group-append">
                    <button class="btn btn-primary btn-search ms-2" type="submit">
                        <i class="bi bi-search"></i> Buscar
                    </button>
                </div>
            </div>
        </form>

        @if ( count($clients ?? []) > 0 )
            <div class="row">
                @foreach ($clients as $client)
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            @if($client->image != Client::$IMAGE_DEFAULT)
                                <div class="divImagePerson">
                                    <a href="{{ route('client.show', $client->id) }}">
                                        <img alt="Imagen del cliente" src="{{ $client->getImageUrl() }}">
                                    </a>
                                </div>
                            @else
                                <div class="divImagePerson">
                                    <a href="{{ route('client.show', $client->id) }}">
                                        <img alt="Imagen por defecto" src="{{ Client::$IMAGE_DEFAULT }}">
                                    </a>
                                </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title text-truncate">{{ $client->name }} {{ $client->surname }}</h5>
                                <p class="card-text text-truncate">{{ $client->email }}</p>
                                <p class="card-text">{{ $client->phone }}</p>
                                <div class="d-flex flex-wrap gap-1">
                                    @if($user instanceof \App\Models\Employee)
                                        <div class="cajaBotones d-flex justify-content-center w-100 gap-1">
                                            <a href="{{ route('client.edit', $client->id) }}"
                                               class="btn btn-secondary botonCaja flex-fill btnEdit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="{{ route('client.editImage', $client->id) }}"
                                               class="btn btn-secondary botonCaja flex-fill">
                                                <i class="bi bi-image"></i>
                                            </a>
                                            <form action="{{ route('client.destroy', $client->id) }}" method="POST"
                                                  class="me-1 flex-fill">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger botonCaja w-100"
                                                        onclick="return confirm('¿Desea borrar este client?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                    <div class="w-100">
                                        <a href="{{ route('client.show', $client->id) }}"
                                           class="btn btn-primary botonCaja w-100">
                                            <i class="bi bi-eye"></i> Detalles
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if($user instanceof \App\Models\Employee)
                <a class="btn btn-success mt-4" href={{ route('client.store') }}>
                    <i class="bi bi-plus"></i> Nuevo Cliente</a>
            @endif
        @else
            <div class="alert alert-warning" role="alert">
                <p class='mb-0'>No se encontraron clientes</p>
            </div>
        @endif

        <div class="pagination-container mt-4 d-flex justify-content-center">
            {{ $clients->links('pagination::bootstrap-5') }}
        </div>

    </div>
@endsection
