@extends('main')

@section('title', 'Detalles Producto')

@section('content')
    <div class="container">
        <h1>Detalles del pedido</h1>
        <dl class="row mt-4">
            <div class="col-sm-4">
                <dt class="col-sm-2">ID:</dt>
                <dd class="col-sm-10">{{ $order->id }}</dd>

                <dt class="col-sm-2">Cliente:</dt>
                <dd class="col-sm-10">{{ $order->client->name }}</dd>

                <dt class="col-sm-2">Dirección:</dt>
                <dd class="col-sm-10">{{ $order->client->address->street }}, {{ $order->client->address->number }}
                    , {{ $order->client->address->city }}, {{ $order->client->address->zipCode }}
                    , {{ $order->client->address->state }}, {{ $order->client->address->country }}</dd>

                <dt class="col-sm-2">Fecha:</dt>
                <dd class="col-sm-10">{{ $order->created_at }}</dd>
            </div>
            <div class="col-sm-8">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID del producto</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Total</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($order->lineOrders as $lineOrder)
                        <tr>
                            <td>{{ $lineOrder->product->id }}</td>
                            <td>{{ $lineOrder->product->name }}</td>
                            <td>{{ $lineOrder->productPrice }}€</td>
                            <td>{{ $lineOrder->quantity }}</td>
                            <td>{{ $lineOrder->productPrice * $lineOrder->quantity }}€</td>
                            <td>
                                <a href="{{ route('product.show', $lineOrder->product->id) }}" class="btn btn-primary">
                                    <i class="bi bi-eye"></i> Ver
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <dt class="col-sm-2">Total:</dt>
            <dd class="col-sm-10">{{ $order->total }}€</dd>

            <div class="mt-3 mb-5">
                <a class="btn btn-primary" href="{{ route('orders.index') }}">Volver</a>
            </div>
    </div>
    </dl>

    </div>
@endsection
