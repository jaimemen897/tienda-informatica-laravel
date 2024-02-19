@php use App\Models\Employee; @endphp
@extends('main')

@section('title', 'Crear Empleado')

@section('content')
    <h1>Crear Empleado</h1>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
            @foreach ($errors->all() as $error)
                {{ $error }} <br>
            @endforeach
        </div>
    @endif

    <form action="{{ route("employee.store") }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input class="form-control" id="name" name="name" type="text" required>
        </div>
        <div class="form-group">
            <label for="surname">Apellido:</label>
            <input class="form-control" id="surname" name="surname" type="text" required>
        </div>
        <div class="form-group">
            <label for="phone">Teléfono:</label>
            <input class="form-control" id="phone" name="phone" type="text" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input class="form-control" id="email" name="email" type="email" required>
        </div>
        <div class="form-group">
            <label for="salary">Salario:</label>
            <input class="form-control" id="salary" name="salary" type="number" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="position">Posición:</label>
            <select class="form-control" id="position" name="position" required>
                <option value="">Seleccione una posición</option>
                <option value="Manager">Manager</option>
                <option value="Developer">Developer</option>
                <option value="Designer">Designer</option>
                <option value="Tester">Tester</option>
                <option value="Sales">Sales</option>
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="password">Contraseña:</label>
            <input class="form-control" id="password" name="password" type="password" required>
        </div>

        <button class="btn btn-primary" type="submit">Crear</button>
        <a class="btn btn-secondary mx-2" href="{{ route('employee.index') }}">Volver</a>
    </form>

@endsection
