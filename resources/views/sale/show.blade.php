@extends('layouts.admin')

@section('content')

<div class="m-4">
<div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
  <div class="rounded-t mb-0 px-0 border-0">
    <div class=" flex flex-wrap items-center px-4 py-2">
      <div class=" border-b-2 relative w-full max-w-full flex-grow flex-1">
        <div class="m-5 flex justify-between">
            <h3 class=" ml-6 font-semibold text-base text-gray-900 dark:text-gray-50">Detalles de venta: {{ $sale->code }}</h3>
            <div class="flex ">
                <a href="" href="" class="mr-5">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                  </svg>
                </a>
                <a href="" href="" class="mr-5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                      </svg>                  
                </a>
            </div>
            
        </div>
        
      </div>
    </div>
    <div class="flex justify-between m-6">
        <div>
            <p class="text-blue-400">Informacion de Cliente</p>
            <ul>
                <li>{{ $sale->client->name }}</li>
                <li>{{ $sale->client->email }}</li>
                <li>{{ $sale->client->telefono }}</li>
                <li>{{ $sale->client->direccion }}</li>
            </ul>
        </div>
        <div>
            <p class="text-blue-400">Informacion de la Empresa</p>
            <ul>
                <li>DGL</li>
                <li>admin@example.com</li>
                <li>63212151</li>
                <li>3618 Abia Martin Drive</li>
            </ul>
        </div>
        <div>
            <p class="text-blue-400">Informacion de Factura</p>
            <ul>
                <li>Referencia: {{ $sale->code }}</li>
                <li>Vendendor: {{ $sale->user->username }}</li>
                <li>Subtotal: $ {{ $sale->total * .84 }}</li>
                <li>IVA: $ {{ $sale->total * .16 }}</li>
                <li>Total: $ {{ $sale->total }}</li>
            </ul>
        </div>
      </div>
    <div class=" w-full overflow-x-auto flex justify-center">
        <table class="m-6 w-full text-left border-collapse">
            <thead>
              <tr>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Nombre de Producto</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Precio</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Cantidad</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">IVA</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Subtotal</th>
            </thead>
            <tbody>
              @foreach ($sale->detalles as $detail)
                <tr class="hover:bg-grey-lighter">
                  <td class="py-4 px-6 border-b border-grey-light"><img class="w-24 inline mr-5" src="{{ asset('uploads/'.$detail->producto->picture) }}" alt="Imagen de producto"> <p class="inline">{{ $detail->producto->name }}</p></td>
                  <td class="py-4 px-6 border-b border-grey-light">$ {{ $detail->producto->sale_price }}</td>
                  <td class="py-4 px-6 border-b border-grey-light">{{ $detail->quantity }}</td>
                  <td class="py-4 px-6 border-b border-grey-light">$ {{ $detail->producto->sale_price * $detail->quantity * .16 }}</td>
                  <td class="py-4 px-6 border-b border-grey-light">$ {{ $detail->producto->sale_price * $detail->quantity }}</td>

                </tr>
              @endforeach
            </tbody>
          </table>
    </div>
  </div>
  <div class="m-6">

  </div>
</div>
</div>
<div class="m-6">
    <a type="button" href="{{ route('sale.index') }}" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Cancelar</a>    
</div>  
</div>
<!-- ./Social Traffic -->
</div>




<script>
$(document).ready(function() {
  $('#users-table').DataTable();
});
</script>


@endsection