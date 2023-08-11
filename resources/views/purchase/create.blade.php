@extends('layouts.admin')

@push('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <script src="{{ asset('js/compras.js') }}" defer></script>
@endpush

@section('content')
   
<div class="m-4">
    <div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
      <div class="rounded-t mb-0 px-0 border-0">
        <div class="px-4 py-2">
          <div class="mt-4 relative w-full max-w-full flex-grow flex-1">
            <h3 class="ml-6 font-semibold text-base text-gray-900 dark:text-gray-50">Nueva Compra</h3>
          </div>

          <div class="flex justify-center">
            
            
        <form class="w-full m-9 " data-form action="{{ route('purchase.store') }}" method="POST" novalidate>
            @csrf
            <div class="relative z-0 w-1/2 mb-6 group">
                @if(session('mensaje'))
                <div class="bg-red-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                    {{session('mensaje')}}
                </div>
            @endif
            </div>
          <div data-error class="hidden bg-red-500 p-2 non rounded-lg mb-6 text-white text-center uppercase font-bold">
            
          </div>

            <div class="flex justify-between" >

                <div class="relative z-0 w-1/4 mb-6 group">
                    <label for="provedor_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Proveedor</label>
                    <select name="provedor_id" id="provedor_id" data-provedorId data-te-select-init data-te-select-filter="true">
                        @foreach ($provedores as $provedor)
                        <option  value="{{ $provedor->id }}" {{ old('provedor_id') == $provedor->id ? 'selected' : '' }}>
                            {{ $provedor->name }}
                        </option>
                        @endforeach

                      </select>
                    @error('provedor_id')
                        <p class="text-red-600 my-2 rounded-lg text-sm p-2 text-center" >{{ $message }}</p>
                    @enderror
                </div>


                

                <div class="relative z-0 w-1/4 mb-6 group">
                    <input value="{{ old('date') }}" data-date type="date" name="date" id="date" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="date" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Fecha</label>
                    @error('date')
                        <p class="text-red-600 my-2 rounded-lg text-sm p-2 text-center" >{{ $message }}</p>
                    @enderror
                </div>

                <div class="relative z-0 w-1/4 mb-6 group">
                    <input value="{{ old('code') }}" data-code type="text" name="code" id="code" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="code" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Referencia</label>
                    @error('code')
                        <p class="text-red-600 my-2 rounded-lg text-sm p-2 text-center" >{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <div class="flex justify-between">
                <div class="relative z-0 w-1/4 mb-6 group">
                    <label for="product_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Producto</label>
                    <select id="product_id" formnovalidate data-product data-te-select-init data-te-select-filter="true">
                        @foreach ($products as $product)
                        <option  value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                        @endforeach

                      </select>
                    @error('product_id')
                        <p class="text-red-600 my-2 rounded-lg text-sm p-2 text-center" >{{ $message }}</p>
                    @enderror
                </div>

                <div class="relative z-0 w-1/4 mb-6 group">
                    <input value="{{ old('stock') }}" type="number" formnovalidate id="stock" data-stock="" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="stock" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Cantidad</label>
                    @error('stock')
                        <p class="text-red-600 my-2 rounded-lg text-sm p-2 text-center" >{{ $message }}</p>
                    @enderror
                </div>

                <div class="relative z-0 w-1/4 mb-6 group">
                    <button
                      type="button"
                      data-addProduct
                      data-te-ripple-init
                      data-te-ripple-color="light"
                      class="inline-block rounded-full bg-primary px-7 pb-2.5 pt-3 text-sm font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                      </svg>
                      
                    </button>
                </div>
            </div>

            <div>
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                      <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                          <table class="min-w-full text-left text-sm font-light">
                            <thead class="border-b font-medium dark:border-neutral-500">
                              <tr>
                                <th scope="col" class="px-6 py-4">Nombre del Producto</th>
                                <th scope="col" class="px-6 py-4">Cantidad</th>
                                <th scope="col" class="px-6 py-4">Precio de Compra</th>
                                <th scope="col" class="px-6 py-4">Costo Unitario</th>
                                <th scope="col" class="px-6 py-4"></th>
                              </tr>
                            </thead>
                            <tbody data-tableItems>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
            <div class="w-1/3">
              <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                  <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                      <table class="min-w-full text-left text-sm font-light">
                        <thead class="border-b font-medium dark:border-neutral-500">
                          <h1 class="h-1 text-3xl mb-5 mt-4">Resumen</h1>
                        </thead>
                        <tbody>
                          <tr class="border-b dark:border-neutral-500">
                            <td class="whitespace-nowrap px-6 py-4 font-medium"><label class="w-16 text-center bg-transparent">Subtotal</label></td>
                            <td class="whitespace-nowrap px-6 py-4 font-medium"><label data-subtotal class="w-16 text-center bg-transparent">0</label></td>
                          </tr>
                          <tr class="border-b dark:border-neutral-500">
                            <td class="whitespace-nowrap px-6 py-4 font-medium"><label class="w-16 text-center bg-transparent">IVA</label></td>
                            <td class="whitespace-nowrap px-6 py-4 font-medium"><label data-iva class="w-16 text-center bg-transparent">0</label></td>
                          </tr>
                          <tr class="border-b dark:border-neutral-500">
                            <td class="whitespace-nowrap px-6 py-4 font-medium"><label class="w-16 text-center bg-transparent">Total</label></td>
                            <td class="whitespace-nowrap px-6 py-4 font-medium"><label data-total class="w-16 text-center bg-transparent">0</label></td>
                          </tr>
                          </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            
            <div class="flex justify-start mt-4 ">
            <button type="submit" class="text-white mr-2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Guardar</button>

            <a type="button" href="{{ route('purchase.index') }}" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Cancelar</a>
            </div>
        </form>
    </div>
    </div>
      </div>
    </div>
</div>
</div>

@endsection