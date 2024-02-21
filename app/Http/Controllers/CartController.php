<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
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

    public function viewCart()
    {
        $cart = session('cart', []);

        $total = array_reduce($cart, function ($carry, $item) {
            return $carry + $item->product->price * $item->quantity;
        }, 0);
        return view('cart.index')
            ->with('cart', $cart)
            ->with('total', $total);
    }


    public function removeFromCart(Request $request)
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

        foreach ($cart as $item) {
            if ($item->product->id == $product_id) {
                $product->stock += $item->quantity;
                $product->save();
                break;
            }
        }

        $cart = array_filter($cart, function ($item) use ($product_id) {
            return $item->product->id != $product_id;
        });

        session(['cart' => $cart]);

        flash('Producto eliminado del carrito')->success();

        return redirect()->back();
    }

    public function increaseQuantity(Request $request)
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

        foreach ($cart as $item) {
            if ($item->product->id == $product_id) {
                if ($product->stock <= 0) {
                    flash('No hay stock disponible para este producto')->error();
                    return redirect()->back();
                }
                $item->quantity++;
                $product->stock -= 1;
                $product->save();
                break;
            }
        }

        session(['cart' => $cart]);

        flash('Cantidad aumentada')->success();

        return redirect()->back();
    }


    public function decreaseQuantity(Request $request)
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

        foreach ($cart as $item) {
            if ($item->product->id == $product_id) {
                $item->quantity--;
                $product->stock += 1;
                $product->save();
                if ($item->quantity <= 0) {
                    $cart = array_filter($cart, function ($item) use ($product_id) {
                        return $item->product->id != $product_id;
                    });
                    session(['cart' => $cart]);
                    flash('Producto eliminado del carrito')->success();
                    return redirect()->back();
                }
                break;
            }
        }

        session(['cart' => $cart]);

        flash('Cantidad disminuida')->success();

        return redirect()->back();
    }

    public function checkout()
    {
        $cart = session('cart', []);

        if (count($cart) <= 0) {
            flash('No hay productos en el carrito')->error();
            return redirect()->back();
        }

        return view('checkout.index')
            ->with('cart', $cart);
    }

}
