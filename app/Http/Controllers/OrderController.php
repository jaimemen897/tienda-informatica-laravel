<?php

namespace App\Http\Controllers;

use App\Models\order;
use Illuminate\Http\Request;
use stdClass;

class OrderController extends Controller
{
    public function index()
    {
        return order::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'idUsuario' => ['required', 'integer'],
            'cliente' => ['required'],
        ]);

        return order::create($data);
    }

    public function show(order $order)
    {
        return $order;
    }

    public function update(Request $request, order $order)
    {
//        Validar cosas
//        $data = $request->validate([
//            'idUsuario' => ['required', 'integer'],
//            'cliente' => ['required'],
//        ]);


//        $address = new stdClass();
//        $address->street = $request->street;
//        $address->number = $request->number;
//        $address->city = $request->city;
//        $address->state = $request->state;
//        $address->country = $request->country;
//        $address->zipCode = $request->zipCode;

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

    public function destroy(order $order)
    {
        $order->delete();

        return response()->json();
    }
}
