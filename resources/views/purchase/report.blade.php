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
                  <th>Codigo</th>
                  <th>Proveedor</th>
                  <th>Productos</th>
                  <th>Subtotal</th>
                  <th>IVA</th>
                  <th>Total</th>
                  <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($purchases as $purchase)
                    <tr>
                      <td>{{ $purchase->code }}</td>
                      <td>{{ $purchase->provedor->name }}</td>
                      <td>{{ $purchase->detalles->count() }}</td>
                      <td>$ {{ $purchase->tota * 0.84 }}</td>
                      <td>$ {{ $purchase->tota * 0.16 }}</td>
                      <td>$ {{ $purchase->tota }}</td>
                      <td>{{ $purchase->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
