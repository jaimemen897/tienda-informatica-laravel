@php use App\Models\Employee; @endphp
@extends('main')

@section('title', 'Empleados')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
            @foreach ($errors->all() as $error)
                {{ $error }} <br>
            @endforeach
        </div>
    @endif
    <div class="container mt-4 mb-5">
        <h1 class="mb-4">Listado de Empleados</h1>

        <form action="{{ route('employee.index') }}" class="mb-3" method="get">
            @csrf
            <div class="input-group">
                <input type="text" class="form-control" id="search" name="search"
                       placeholder="Nombre, email, número de teléfono o posición">
                <div class="input-group-append">
                    <button class="btn btn-primary btn-search ms-2" type="submit">
                        <i class="bi bi-search"></i> Buscar
                    </button>
                </div>
            </div>
        </form>

        @if ( count($employees ?? []) > 0 )
            <div class="row">
                @foreach ($employees as $employee)
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            @if($employee->image != Employee::$IMAGE_DEFAULT)
                                <div class="divImagePerson">

                                    <a href="{{ route('employee.show', $employee->id) }}">
                                        <img alt="Imagen del empleado" src="{{ $employee->getImageUrl() }}">
                                    </a>
                                </div>
                            @else
                                <div class="divImagePerson">
                                    <a href="{{ route('employee.show', $employee->id) }}">
                                        <img alt="Imagen por defecto" src="{{ Employee::$IMAGE_DEFAULT }}"> </a>
                                </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title text-truncate">{{ $employee->name }} {{ $employee->surname }}</h5>
                                <p class="card-text text-truncate">{{ $employee->email }}</p>
                                <p class="card-text">{{ $employee->phone }}</p>
                                <div class="d-flex flex-wrap gap-1">
                                    @if($user instanceof \App\Models\Employee)
                                        <div class="cajaBotones d-flex w-100 gap-1">
                                            <a href="{{ route('employee.edit', $employee->id) }}"
                                               class="btn btn-secondary flex-fill botonCaja btnEdit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="{{ route('employee.editImage', $employee->id) }}"
                                               class="btn btn-secondary flex-fill botonCaja">
                                                <i class="bi bi-image"></i>
                                            </a>
                                            <form action="{{ route('employee.destroy', $employee->id) }}" method="POST"
                                                  class="me-1 flex-fill">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger botonCaja w-100"
                                                        onclick="return confirm('¿Desea borrar este empleado?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                    <div class="w-100">
                                        <a href="{{ route('employee.show', $employee->id) }}"
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
                <a class="btn btn-success mt-4" href={{ route('employee.store') }}><i class="bi bi-plus"></i> Nuevo
                    Empleado</a>
            @endif
        @else
            <div class="alert alert-warning" role="alert">
                <p class='mb-0'>
                    No se encontraron empleados
                </p>
            </div>
        @endif

        <div class="pagination-container mt-4 d-flex justify-content-center">
            {{ $employees->links('pagination::bootstrap-5') }}
        </div>

    </div>
@endsection
