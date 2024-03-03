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
            'number' => ['required', 'max_digits:255', 'numeric'],
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

        flash('Compra realizada correctamente - Total: '.$total . '€')->success();

        return redirect()->route('profile.index');
    }

    public function messages()
    {
        return [
            'street.required' => 'La calle es requerida',
            'street.max' => 'La calle debe tener menos de 255 caracteres',
            'street.min' => 'La calle debe tener más de 3 caracteres',
            'number.required' => 'El número es requerido',
            'number.max' => 'El número debe tener menos de 255 caracteres',
            'number.min' => 'El número debe tener más de 3 caracteres',
            'number.max_digits' => 'El número debe tener menos de 255 caracteres',
            'number.numeric' => 'El número debe ser un número',
            'city.required' => 'La ciudad es requerida',
            'city.max' => 'La ciudad debe tener menos de 255 caracteres',
            'city.min' => 'La ciudad debe tener más de 3 caracteres',
            'state.required' => 'La provincia es requerida',
            'state.max' => 'La provincia debe tener menos de 255 caracteres',
            'state.min' => 'La provincia debe tener más de 3 caracteres',
            'country.required' => 'El país es requerido',
            'country.max' => 'El país debe tener menos de 255 caracteres',
            'country.min' => 'El país debe tener más de 3 caracteres',
            'zipCode.required' => 'El código postal es requerido',
            'zipCode.numeric' => 'El código postal debe ser un número',
            'zipCode.digits' => 'El código postal debe tener 5 dígitos',
            'card_number.required' => 'El número de tarjeta es requerido',
            'card_number.numeric' => 'El número de tarjeta debe ser un número',
            'card_number.digits' => 'El número de tarjeta debe tener 16 dígitos',
        ];
    }

}
