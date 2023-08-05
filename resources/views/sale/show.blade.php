@extends('layouts.admin')

@section('content')

<div class="m-4">
<div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
  <div class="rounded-t mb-0 px-0 border-0">
    <div class=" flex flex-wrap items-center px-4 py-2">
      <div class=" border-b-2 relative w-full max-w-full flex-grow flex-1">
        <div class="m-5 flex justify-between">
            <h3 class=" ml-6 font-semibold text-base text-gray-900 dark:text-gray-50">Detalles de venta: SL0101</h3>
            <div class="flex ">
                <a href="" href="" class="mr-5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                      </svg>                  
                </a>
                <a href="" href="" class="mr-5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                      </svg>
                </a>
                <a href="" href="" class="mr-5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
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
                <li>Walk-in-cusomer</li>
                <li>walk-in-cosumer@example.com</li>
                <li>123456780</li>
                <li>N45. Dhaka</li>
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
            <p>Informacion de Factura</p>
            <ul>
                <li>Referencia: SL0101</li>
                <li>Estado del pago: Pagado</li>
                <li>Estado: Completo</li>
            </ul>
        </div>
      </div>
    <div class=" w-full overflow-x-auto flex justify-center">
        <table class="m-6 text-left border-collapse">
            <thead>
              <tr>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Nombre de Producto</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Precio</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Descuento</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">TAX</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Subtotal</th>
            </thead>
            <tbody>
                <tr class="hover:bg-grey-lighter">
                  <td class="py-4 px-6 border-b border-grey-light"><img class="w-1/5 inline mr-5" src="{{ asset('uploads/5b05a635-75eb-4aa3-8b32-5466643ad058.jpg') }}" alt="Imagen de producto"> <p class="inline">Producto 1</p></td>
                  <td class="py-4 px-6 border-b border-grey-light">402.22</td>
                  <td class="py-4 px-6 border-b border-grey-light">0.00</td>
                  <td class="py-4 px-6 border-b border-grey-light">0.00</td>
                  <td class="py-4 px-6 border-b border-grey-light">402.22</td>
                  
                </tr>        
            </tbody>
          </table>
    </div>
  </div>
  <div class="m-6">

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