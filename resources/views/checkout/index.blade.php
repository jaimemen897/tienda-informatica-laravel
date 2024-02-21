@extends('main')

@section('title', 'Checkout')


@section('content')
    <div class="container mt-4 mb-5">
        <h1 class="mb-4">Carrito</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('checkout.complete') }}" method="post">
                            @csrf
                            <h2>Dirección de envío</h2>
                            <div class="form-group">
                                <label for="street">Calle</label>
                                <input type="text" id="street" name="street" class="form-control">
                            </div>
                            <!-- Agrega más campos según sea necesario -->

                            <h2>Detalles de la tarjeta de crédito</h2>
                            <div class="form-group">
                                <label for="card_number">Número de tarjeta</label>
                                <input type="text" id="card_number" name="card_number" class="form-control">
                            </div>
                            <!-- Agrega más campos según sea necesario -->

                            <button type="submit" class="btn btn-primary">Realizar pago</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
