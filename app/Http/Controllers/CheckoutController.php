<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{

    public function index()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            flash('No hay productos en el carrito')->error();
            return redirect()->route('product.index');
        }

        return view('checkout.index', compact('cart'));
    }

    public function complete(Request $request)
    {

        $data = $request->validate([
            'street' => ['required', 'max:255', 'min:3'],
            'number' => ['required', 'max:255', 'numeric'],
            'city' => ['required', 'max:255', 'min:3'],
            'state' => ['required', 'max:255', 'min:3'],
            'country' => ['required', 'max:255', 'min:3'],
            'zipCode' => ['required', 'numeric', 'digits:5'],
            'card_number' => ['required','numeric', 'digits:16'],
        ], $this->messages());

        $cart = session('cart', []);

        $total = array_reduce($cart, function ($carry, $item) {
            return $carry + $item->product->price * $item->quantity;
        }, 0);

        $lineOrders = array_map(function ($item) {
            return [
                'quantity' => $item->quantity,
                'productId' => $item->product->id,
                'productPrice' => $item->product->price,
            ];
        }, $cart);

        $client = [
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'phone' => auth()->user()->phone,
            'address' => [
                'street' => $request->get('street'),
                'number' => $request->get('number'),
                'city' => $request->get('city'),
                'state' => $request->get('state'),
                'country' => $request->get('country'),
                'zipCode' => $request->get('zipCode'),
            ],
        ];

        Order::create([
            'userId' => auth()->user()->id,
            'client' => json_encode($client),
            'lineOrders' => json_encode($lineOrders),
            'totalItems' => count($cart),
            'total' => $total,
        ]);

        session(['cart' => []]);

        flash('Compra realizada correctamente '.$total)->success();

        return redirect()->route('profile.index');
    }

    public function messages()
    {
        return [
            'required' => 'El campo :attribute es requerido',
            'max' => 'El campo :attribute no puede tener más de :max caracteres',
            'min' => 'El campo :attribute no puede tener menos de :min caracteres',
            'numeric' => 'El campo :attribute debe ser un número',
            'digits' => 'El campo :attribute debe tener :digits dígitos',
        ];
    }

}