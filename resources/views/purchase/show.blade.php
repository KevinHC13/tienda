@extends('layouts.admin')

@push('styles')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
@endpush

@section('content')
<div class="m-4">
  <div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
    <div class="rounded-t mb-0 px-0 border-0">
      <div class="flex flex-wrap items-center px-4 py-2">
        <div class="relative w-full max-w-full flex-grow flex-1">
          <h3 class="mt-3  ml-6 font-semibold text-base text-gray-900 dark:text-gray-50">Compra</h3>
        </div>
        <div class="relative w-full max-w-full flex-grow flex-1 text-right">
          
        </div>
      </div>
      <div class=" w-full overflow-x-auto flex justify-center">
  
          <section class="text-gray-600 body-font overflow-hidden">
              <div class="container px-5 py-24 mx-auto">
                <div class="lg:w-4/5 mx-auto flex flex-wrap">
                  <img alt="ecommerce" class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded" src="{{ asset('images/compras.png') }}">
                  <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                    <h2 class="text-sm title-font text-gray-500 tracking-widest">Referencia</h2>
                    <h1 class="text-black text-3xl title-font font-medium mb-1">{{$purchase->code}}</h1>
                    <div class="flex mb-4">
                    </div>
                    <div class=" w-full overflow-x-auto flex justify-center">
                      <table class="m-6 w-full text-left border-collapse">
                        <tbody>
                              <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light">Proveedor</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{ $purchase->provedor->name }}</td>
                              </tr>                        
                              <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light">Referencia</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{ $purchase->code }}</td>
                              </tr>
                              <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light">Estatus</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{ $purchase->estatus }}</td>
                              </tr>
                              <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light">Total</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{ $purchase->tota }}</td>
                              </tr>
                              <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light">Pagado</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{ $purchase->pagado }}</td>
                              </tr>
                              <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light">Pendiente</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{ $purchase->pendiente }}</td>
                              </tr>    
                              <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light">Estatus de pago</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{ $purchase->estatus_pago }}</td>
                              </tr>
                              <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light">Fecha</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{ $purchase->created_at->format('Y-m-d') }}</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                </section>
      
                
      
          </div>
          <div class=" w-full overflow-x-auto flex justify-center">
  
            <section class="text-with body-font w-full overflow-hidden">
                <div class="container px-5 w-full mx-auto">
                  <div class="mx-auto w-full flex flex-wrap">
                    <div class="w-full lg:pl-10  mt-6 lg:mt-0">
                     

                      <div class="flex mb-4">
                      </div>
                      <div class="w-full overflow-x-auto">
                        <div class="table-responsive">
                        <table class="m-6 text-left border-collapse w-full">
                          <thead>
                            <tr class="hover:bg-grey-lighter">
                              <td class="py-4 px-6 border-b border-grey-light">Nombre del Producto</td>
                              <td class="py-4 px-6 border-b border-grey-light">Cantidad</td>
                              <td class="py-4 px-6 border-b border-grey-light">Precio de Compra</td>
                              <td class="py-4 px-6 border-b border-grey-light">Costo Unitario</td>
                            </tr> 

                          </thead>
                          <tbody data-table="{{ $purchase->id }}" >
                          @if ($purchase->productos)
                              @foreach ($purchase->productos as $product)
                                <tr class="hover:bg-grey-lighter">
                                  <td class="py-4 px-6 border-b border-grey-light"> <img class="inline w-24 mr-5" src="{{ asset('uploads/'. $product->picture) }}" alt="Imagen de producto"> {{ $product->name }}</td>
                                  <td class="py-4 px-6 border-b border-grey-light">{{ $product->pivot->add_stock }}</td>
                                  <td class="py-4 px-6 border-b border-grey-light">{{ $product->purchase_price }}</td>
                                  <td class="py-4 px-6 border-b border-grey-light">{{ $product->sale_price }}</td>
                                </tr> 
                              @endforeach                             
                          @endif 
                            
                            
                            
                            
                                             
                              </tbody>
                            </table>
                          </div>
                        </div>
                          
                        </div>
                      </div>
                    </div>
                  </section>
        
                  
        
            </div>


        </div>
          <div class="m-6">
              <a type="button" href="{{ route('purchase.index') }}" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Cancelar</a>    
          </div>  
      </div>
      <!-- ./Social Traffic -->
      
      </div>


@endsection