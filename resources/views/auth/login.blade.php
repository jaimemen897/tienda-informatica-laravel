@extends('main')
@section('title', 'Inicio de sesión')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">{{ __('Iniciar sesión como cliente') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login.client') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Email') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Contraseña') }}</label>
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       required autocomplete="current-password">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-center gap-5">
                                <button type="submit" class="btn btn-primary w-50">{{ __('Iniciar sesión') }}</button>
                                <a href="{{ route('login.employee') }}" class="btn btn-secondary w-50">Iniciar sesión
                                    como empleado</a>
                            </div>

                            <div class="d-flex justify-content-center mt-3">
                                <a href="{{ route('register') }}" class="btn btn-link">¿No tienes una cuenta? Regístrate</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
