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
                <a href="{{ route('returns.create' , $sale) }}"  class="mr-5">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                  </svg>
                </a>
                
                <div class="relative" data-te-dropdown-ref>
                  <a
                    class="mr-5"
                    type="button"
                    id="dropdownMenuButton1"
                    data-te-dropdown-toggle-ref
                    aria-expanded="false"
                    data-te-ripple-init
                    data-te-ripple-color="light">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                    </svg>
                  </a>
                  <ul
                    class="absolute z-[1000] float-left m-0 hidden min-w-max list-none overflow-hidden rounded-lg border-none bg-white bg-clip-padding text-left text-base shadow-lg dark:bg-neutral-700 [&[data-te-dropdown-show]]:block"
                    aria-labelledby="dropdownMenuButton1"
                    data-te-dropdown-menu-ref>
                    <li>
                      <a
                        class="w-full flex justify-between  whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-neutral-600"
                        href="{{ route('ticket.pdf', $sale) }}"
                        data-te-dropdown-item-ref
                        > 
                         
                        <svg class="mr-1 w-6" viewBox="0 0 512 512" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <title>pdf-document</title>
                          <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <g id="add" fill="#000000" transform="translate(85.333333, 42.666667)">
                                  <path d="M75.9466667,285.653333 C63.8764997,278.292415 49.6246897,275.351565 35.6266667,277.333333 L1.42108547e-14,277.333333 L1.42108547e-14,405.333333 L28.3733333,405.333333 L28.3733333,356.48 L40.5333333,356.48 C53.1304778,357.774244 65.7885986,354.68506 76.3733333,347.733333 C85.3576891,340.027178 90.3112817,328.626053 89.8133333,316.8 C90.4784904,304.790173 85.3164923,293.195531 75.9466667,285.653333 L75.9466667,285.653333 Z M53.12,332.373333 C47.7608867,334.732281 41.8687051,335.616108 36.0533333,334.933333 L27.7333333,334.933333 L27.7333333,298.666667 L36.0533333,298.666667 C42.094796,298.02451 48.1897668,299.213772 53.5466667,302.08 C58.5355805,305.554646 61.3626692,311.370371 61.0133333,317.44 C61.6596233,323.558965 58.5400493,329.460862 53.12,332.373333 L53.12,332.373333 Z M150.826667,277.333333 L115.413333,277.333333 L115.413333,405.333333 L149.333333,405.333333 C166.620091,407.02483 184.027709,403.691457 199.466667,395.733333 C216.454713,383.072462 225.530463,362.408923 223.36,341.333333 C224.631644,323.277677 218.198313,305.527884 205.653333,292.48 C190.157107,280.265923 170.395302,274.806436 150.826667,277.333333 L150.826667,277.333333 Z M178.986667,376.32 C170.098963,381.315719 159.922142,383.54422 149.76,382.72 L144.213333,382.72 L144.213333,299.946667 L149.333333,299.946667 C167.253333,299.946667 174.293333,301.653333 181.333333,308.053333 C189.877212,316.948755 194.28973,329.025119 193.493333,341.333333 C194.590843,354.653818 189.18793,367.684372 178.986667,376.32 L178.986667,376.32 Z M254.506667,405.333333 L283.306667,405.333333 L283.306667,351.786667 L341.333333,351.786667 L341.333333,329.173333 L283.306667,329.173333 L283.306667,299.946667 L341.333333,299.946667 L341.333333,277.333333 L254.506667,277.333333 L254.506667,405.333333 L254.506667,405.333333 Z M234.666667,7.10542736e-15 L9.52127266e-13,7.10542736e-15 L9.52127266e-13,234.666667 L42.6666667,234.666667 L42.6666667,192 L42.6666667,169.6 L42.6666667,42.6666667 L216.96,42.6666667 L298.666667,124.373333 L298.666667,169.6 L298.666667,192 L298.666667,234.666667 L341.333333,234.666667 L341.333333,106.666667 L234.666667,7.10542736e-15 L234.666667,7.10542736e-15 Z" id="document-pdf">
                                  </path>
                                </g>
                            </g>
                        </svg>
                        <p>Descargar Pdf</p>
                        </a
                      >
                    </li>
                    <li>
                      <a
                        class="flex justify-betweenw-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-neutral-600"
                        href="{{ route('ticket.exportXlsx', $sale) }}"
                        data-te-dropdown-item-ref
                        >
                        <svg class="mr-1 w-6" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                        	 viewBox="0 0 512 512"  xml:space="preserve">
                        <style type="text/css">
                        	.st0{fill:#000000;}
                        </style>
                        <g>
                        	<path class="st0" d="M378.413,0H208.297h-13.183L185.8,9.314L57.02,138.102l-9.314,9.314v13.176v265.514
                        		c0,47.36,38.527,85.895,85.895,85.895h244.812c47.353,0,85.881-38.535,85.881-85.895V85.896C464.294,38.528,425.766,0,378.413,0z
                        		 M432.497,426.105c0,29.877-24.214,54.091-54.084,54.091H133.601c-29.884,0-54.098-24.214-54.098-54.091V160.591h83.717
                        		c24.885,0,45.077-20.178,45.077-45.07V31.804h170.116c29.87,0,54.084,24.214,54.084,54.092V426.105z"/>
                        	<path class="st0" d="M171.193,302.61l13.853-18.07c1.494-2.032,2.318-4.211,2.318-6.243c0-4.482-3.533-8.288-8.421-8.288
                        		c-2.863,0-5.712,1.355-7.89,4.211l-10.725,14.125h-0.139l-10.725-14.125c-2.178-2.856-5.027-4.211-7.876-4.211
                        		c-4.888,0-8.42,3.806-8.42,8.288c0,2.032,0.81,4.211,2.304,6.243l13.853,18.07l-15.487,20.235c-1.494,2.038-2.304,4.21-2.304,6.249
                        		c0,4.483,3.533,8.288,8.42,8.288c2.848,0,5.711-1.361,7.876-4.21l12.358-16.304h0.139l12.358,16.304
                        		c2.179,2.849,5.027,4.21,7.876,4.21c4.888,0,8.42-3.805,8.42-8.288c0-2.039-0.81-4.21-2.304-6.249L171.193,302.61z"/>
                        	<path class="st0" d="M226.898,320.806c-2.989-0.538-4.344-2.172-4.344-5.97v-61.394c0-6.25-4.078-10.055-9.509-10.055
                        		c-5.572,0-9.51,3.805-9.51,10.055v63.021c0,13.448,5.166,20.919,20.235,20.919h0.824c6.926,0,9.914-3.673,9.914-8.288
                        		C234.508,324.883,232.33,321.762,226.898,320.806z"/>
                        	<path class="st0" d="M277.98,295.544l-7.206-0.817c-7.471-0.81-9.091-2.444-9.091-5.432c0-3.121,2.444-5.16,8.281-5.16
                        		c4.748,0,9.23,0.95,13.308,2.856c2.583,1.222,4.078,1.627,5.432,1.627c4.482,0,7.471-3.261,7.471-7.471
                        		c0-3.261-1.899-5.565-5.572-7.471c-5.558-2.849-12.624-4.343-19.97-4.343c-17.246,0-27.161,8.281-27.161,21.184
                        		c0,11.409,7.192,18.475,21.464,20.102l7.191,0.817c7.75,0.816,9.51,2.444,9.51,5.572c0,3.666-3.254,6.11-10.18,6.11
                        		c-6.382,0-11.409-2.039-16.171-4.756c-2.165-1.222-3.799-1.766-5.572-1.766c-4.344,0-7.876,3.4-7.876,7.61
                        		c0,3.121,1.355,5.565,4.622,7.604c5.432,3.394,13.727,6.249,24.047,6.249c18.6,0,29.339-9.098,29.339-22.546
                        		C299.848,304.509,293.467,297.31,277.98,295.544z"/>
                        	<path class="st0" d="M351.056,302.61l13.853-18.07c1.494-2.032,2.318-4.211,2.318-6.243c0-4.482-3.533-8.288-8.42-8.288
                        		c-2.862,0-5.712,1.355-7.89,4.211l-10.725,14.125h-0.14l-10.725-14.125c-2.178-2.856-5.027-4.211-7.876-4.211
                        		c-4.888,0-8.421,3.806-8.421,8.288c0,2.032,0.81,4.211,2.304,6.243l13.852,18.07l-15.486,20.235
                        		c-1.494,2.038-2.304,4.21-2.304,6.249c0,4.483,3.534,8.288,8.42,8.288c2.849,0,5.712-1.361,7.876-4.21l12.358-16.304h0.14
                        		l12.358,16.304c2.179,2.849,5.027,4.21,7.876,4.21c4.888,0,8.421-3.805,8.421-8.288c0-2.039-0.81-4.21-2.304-6.249L351.056,302.61z
                        		"/>
                        </g>
                        </svg>
                        Descargar XLSx</a
                      >
                    </li>
                  </ul>
                </div>



              
            </div>
            
        </div>
        
      </div>
    </div>
    <div class="flex justify-between m-6 md:bg-green">
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
    <div class=" w-full overflow-x-auto">
      <div class="table-responsive">
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