@extends('main')
@section('title', 'Confirmar token')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">{{ 'Insertar el token' }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('token.verify') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="token" class="form-label">{{ __('Token') }}</label>
                                <input id="token" type="text" class="form-control @error('token') is-invalid @enderror" name="token" value="{{ old('token') }}" required autofocus>
                                @error('token')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-light">
                                    {{ __('Comprobar') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
