@extends('main')

@section('title', 'Carrito')


@section('content')
    <div class="container mt-4 mb-5">
        <h1 class="mb-4">Carrito</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if ( count($cart ?? []) > 0 )
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">Producto</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($cart as $item)
                                    <tr>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->product->price }}€</td>
                                        <td class="d-flex gap-3  align-items-center"
                                            style="font-variant-numeric: tabular-nums;">
                                            <form action="{{route('cart.decrease')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{$item->product->id}}">
                                                <button type="submit" class="btn btn-secondary rounded-circle"
                                                        onclick="return confirm('¿Estás seguro de que desea quitar un {{$item->product->name}}?')">
                                                    <i class="bi bi-dash"></i>
                                                </button>
                                            </form>
                                            {{ $item->quantity }}
                                            <form method="post" action="{{route('cart.increase')}}">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{$item->product->id}}">
                                                <button type="submit" class="btn btn-success rounded-circle">
                                                    <i class="bi bi-plus"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td>{{ $item->product->price * $item->quantity }}€</td>
                                        <td class="d-flex gap-1">
                                            <form action="{{route('cart.remove')}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="product_id" value="{{$item->product->id}}">
                                                <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('¿Estás seguro de que desea eliminar el producto {{$item->product->name}}?')">
                                                    <i class="bi bi-trash"></i>
                                                    <span>Eliminar</span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end">
                                <h3>Total: {{ $total }}€</h3>
                            </div>
                            <div class="d-flex justify-content-end">
                                <form action="{{route('cart.checkout')}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Tramitar pedido</button>
                                </form>

                                

                            </div>
                        @else
                            <h3>No hay productos en el carrito</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
