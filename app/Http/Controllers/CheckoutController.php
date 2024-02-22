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

        return view('checkout.index', compact('cart'));
    }

    public function complete(Request $request)
    {

        $cart = session('cart', []);

        if (count($cart) <= 0) {
            flash('No hay productos en el carrito')->error();
            return redirect()->back();
        }

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

}
