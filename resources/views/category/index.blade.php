@extends('main')

@section('title', 'Categorías')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
            @foreach ($errors->all() as $error)
                {{ $error }} <br>
            @endforeach
        </div>
    @endif
    <div class="container mt-4 mb-5">
        <h1 class="mb-4">Lista de Categorías</h1>

        <form action="{{ route('category.index') }}" class="mb-3" method="get">
            @csrf
            <div class="input-group">
                <input type="text" class="form-control" id="search" name="search"
                       placeholder="Nombre">
                <div class="input-group-append">
                    <button class="btn btn-primary btn-search ms-2" type="submit">
                        <i class="bi bi-search"></i> Buscar
                    </button>
                </div>
            </div>
        </form>

        @if ( count($categories ?? []) > 0 )
            <table class="table">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a href="{{ route('category.show', $category->id) }}" class="btn btn-primary">
                                <i class="bi bi-eye"></i> Detalles
                            </a>
                            <a href="{{ route('category.edit', $category->id) }}" class="btn btn-secondary">
                                <i class="bi bi-pencil"></i> Editar
                            </a>
                            @if($category->trashed())
                                <a href="{{route('category.activate', $category->id)}}"
                                   class="btn btn-success">Activar</a>
                            @else
                                <a href="{{route('category.deactivate', $category->id)}}" class="btn btn-warning">Desactivar</a>
                            @endif
                            @if($category->products()->count() === 0)
                                <form action="{{ route('category.destroy', $category->id) }}" method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('¿Desea borrar esta categoría?')">
                                        <i class="bi bi-trash"></i> Borrar
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-warning" role="alert">
                <p class='mb-0'>
                    No se encontraron categorías
                </p>
            </div>
        @endif

        <a href="{{ route('category.store') }}" class="btn btn-success">
            <i class="bi bi-plus"></i> Crear
        </a>
        <div class="pagination-container mt-4 d-flex justify-content-center">
            {{ $categories->links('pagination::bootstrap-5') }}
        </div>

    </div>
@endsection
