<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Auth;

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
}
