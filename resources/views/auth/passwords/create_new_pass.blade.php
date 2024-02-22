@extends('main')
@section('title', 'Crear contraseña')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">{{ 'Inserte la nueva contraseña' }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="pwd" class="form-label">{{ __('Nueva contraseña') }}</label>

                                <input type="hidden" name="token" value="{{ $token }}">

                                <input id="email" type="email" class="form-control" name="email"
                                       value="{{ $email ?? old('email') }}"
                                       required autocomplete="email" autofocus>

                                <input id="pwd" type="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       name="password" required autocomplete="new-password">

                                <input id="password_confirmation" type="password" class="form-control"
                                       name="password_confirmation" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Establecer nueva contraseña') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
