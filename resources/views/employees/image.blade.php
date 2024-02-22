@php use App\Models\Employee; @endphp

@extends('main')

@section('title', 'Editar Imagen de Empleado')

@section('content')
    <div class="container">
        <h1>Editar Imagen de Empleado</h1>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        <dl class="row">
            <div class="col-sm-6">
                <dt class="col-sm-2">ID:</dt>
                <dd class="col-sm-10">{{$employee->id}}</dd>
                <dt class="col-sm-2">Nombre:</dt>
                <dd class="col-sm-10">{{$employee->name}}</dd>
                <dt class="col-sm-2">Apellidos:</dt>
                <dd class="col-sm-10">{{$employee->surname}}</dd>
                <dt class="col-sm-2">Teléfono:</dt>
                <dd class="col-sm-10">{{$employee->phone}}</dd>
                <dt class="col-sm-2">Correo:</dt>
                <dd class="col-sm-10">{{$employee->email}}</dd>
                <form action="{{ route("employee.updateImage", $employee->id) }}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group mb-3">
                        <label for="image"><strong>Imagen:</strong></label> <br>
                        <input accept="image/*" class="form-control-file" id="image" name="image" required type="file">
                        <small class="text-danger"></small>
                    </div>

                    <button class="btn btn-primary mb-5" type="submit">Actualizar</button>
                    <a class="btn btn-secondary mx-2 mb-5" href="{{ route('employee.index') }}">Volver</a>
                </form>
            </div>
            <div class="col-sm-6">
                <dt class="col-sm-2">Imagen:</dt>
                <dd class="col-sm-10">
                    @if($employee->image != Employee::$IMAGE_DEFAULT)
                        <img alt="Imagen del empleado" class="img-fluid"
                             src="{{ asset('storage/employees/' . $employee->image) }}"
                             width="300" height="300">
                    @else
                        <img alt="Imagen por defecto" class="img-fluid" src="{{ Employee::$IMAGE_DEFAULT }}" width="300"
                             height="300">
                    @endif
                </dd>
            </div>
        </dl>
    </div>
@endsection
