<?php

namespace App\Http\Controllers;


use App\Models\Order;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function getInvoice($id)
    {
        $order = Order::find($id);
        $order->lineOrders = json_decode($order->lineOrders);
        foreach ($order->lineOrders as $lineOrder) {
            $lineOrder->product = Product::find($lineOrder->productId);
        }
        $client = json_decode($order->client);
        $order->client = $client;

        $pdf = PDF::loadView('factura', ['order' => $order]);
        return $pdf->download('invoice.pdf');
    }
}
