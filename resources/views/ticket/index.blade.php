<!DOCTYPE html>
<html>
<head>
    <style>
        /* Estilos CSS personalizados aquí */
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .product-list {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .product-list th,
        .product-list td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .total {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Recibo de Compra</h1>
        </div>
        
        <div class="info">
            <div>
                <h3>Información del Cliente:</h3>
                <p>Nombre del Cliente: {{ $sale->client->name }}</p>
                <p>Dirección: {{ $sale->client->direccion }}</p>
                <p>Correo Electrónico: {{ $sale->client->email }}</p>
            </div>
            <div>
                <h3>Información de la Factura:</h3>
                <p>Referencia: {{ $sale->code }}</p>
                <p>Vendedor: {{ $sale->user->username }}</p>
                <p>Fecha: {{ $sale->created_at }}</p>
            </div>
        </div>
        
        <table class="product-list">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sale->detalles as $detail)
                    <tr>
                        <td>{{ $detail->producto->name }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>$ {{ $detail->producto->sale_price }}</td>
                        <td>$ {{ $detail->quantity * $detail->producto->sale_price }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="total">
            <p>Subtotal: $ {{ $sale->total * 0.84 }}</p>
            <p>IVA: $ {{ $sale->total * 0.16 }}</p>
            <h3>Total: $ {{ $sale->total }}</h3>
        </div>
    </div>
</body>
</html>
