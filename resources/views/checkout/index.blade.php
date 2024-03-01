@extends('main')

@section('title', 'Checkout')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
            @foreach ($errors->all() as $error)
                {{ $error }} <br>
            @endforeach
        </div>
    @endif
    <div class="container mt-4 mb-5">
        <h1 class="mb-4">Formulario de compra</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-5">
                    <div class="card-body">
                        <form action="{{ route('checkout.complete') }}" method="post">
                            @csrf
                            <h2>Dirección de envío</h2>
                            <div class="form-group">
                                <label for="street">Calle</label>
                                <input type="text" id="street" name="street" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="number">Numero</label>
                                <input type="number" id="number" name="number" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="city">Ciudad</label>
                                <input type="text" id="city" name="city" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="zipCode">Codigo Postal</label>
                                <input type="number" id="zipCode" name="zipCode" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="state">Provincia</label>
                                <input type="text" id="state" name="state" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="country">Pais</label>
                                <input type="text" id="country" name="country" class="form-control">
                            </div>

                            <h2 class="mt-2">Detalles de la tarjeta de crédito</h2>
                            <div class="form-group">
                                <label for="card_number">Número de tarjeta</label>
                                <input type="text" id="card_number" name="card_number" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Realizar pago</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
