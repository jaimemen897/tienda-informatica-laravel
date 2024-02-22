@php use App\Models\Supplier; @endphp
@extends('main')

@section('title', 'Proveedores')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
            @foreach ($errors->all() as $error)
                {{ $error }} <br>
            @endforeach
        </div>
    @endif
    <div class="container mt-4 mb-5">
        <h1 class="mb-4">Lista de Proveedores</h1>

        <form action="{{ route('supplier.index') }}" class="mb-3" method="get">
            @csrf
            <div class="input-group">
                <input type="text" class="form-control" id="search" name="search"
                       placeholder="Nombre, Contacto, o Dirección">
                <div class="input-group-append">
                    <button class="btn btn-primary btn-search ms-2" type="submit">
                        <i class="bi bi-search"></i> Buscar
                    </button>
                </div>
            </div>
        </form>

        @if ( count($suppliers ?? []) > 0 )
            <table class="table">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Contacto</th>
                    <th>Dirección</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($suppliers as $supplier)
                    <tr>
                        <td>{{ $supplier->name }}</td>
                        <td>{{ $supplier->contact }}</td>
                        <td>{{ $supplier->address }}</td>
                        <td>
                            <a href="{{ route('supplier.show', $supplier->id) }}" class="btn btn-primary">
                                <i class="bi bi-eye"></i> Detalles
                            </a>
                            <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btnEdit">
                                <i class="bi bi-pencil"></i> Editar
                            </a>
                            <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Desea borrar este proveedor?')">
                                    <i class="bi bi-trash"></i> Borrar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-warning" role="alert">
                <p class='mb-0'>
                    No se encontraron proveedores
                </p>
            </div>
        @endif
        <a class="btn btn-success mt-4" onclick="window.location='{{ route('supplier.create') }}'">
            <i class="bi bi-plus"></i> Agregar Proveedor
        </a>

        <div class="pagination-container mt-4 d-flex justify-content-center">
            {{ $suppliers->links('pagination::bootstrap-5') }}
        </div>

    </div>
@endsection
