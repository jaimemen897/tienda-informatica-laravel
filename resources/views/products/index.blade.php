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
                       placeholder="Nombre">
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
                            <div class="w-100 flex-fill">
                                <a href="{{ route('product.show', $product->id) }}">
                                    <img class="card-img-top p-3" alt="Imagen del producto"
                                         src="{{ $product->getImageUrl() }}">
                                </a>
                                @if($product->stock === '0')
                                    <div
                                        class="position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center bg-secondary bg-opacity-75 rounded-top"
                                        style="backdrop-filter: blur(7px)">
                                        <h3 class="text-white m-0">Agotado</h3>
                                    </div>
                                @endif
                            </div>
                            <div class="card-body">
                                <h5 class="card-title text-truncate">{{ $product->name }}</h5>
                                <small class="card-text">{{$product->category->name}}</small>
                                <p class="card-text">{{ $product->price }}€ - {{ $product->stock }} unidades</p>
                                <p class="card-text text-truncate">{{$product->description}}</p>
                                <div class="d-flex flex-wrap gap-1">
                                    @if($user instanceof \App\Models\Employee)
                                        <div class="cajaBotones d-flex justify-content-center w-100 gap-1">
                                            <a href="{{ route('product.edit', $product->id) }}"
                                               class="btn btn-secondary botonCaja flex-fill btnEdit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="{{ route('product.editImage', $product->id) }}"
                                               class="btn btn-secondary botonCaja flex-fill">
                                                <i class="bi bi-image"></i>
                                            </a>
                                            <form action="{{ route('product.destroy', $product->id) }}" method="POST"
                                                  class="me-1 flex-fill">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger botonCaja w-100"
                                                        onclick="return confirm('¿Desea borrar este producto?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @endif

                                    @if($user)
                                        <div class="d-flex w-100 gap-1">
                                            <a href="{{ route('product.show', $product->id) }}"
                                               class="btn btn-primary botonCaja flex-fill w-100">
                                                <i class="bi bi-eye"></i> Detalles
                                            </a>
                                            <form method="POST" class="w-100" action="{{route('cart.add')}}">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button type="submit"
                                                        class="btn btn-success botonCaja w-100" {{$product->stock === '0' ? 'disabled' : ''}}>
                                                    <i class="bi bi-cart"></i> Añadir al carrito
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <div class="w-100 d-flex gap-2">
                                            <a href="{{ route('product.show', $product->id) }}"
                                               class="btn btn-primary botonCaja flex-fill w-100">
                                                <i class="bi bi-eye"></i> Detalles
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($user instanceof \App\Models\Employee)
                <a class="btn btn-success mt-4" href={{ route('product.store') }}>
                    <i class="bi bi-plus"></i> Nuevo Producto</a>
            @endif
        @else
            <div class="alert alert-warning" role="alert">
                <p class='mb-0'>No se encontraron productos</p>
            </div>
        @endif

        <div class="pagination-container mt-4 d-flex justify-content-center">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>

    </div>
@endsection
