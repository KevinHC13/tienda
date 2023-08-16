<!DOCTYPE html>
<html>
<head>
    <style>
        /* Estilos CSS personalizados aquí */
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 100%; /* Para que se ajuste al ancho de la página horizontal */
            margin: 0 auto; /* Para centrar el contenido horizontalmente */
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
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
        
        <table class="product-list">
            <thead>
                <tr>
                  <th>Vendedor</th>
                  <th>Fecha</th>
                  <th>Referencia</th>
                  <th>Productos</th>
                  <th>Cliente</th>
                  <th>Total</th>
                  <th>Facturador</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $sale)
                    <tr>
                      <td>{{ $sale->user->username }}</td>
                      <td>{{ $sale->created_at->format('d/m/Y') }}</td>
                      <td>{{ $sale->code }}</td>
                      <td>{{ $sale->detalles->count() }}</td>
                      <td>{{ $sale->client->name }}</td>
                      <td>$ {{ $sale->total }}</td>
                      <td>{{ $sale->user->username }} </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
