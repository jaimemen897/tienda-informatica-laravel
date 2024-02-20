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
        <h1 class="mb-4">Listado de Productos</h1>

        <form action="{{ route('product.index') }}" class="mb-3" method="get">
            @csrf
            <div class="input-group">
                <input type="text" class="form-control" id="search" name="search" value="{{ $search ?? '' }}"
                       placeholder="Nombre, email o número de teléfono">
                <div class="input-group-append">
                    <button class="btn btn-primary btn-search ms-2" type="submit">
                        <i class="bi bi-search"></i> Buscar
                    </button>
                </div>
            </div>
        </form>

        @if ( count($products ?? []) > 0 )
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="divImage">
                                <img class="card-img-top" alt="Imagen del client"
                                     src="{{ $product->getImageUrl() }}">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <small class="card-text">{{$product->category->name}}</small>
                                <p class="card-text">{{ $product->price }}€</p>
                                <p class="card-text">{{ $product->stock }} unidades</p>
                                <p class="card-text text-truncate">{{$product->description}}</p>
                                <div class="d-flex flex-wrap">
                                    @if(auth()->user() && auth()->user()->role == 'admin')
                                        <div class="cajaBotones w-100">
                                            <form action="{{ route('product.destroy', $product->id) }}" method="POST"
                                                  class="me-1">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger botonCaja w-100"
                                                        onclick="return confirm('¿Desea borrar este producto?')">
                                                    <i class="bi bi-trash"></i> Borrar
                                                </button>
                                            </form>
                                            <a href="{{ route('product.edit', $product->id) }}"
                                               class="btn btn-secondary botonCaja">
                                                <i class="bi bi-pencil"></i> Editar
                                            </a>
                                            <a href="{{ route('product.editImage', $product->id) }}"
                                               class="btn btn-info botonCaja">
                                                <i class="bi bi-image"></i> Imagen
                                            </a>
                                        </div>
                                    @endif
                                    <div class="w-100">
                                        <a href="{{ route('product.show', $product->id) }}"
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
            @if(auth()->user() && auth()->user()->role == 'admin')
                <a class="btn btn-success mt-4" href={{ route('product.store') }}><i class="bi bi-plus"></i> Nuevo
                    Producto</a>
            @endif
        @else
            <div class="alert alert-warning" role="alert">
                <p class='mb-0'>
                    No se encontraron productos
                </p>
            </div>
        @endif

        <div class="pagination-container mt-4 d-flex justify-content-center">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>

    </div>
@endsection