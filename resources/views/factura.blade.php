<!DOCTYPE html>
<html lang="es">
<head>
    <title>Factura</title>
    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .divFactura {
            text-align: right;
            font-size: 15px;
            line-height: 10px;
        }

        .divCliente {
            font-size: 15px;
            line-height: 10px;
        }

        .divDetailsInvoice {
            margin-top: 100px;
        }

        .divDetailsInvoice table {
            width: 100%;
            border-collapse: collapse;
        }

        .divDetailsInvoice th,
        .divDetailsInvoice td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .divDetailsInvoice th {
            text-align: left;
            background-color: #f2f2f2;
        }

        .divDetailsInvoice td:first-child {
            text-align: left;
        }

        .divDetailsInvoice td:not(:first-child) {
            text-align: right;
        }
    </style>
</head>
<body>
<div class="invoice-box">
    <h2>Factura</h2>
    <div class="divFactura">
        <p><strong>Fecha</strong>: {{ date('d/m/Y') }}</p>
        <p><strong>Nº de factura</strong>: {{ $order->id }}</p>
    </div>

    <div class="divCliente">
        <h3>Detalles del cliente</h3>
        <p><strong>Nombre</strong>: {{ $order->client->name }}</p>
        <p><strong>Teléfono</strong>: {{ $order->client->phone }}</p>
        <p><strong>Email</strong>: {{ $order->client->email }}</p>
        <p><strong>Dirección de envío</strong>: {{ $order->client->address->street }}
            , {{ $order->client->address->number }}
            , {{ $order->client->address->city }}, {{ $order->client->address->zipCode }}
            , {{ $order->client->address->state }}, {{ $order->client->address->country }}</p>
    </div>
    <div class="divDetailsInvoice">
        <h3>Detalles de la factura</h3>
        <table>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
            </tr>
            @foreach($order->lineOrders as $lineOrder)
                <tr>
                    <td>{{ $lineOrder->product->name }}</td>
                    <td>{{ $lineOrder->quantity }}</td>
                    <td>{{ $lineOrder->product->price }} €</td>
                </tr>
            @endforeach
        </table>
    </div>


    <h3>Total: {{ $order->total }} €</h3>
</div>
</body>
</html>
