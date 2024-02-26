@php use App\Models\Employee; @endphp
@extends('main')

@section('title', 'Home')

@section('content')
    <div class="container">
        <h1>Perfil del usuario</h1>
        <dl class="row mt-4">
            <div class="col-sm-6">
                <dt class="col-sm-2">ID:</dt>
                <dd class="col-sm-10">{{ $user->id }}</dd>

                <dt class="col-sm-2">Nombre:</dt>
                <dd class="col-sm-10">{{ $user->name }} {{ $user->surname }}</dd>

                <dt class="col-sm-2">Email:</dt>
                <dd class="col-sm-10">{{ $user->email }}</dd>

                @if($user instanceof Employee)
                    <dt class="col-sm-2">Posición:</dt>
                    <dd class="col-sm-10">{{ $user->position }}</dd>
                @endif


                <div class="mt-3">
                    <a class="btn btn-primary mb-5" href="{{ route('client.index') }}">Volver</a>
                    <a class="btn btn-primary mb-5" href="{{ route('profile.edit', $user->id) }}">Editar</a>
                </div>
            </div>
            <div class="col-sm-6">
                {{--TODO: INCLUIR PEDIDOS CUANDO SE HAGAN--}}
            </div>
        </dl>

    </div>
@endsection
