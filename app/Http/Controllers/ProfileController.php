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

    public function edit()
    {
        $user = Auth::user();
        return view('users.edit')->with('user', $user);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect('/profile');
    }
}
