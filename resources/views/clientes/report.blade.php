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
                  <th>Pais</th>
                  <th>Ciudad</th>
                  <th>Direccion</th>
                  <th>Empresa</th>
                  <th>Telefono</th>
                  <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                    <tr>
                      <td>{{ $client->name }}</td>
                      <td>{{ $client->pais }}</td>
                      <td>{{ $client->ciudad }}</td>
                      <td>{{ $client->direccion }}</td>
                      <td>{{ $client->empresa }}</td>
                      <td>{{ $client->telefono }}</td>
                      <td>{{ $client->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
