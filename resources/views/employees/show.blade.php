@php use App\Models\Employee; @endphp

@extends('main')

@section('title', 'Detalles Empleado')

@section('content')
    <div class="container">
        <h1>Detalles del Empleado</h1>
        <dl class="row mt-4">
            <div class="col-sm-6">
                <dt class="col-sm-2">ID:</dt>
                <dd class="col-sm-10">{{ $employee->id }}</dd>

                <dt class="col-sm-2">Nombre:</dt>
                <dd class="col-sm-10">{{ $employee->name }}</dd>

                <dt class="col-sm-2">Apellido:</dt>
                <dd class="col-sm-10">{{ $employee->surname }}</dd>

                <dt class="col-sm-2">Teléfono:</dt>
                <dd class="col-sm-10">{{ $employee->phone }}</dd>

                <dt class="col-sm-2">Email:</dt>
                <dd class="col-sm-10">{{ $employee->email }}</dd>

                <dt class="col-sm-2">Salario:</dt>
                <dd class="col-sm-10">{{ $employee->salary }}</dd>

                <dt class="col-sm-2">Posición:</dt>
                <dd class="col-sm-10">{{ $employee->position }}</dd>

                <div class="mt-3">
                    <a class="btn btn-primary mb-5" href="{{ route('employee.index') }}">Volver</a>
                </div>
            </div>
            <div class="col-sm-6">
                <dd class="col-sm-10">
                    @if($employee->image != Employee::$IMAGE_DEFAULT)
                        <img alt="Imagen del empleado" class="img-fluid" src="{{ asset('storage/employees/' . $employee->image) }}" width="280" height="280">
                    @else
                        <img alt="Imagen por defecto" class="img-fluid" src="{{ Employee::$IMAGE_DEFAULT }}" width="280" height="280">
                    @endif
                </dd>
            </div>
        </dl>

    </div>
@endsection
