@php use App\Models\Employee; @endphp
@extends('main')

@section('title', 'Editar Empleado')

@section('content')
    <div class="container">
        <h1>Actualizar Empleado</h1>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        <form action="{{ route("employee.update", $employee->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input class="form-control" id="name" name="name" type="text" required value="{{$employee->name}}">
            </div>
            <div class="form-group">
                <label for="surname">Apellidos:</label>
                <input class="form-control" id="surname" name="surname" type="text" required value="{{$employee->surname}}">
            </div>
            <div class="form-group">
                <label for="phone">Teléfono:</label>
                <input class="form-control" id="phone" name="phone" type="text" required value="{{$employee->phone}}">
            </div>
            <div class="form-group">
                <label for="email">Correo:</label>
                <input class="form-control" id="email" name="email" type="email" required value="{{$employee->email}}">
            </div>
            <div class="form-group">
                <label for="salary">Salario:</label>
                <input class="form-control" id="salary" name="salary" type="number" step="0.01" required value="{{$employee->salary}}">
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input class="form-control" id="username" name="username" type="text" required value="{{$employee->username}}">
            </div>
            <div class="form-group mb-3">
                <label for="position">Posición:</label>
                <select class="form-control" id="position" name="position" required>
                    <option value="">Seleccione una posición</option>
                    <option value="Manager" {{ $employee->position == 'Manager' ? 'selected' : '' }}>Manager</option>
                    <option value="Developer" {{ $employee->position == 'Developer' ? 'selected' : '' }}>Developer</option>
                    <option value="Designer" {{ $employee->position == 'Designer' ? 'selected' : '' }}>Designer</option>
                    <option value="Tester" {{ $employee->position == 'Tester' ? 'selected' : '' }}>Tester</option>
                    <option value="Sales" {{ $employee->position == 'Sales' ? 'selected' : '' }}>Sales</option>
                </select>
            </div>

            <button class="btn btn-primary" type="submit">Actualizar</button>
            <a class="btn btn-secondary mx-2" href="{{ route('employee.index') }}">Volver</a>
        </form>
    </div>
@endsection
