@extends('layouts.admin')

@section('content')

<div class="m-4">
<div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
  <div class="rounded-t mb-0 px-0 border-0">
    <div class=" flex flex-wrap items-center px-4 py-2">
      <div class=" border-b-2 relative w-full max-w-full flex-grow flex-1">
        <div class="m-5 flex justify-between">
            <h3 class=" ml-6 font-semibold text-base text-gray-900 dark:text-gray-50">Detalles de devolucion: {{ $return->code }}</h3>
            
        </div>
        
      </div>
    </div>
    <div class="flex justify-between m-6 md:bg-green">
        <div>
            <p class="text-blue-400">Informacion de Cliente</p>
            <ul>
                <li>{{ $return->sale->client->name }}</li>
                <li>{{ $return->sale->client->email }}</li>
                <li>{{ $return->sale->client->telefono }}</li>
                <li>{{ $return->sale->client->direccion }}</li>
                
            </ul>
        </div>
      </div>
    <div class=" w-full overflow-x-auto">
      <div class="table-responsive">
        <table class="m-6 w-full text-left border-collapse">
            <thead>
              <tr>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Nombre de Producto</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Precio</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Vendido</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Regresado</th>
            </thead>
            <tbody>
              @foreach ($return->detalles as $detail)
                <tr class="hover:bg-grey-lighter">
                  <td class="py-4 px-6 border-b border-grey-light"><img class="w-24 inline mr-5" src="{{ asset('uploads/'.$detail->producto->picture) }}" alt="Imagen de producto"> <p class="inline">{{ $detail->producto->name }}</p></td>
                  <td class="py-4 px-6 border-b border-grey-light">$ {{ $detail->producto->purchase_price }}</td>
                  <td class="py-4 px-6 border-b border-grey-light"> {{ $detail->return->sale->detalles->count() }}</td>
                  <td class="py-4 px-6 border-b border-grey-light"> {{ $detail->quantity }}</td>

                </tr>
              @endforeach
            </tbody>
          </table>
    </div>
  </div>
  </div>
  <div class="m-6">

  </div>
</div>
</div>
<div class="m-6">
    <a type="button" href="{{ route('returns.index') }}" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Cancelar</a>    
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