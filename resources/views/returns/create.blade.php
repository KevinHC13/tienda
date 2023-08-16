@extends('layouts.admin')

@push('js')
<meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="{{ asset('js/returns.js') }}" type="module" defer ></script> 
    
@endpush

@section('content')

<div class="m-4">
<div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
  <div class="rounded-t mb-0 px-0 border-0">
    <div class=" flex flex-wrap items-center px-4 py-2">
      <div class=" border-b-2 relative w-full max-w-full flex-grow flex-1">
        <div class="m-5 flex justify-between">
            <h3 class=" ml-6 font-semibold text-base text-gray-900 dark:text-gray-50">Devolucion</h3>
            
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
    <div class="w-full overflow-x-auto">
      <div class="table-responsive">
        <table class="m-6 w-full text-left border-collapse">
            <thead>
              <tr>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Nombre de Producto</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Precio</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Cantidad</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">IVA</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Subtotal</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Devolucion</th>
            </thead>
            <tbody data-saleid="{{ $sale->id }}" >
              @foreach ($sale->detalles as $detail)
                <tr class="hover:bg-grey-lighter">
                  <td class="py-4 px-6 border-b border-grey-light"><img class="w-24 inline mr-5" src="{{ asset('uploads/'.$detail->producto->picture) }}" alt="Imagen de producto"> <p class="inline">{{ $detail->producto->name }}</p></td>
                  <td class="py-4 px-6 border-b border-grey-light">$ {{ $detail->producto->sale_price }}</td>
                  <td class="py-4 px-6 border-b border-grey-light">{{ $detail->quantity }}</td>
                  <td class="py-4 px-6 border-b border-grey-light">$ {{ $detail->producto->sale_price * $detail->quantity * .16 }}</td>
                  <td class="py-4 px-6 border-b border-grey-light">$ {{ $detail->producto->sale_price * $detail->quantity }}</td>
                  <td class="py-4 px-6 border-b border-grey-light">
                    <div class="flex justify-between">
                      <button
                          data-buttonDown="{{ $detail->producto->id }}"
                          type="button"
                          class="inline-block rounded border-2 border-primary px-6 pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-primary transition duration-150 ease-in-out hover:border-primary-600 hover:bg-neutral-500 hover:bg-opacity-10 hover:text-primary-600 focus:border-primary-600 focus:text-primary-600 focus:outline-none focus:ring-0 active:border-primary-700 active:text-primary-700 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10"
                          data-te-ripple-init>
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />
                          </svg>
          
                        
                      </button>
                          <p class="text-gray-500 block" data-quantity="{{ $detail->quantity }}" data-lableQuantity="{{ $detail->producto->id }}" >0</p>
                          <button
                              data-buttonUp="{{ $detail->producto->id }}"
                              type="button"
                              class="inline-block rounded border-2 border-primary px-6 pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-primary transition duration-150 ease-in-out hover:border-primary-600 hover:bg-neutral-500 hover:bg-opacity-10 hover:text-primary-600 focus:border-primary-600 focus:text-primary-600 focus:outline-none focus:ring-0 active:border-primary-700 active:text-primary-700 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10"
                              data-te-ripple-init>
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                              </svg>
                          </button>
                      </div>

                  </td>

                </tr>
              @endforeach
            </tbody>
          </table>
    </div>
    </div>
  </div>
  <div class="m-6">
    <div class="m-6">
      <button data-sendButton type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Guardar</button>
      <a type="button" href="{{ route('returns.index') }}" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Cancelar</a>    
  </div>  

  </div>
</div>
</div>

</div>
<!-- ./Social Traffic -->
</div>


<button
  type="button"
  data-modalBtn
  class="hidden rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
  data-te-toggle="modal"
  data-te-target="#rightTopModal"
  data-te-ripple-init
  data-te-ripple-color="light">
  Top right
</button>

<div
  data-te-modal-init
  class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
  id="rightTopModal"
  tabindex="-1"
  aria-labelledby="rightTopModalLabel"
  aria-hidden="true">
  <div
    data-te-modal-dialog-ref
    class="pointer-events-none absolute right-7 h-auto w-full translate-x-[100%] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px]">
    <div
      class="min-[576px]:shadow-[0_0.5rem_1rem_rgba(#000, 0.15)] pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-neutral-600">
      <div
        class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
        <!--Modal title-->
        <h5
          class="text-xl font-medium leading-normal text-neutral-800 dark:text-neutral-200"
          id="exampleModalLabel">
          Error
        </h5>
        <!--Close button-->
        <button
          type="button"
          class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
          data-te-modal-dismiss
          aria-label="Close">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="h-6 w-6">
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      <!--Modal body-->
      <div data-modalMessage class="relative flex-auto p-4" data-te-modal-body-ref>
        Modal body text goes here.
      </div>

      <!--Modal footer-->
      <div
        class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
        <button
          type="button"
          class="inline-block rounded bg-primary-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-100 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-primary-accent-200"
          data-te-modal-dismiss
          data-te-ripple-init
          data-te-ripple-color="light">
          Close
        </button>
        
      </div>
    </div>
  </div>
</div>



@endsection