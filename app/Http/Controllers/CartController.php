<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $cart = session('cart', []);

        $product_id = $request->get('product_id');

        if (!$product_id) {
            flash('No se ha encontrado el producto')->error();
            return redirect()->back();
        }

        $product = Product::find($product_id);

        if (!$product) {
            flash('No se ha encontrado el producto')->error();
            return redirect()->back();
        }

        if ($product->stock <= 0) {
            flash('No hay stock disponible para este producto')->error();
            return redirect()->back();
        }

        $cartItem = null;
        foreach ($cart as $item) {
            if ($item->product->id == $product_id) {
                $cartItem = $item;
                break;
            }
        }

        if ($cartItem) {
            $cartItem->quantity++;
        } else {
            $cartItem = new CartItem();
            $cartItem->product = $product;
            $cartItem->quantity = 1;
            $cart[] = $cartItem;
        }

        $product->stock -= 1;
        $product->save();

        session(['cart' => $cart]);

        flash('Producto añadido al carrito')->success();

        return redirect()->back();
    }
}
