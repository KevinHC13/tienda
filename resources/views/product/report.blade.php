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
                  <th>Nombre</th>
                  <th>Precio de compra</th>
                  <th>Precio de venta</th>
                  <th>Stock</th>
                  <th>Categoria</th>
                  <th>Subcategoria</th>
                  <th>Marca</th>
                  <th>Agregado por</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                      <td>{{ $product->name }}</td>
                      <td>{{ $product->purchase_price }}</td>
                      <td>{{ $product->sale_price }}</td>
                      <td>{{ $product->stock }}</td>
                      <td>{{ $product->category->name }}</td>
                      <td>{{ $product->subcategory->name ?? "" }}</td>
                      <td>{{ $product->brand->name }}</td>
                      <td>{{ $product->user->username }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
