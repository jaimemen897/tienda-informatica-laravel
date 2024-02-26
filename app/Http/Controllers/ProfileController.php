<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $currentUserOrders = Order::where('userId', $user->id)->get();

        foreach ($currentUserOrders as $order) {
            $order->lineOrders = json_decode($order->lineOrders);
            foreach ($order->lineOrders as $lineOrder) {
                $lineOrder->product = Product::find($lineOrder->productId);
            }
            $client = json_decode($order->client);
            $order->client = $client;
        }

        return view('users.profile')->with('user', $user)->with('orders', $currentUserOrders);
    }

    public function edit($id)
    {
        $user = Auth::user();
        if ($user) {
            return view('users.edit')->with('user', $user);
        } else {
            flash('Usuario no encontrado')->error();
            return redirect()->route('users.profile');
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
            flash('Usuario actualizado correctamente')->success();
            return redirect()->route('users.profile');
        } else {
            flash('Usuario no encontrado')->error();
            return redirect()->route('users.profile');
        }
    }
}
