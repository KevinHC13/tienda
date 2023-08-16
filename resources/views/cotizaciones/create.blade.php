@extends('layouts.admin')



@section('content')
<div class="m-4">
    <div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
      <div class="rounded-t mb-0 px-0 border-0">
        <div class="px-4 py-2">
          <div class="mt-4 relative w-full max-w-full flex-grow flex-1">
            <h3 class="ml-6 font-semibold text-base text-gray-900 dark:text-gray-50">Nueva Compra</h3>
          </div>

          <div class="flex justify-center">
            
            
        <form class="w-1/2 m-9 " action="{{ route('cotizacion.store') }}" method="POST" novalidate>
            @csrf
            <div class="relative z-0 w-full mb-6 group">
                            <label for="client" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selecciona un Cliente</label>
                            <select name="client_id" id="client"data-te-select-init data-te-select-filter="true">
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selecciona un Producto:</label>
                            <select name="product_id" id="product" data-te-select-init data-te-select-filter="true" >
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" data-price="{{ $product->sale_price }}">
                                        {{ $product->name }} - ${{ $product->sale_price }} (Stock: {{ $product->stock }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <input type="hidden" id="selected-price" name="price" value="{{ old('price') }}">

                        <div class="relative z-0 w-full mb-6 group">
                            <input value="{{ old('quantity') }}" type="number" name="quantity" id="quantity" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="quantity" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                Cantidad</label>
                            @error('referencia')
                                <p class="text-red-600 my-2 rounded-lg text-sm p-2 text-center" >{{ $message }}</p>
                            @enderror
                        </div>

                        
            <div class="relative z-0 w-full mb-6 group">
                <input value="{{ old('referencia') }}" type="number" name="referencia" id="referencia" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="referencia" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Numero de Referencia</label>
                @error('referencia')
                    <p class="text-red-600 my-2 rounded-lg text-sm p-2 text-center" >{{ $message }}</p>
                @enderror
            </div>

    
            <div class="relative z-0 w-full mb-6 group">
                <input value="{{ old('descripcion') }}" type="descripcion" name="descripcion" id="descripcion" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="descripcion" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Descripcion</label>
                @error('descripcion')
                    <p class="text-red-600 my-2 rounded-lg text-sm p-2 text-center" >{{ $message }}</p>
                @enderror
            </div>
            

                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Añadir</button>                    
                        <a type="button" href="{{ route('cotizacion.index') }}" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Regresar</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    const productSelect = document.getElementById('product');
    const selectedPriceInput = document.getElementById('selected-price');

    productSelect.addEventListener('change', () => {
        const selectedOption = productSelect.options[productSelect.selectedIndex];
        const selectedPrice = selectedOption.getAttribute('data-price');
        selectedPriceInput.value = selectedPrice;
    });
</script>








<div class="w-full overflow-x-auto">
    <div class="table-responsive">
        <table class="m-6 text-left border-collapse w-full">
        <thead>
            <tr>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Producto</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Precio</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Cantidad</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Subtotal</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">IVA</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Total</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Accion</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($latestCotizaciones as $cotizacion)
                <tr>
                    <td class="py-4 px-6 border-b border-grey-light">{{ $cotizacion->product_id }}</td>
                    <td class="py-4 px-6 border-b border-grey-light">${{ $cotizacion->price }}</td>
                    <td class="py-4 px-6 border-b border-grey-light">{{ $cotizacion->cantidad }}</td>
                    <td class="py-4 px-6 border-b border-grey-light">${{ $cotizacion->subtotal }}</td>
                    <td class="py-4 px-6 border-b border-grey-light">${{ $cotizacion->iva }}</td>
                    <td class="py-4 px-6 border-b border-grey-light">${{ $cotizacion->total }}</td>
                    <td class="py-4 px-6 border-b border-grey-light">
                        <form action="{{ route('cotizacion.destroy', $cotizacion->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
