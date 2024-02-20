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
    </style>
</head>
<body>
<div class="invoice-box">
    <h2>Factura</h2>
    <p>Fecha: {{ date('d/m/Y') }}</p>
    {{--<p>Número de factura: #{{ $invoice_number }}</p>--}}

    <h3>Detalles del cliente</h3>
    {{--<p>Nombre: {{ $client_name }}</p>
    <p>Dirección: {{ $client_address }}</p>--}}

    <h3>Detalles de la factura</h3>
    <table>
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
        </tr>
        {{--@foreach($items as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->price }}</td>
            </tr>
        @endforeach--}}
    </table>

    {{--<h3>Total: {{ $total }}</h3>--}}
</div>
</body>
</html>
