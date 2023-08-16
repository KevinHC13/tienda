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
                </tr>
            </thead>
            <tbody>
                @foreach ($returns as $return)
                    <tr>
                      <td>{{ $return->sale->user->username }}</td>
                      <td>{{ $return->created_at->format('d/m/Y') }}</td>
                      <td>{{ $return->code }}</td>
                      <td>{{ $return->detalles->count() }}</td>
                      <td>{{ $return->sale->client->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
