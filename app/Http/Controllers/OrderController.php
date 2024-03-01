<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use stdClass;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
//        $orders = Order::orderBy('id')->search($search)->paginate(9);
        $orders = Order::where('client', 'like', '%' . $search . '%')->paginate(9);

        foreach ($orders as $order) {
            $order->lineOrders = json_decode($order->lineOrders);
            foreach ($order->lineOrders as $lineOrder) {
                $lineOrder->product = Product::find($lineOrder->productId);
            }
            $client = json_decode($order->client);
            $order->client = $client;
        }

        return view('orders.index')
            ->with('orders', $orders)
            ->with('search', $search);
    }

    public function show($id)
    {
        $order = Order::find($id);
        if (!$order) {
            flash('No se ha encontrado el pedido')->error();
            return redirect()->route('orders.index');
        }

        $order->lineOrders = json_decode($order->lineOrders);
        foreach ($order->lineOrders as $lineOrder) {
            $lineOrder->product = Product::find($lineOrder->productId);
        }
        $client = json_decode($order->client);
        $order->client = $client;

        return view('orders.show')
            ->with('order', $order);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'idUsuario' => ['required', 'integer'],
            'cliente' => ['required'],
        ]);

        return order::create($data);
    }

    public function update(Request $request, order $order)
    {

        $data = $request->validate([
            'userId' => ['required', 'integer'],
            'client' => ['required', 'json'],
            'lineOrders' => ['required'],
            'totalItems' => ['required'],
            'total' => ['required'],
        ]);

        try{
            $order->update($data);
        }catch (\Exception){
            return response()->json(['error' => 'Error al actualizar el pedido'], 400);
        }


        return $order;
    }

    public function destroy($id)
    {
        error_log('destroy' . $id);
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['error' => 'No se ha encontrado el pedido'], 400);
        }

        $order->delete();

        return redirect()->route('orders.index');
    }


}
