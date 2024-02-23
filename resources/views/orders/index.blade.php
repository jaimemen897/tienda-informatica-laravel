@extends('main')

@section('title', 'Pedidos')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
            @foreach ($errors->all() as $error)
                {{ $error }} <br>
            @endforeach
        </div>
    @endif
    <div class="container mt-4 mb-5">
        <h1 class="mb-4">Listado de Pedidos</h1>

        <form action="{{ route('orders.index') }}" class="mb-3" method="get">
            @csrf
            <div class="input-group">
                <input type="text" class="form-control" id="search" name="search" value="{{ $search ?? '' }}"
                       placeholder="Nombre">
                <div class="input-group-append">
                    <button class="btn btn-primary btn-search ms-2" type="submit">
                        <i class="bi bi-search"></i> Buscar
                    </button>
                </div>
            </div>
        </form>

        @if ( count($orders ?? []) > 0 )
            <div class="row">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Total</th>
                        <th scope="col">Nº Productos</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <th scope="row">{{ $order->id }}</th>
                            <td>{{ $order->client->name }}</td>
                            <td>{{ $order->client->address->street }}, {{ $order->client->address->number }}, {{ $order->client->address->city }}, {{ $order->client->address->zipCode }}, {{ $order->client->address->state }}, {{ $order->client->address->country }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>{{ $order->total }}€</td>
                            <td>{{ count($order->lineOrders) }}</td>
                            <td>
                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary">
                                    <i class="bi bi-eye"></i> Ver
                                </a>
                                <form action="{{ route('orders.destroy', $order->id) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="bi bi-trash"></i> Borrar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info mt-4" role="alert">
                No se han encontrado pedidos
            </div>
        @endif



        <div class="pagination-container mt-4 d-flex justify-content-center">
            {{ $orders->links('pagination::bootstrap-5') }}
        </div>

    </div>
@endsection
