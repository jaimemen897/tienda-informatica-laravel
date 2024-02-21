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
                    <a class="btn btn-primary" href="{{ route('client.index') }}">Volver</a>
                </div>
            </div>
            <div class="col-sm-6">
                <h4>Pedidos realizados</h4>
                <div>
                    @if(count($orders) > 0)
                        @foreach($orders as $order)
                            <div class="card mb-3">
{{--                                <img class="card-img-top" src="..." alt="Card image cap">--}}
                                <div class="card-body">
                                    <h5 class="card-title">{{$order->id}}</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    <p class="card-text"><small class="text-muted">Realizado el {{$order->created_at}}</small></p>

                                    <div class="accordion" id="accordionExample">
                                        @if(count($order->lineOrders) > 0)
                                            @foreach($order->lineOrders as $lineOrder)
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingOne">
                                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                            {{$lineOrder->product->name}}
                                                        </button>
                                                    </h2>
                                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <img src="{{asset('storage/products/'.$lineOrder->product->image)}}" alt="{{$lineOrder->product->name}}" class="img-fluid">
                                                                </div>
                                                                <div class="col-6">
                                                                    <p>Precio: {{$lineOrder->product->productPrice}}€</p>
                                                                    <p>Cantidad: {{$lineOrder->quantity}}</p>
                                                                    <p>Subtotal: {{$lineOrder->product->productPrice * $lineOrder->quantity}}€</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($loop->last)
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingOne">
                                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                Total: {{$order->total}}€
                                                            </button>
                                                        </h2>
                                                    </div>
                                                @endif

                                            @endforeach
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
