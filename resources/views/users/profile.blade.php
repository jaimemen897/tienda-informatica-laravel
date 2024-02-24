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
                    <a class="btn btn-primary mb-5" href="{{ route('product.index') }}">Volver</a>
                </div>
            </div>
            <div class="col-sm-6 mb-5">
                <div>
                    @if(count($orders) > 0)
                        <h4 class="">Pedidos</h4>
                        @foreach($orders as $order)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <p class="card-text"><strong>Dirección de envío: </strong>
                                        {{$order->client->address->street}}, {{$order->client->address->number}}
                                        , {{$order->client->address->city}}, {{$order->client->address->zipCode}}
                                        , {{$order->client->address->state}}, {{$order->client->address->country}}</p>
                                    <p class="card-text"><small class="text-muted">Realizado
                                            el {{ $order->created_at->format('d-m-Y') }}</small></p>

                                    <div class="accordion" id="accordionExample{{$loop->iteration}}">
                                        @php $lineIteration = 0; @endphp
                                        @if(count($order->lineOrders) > 0)
                                            @foreach($order->lineOrders as $lineOrder)
                                                @php $lineIteration++; @endphp
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header"
                                                        id="heading{{$loop->iteration}}{{$lineIteration}}">
                                                        <button class="accordion-button" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#collapse{{$lineOrder->product->id}}"
                                                                aria-expanded="false"
                                                                aria-controls="collapse{{$lineOrder->product->id}}">
                                                            {{$lineOrder->product->name}}
                                                        </button>
                                                    </h2>
                                                    <div id="collapse{{$lineOrder->product->id}}"
                                                         class="accordion-collapse collapse">
                                                        <div class="accordion-body">
                                                            <div class="row">
                                                                <div class="col-4">
                                                                    <a href="{{ route('product.show', $lineOrder->product->id) }}">
                                                                        <img src="{{$lineOrder->product->image}}"
                                                                             alt="{{$lineOrder->product->name}}"
                                                                             class="img-fluid">
                                                                    </a>
                                                                </div>
                                                                <div class="col-8">
                                                                    <a class=" text-decoration-none text-dark"
                                                                       href="{{ route('product.show', $lineOrder->product->id) }}">
                                                                        <h3>{{$lineOrder->product->name}}</h3></a>
                                                                    <p>Precio: {{$lineOrder->productPrice}}€</p>
                                                                    <p>Cantidad: {{$lineOrder->quantity}}</p>
                                                                    <p>
                                                                        Subtotal: {{$lineOrder->productPrice * $lineOrder->quantity}}
                                                                        €</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <a href="{{ route('factura.id', $order->id) }}"
                                               class="btn btn-primary mt-3">Descargar factura</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    @endif
                </div>
            </div>
        </dl>

    </div>
@endsection
