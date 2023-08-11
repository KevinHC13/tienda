@extends('layouts.admin')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endpush

@section('content')
    
<div class="m-4">
    <div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
      <div class="rounded-t mb-0 px-0 border-0">
        <div class="px-4 py-2">
          <div class="mt-4 relative w-full max-w-full flex-grow flex-1">
            <h3 class="ml-6 font-semibold text-base text-gray-900 dark:text-gray-50">Editar</h3>
          </div>

        <div class="flex justify-center">
        <div class="w-1/3 flex mt-11 mb-11 h-max">
            <form action="{{ route('imagenes.store') }}" method="POST" enctype="multipart/form-data" class="dropzone border rounded w-full -h-1/2 text-black" id="dropzone">
                @csrf
            </form>
        </div>
        <form class="w-1/2 m-9 " action="{{ route('product.update', $product) }}" method="POST" novalidate>
            @csrf
            @method('PUT')
            <div class="relative z-0 w-full mb-6 group">
                <input value="{{ old('name', $product->name) }}" type="text" name="name" id="name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombre</label>
                @error('name')
                    <p class="text-red-600 my-2 rounded-lg text-sm p-2 text-center" >{{ $message }}</p>
                @enderror
            </div>

            <div class="relative z-0 w-full mb-6 group">
                <input value="{{ old('purchase_price', $product->purchase_price) }}" type="number" name="purchase_price" id="purchase_price" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="purchase_price" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Precio de compra</label>
                @error('purchase_price')
                    <p class="text-red-600 my-2 rounded-lg text-sm p-2 text-center" >{{ $message }}</p>
                @enderror
            </div>

            <div class="relative z-0 w-full mb-6 group">
                <input value="{{ old('sale_price', $product->sale_price) }}" type="number" name="sale_price" id="sale_price" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="sale_price" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Precio de venta</label>
                @error('sale_price')
                    <p class="text-red-600 my-2 rounded-lg text-sm p-2 text-center" >{{ $message }}</p>
                @enderror
            </div>



            <div class="relative z-0 w-full mb-6 group">
                <input value="{{ old('stock', $product->stock) }}" type="number" name="stock" id="stock" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="stock" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Stock</label>
                @error('stock')
                    <p class="text-red-600 my-2 rounded-lg text-sm p-2 text-center" >{{ $message }}</p>
                @enderror
            </div>

            <div class="relative z-0 w-full mb-6 group">
                <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categoria</label>
                <select name="category_id" id="category_id" data-te-select-init data-te-select-filter="true">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if($product->category_id == $category->id) selected @endif>
                        {{ $category->name }}
                    </option>
                    @endforeach
                    
                  </select>
                @error('category_id')
                    <p class="text-red-600 my-2 rounded-lg text-sm p-2 text-center" >{{ $message }}</p>
                @enderror
            </div>

            <div class="relative z-0 w-full mb-6 group">
                <label for="subcategory_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subcategoria</label>
                <select name="subcategory_id" id="subcategory_id" data-te-select-init data-te-select-filter="true" data-te-select-clear-button="true">
                    <option value="" hidden selected></option>
                    @foreach ($subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}" @if($product->subcategory_id == $subcategory->id) selected @endif>
                        {{ $subcategory->name }}
                    </option>
                    @endforeach
                    
                  </select>
                @error('subcategory_id')
                    <p class="text-red-600 my-2 rounded-lg text-sm p-2 text-center" >{{ $message }}</p>
                @enderror
            </div>

            <div class="relative z-0 w-full mb-6 group">
                <label for="brand_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Marca</label>
                <select name="brand_id" id="brand_id" data-te-select-init data-te-select-filter="true">
                    @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}" @if($product->brand_id == $brand->id) selected @endif>
                        {{ $brand->name }}
                    </option>
                    @endforeach
                    
                  </select>
                @error('brand_id')
                    <p class="text-red-600 my-2 rounded-lg text-sm p-2 text-center" >{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <input type="hidden" name="picture" value="{{old('picture', $product->picture)}}" >
                @error('picture')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Guardar</button>
        <a type="submit" href="{{ route('product.index') }}" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Cancelar</a>
        </form>
    </div>
    </div>
      </div>
    </div>
</div>
</div>

<script>
    $(document).ready(function() {
        $('#category_id').change(function() {
            var categoryId = $(this).val();
            var subcategorySelect = $('#subcategory_id');
            
            $.ajax({
                url: '/product/subcategory/' + categoryId, // Ruta a tu controlador para obtener subcategorías
                type: 'GET',
                success: function(response) {
                    subcategorySelect.empty();
                    subcategorySelect.append($('<option>', {
                        value: '',
                        text: ''
                    }));
                    
                    $.each(response.subcategories, function(key, value) {
                        subcategorySelect.append($('<option>', {
                            value: key,
                            text: value
                        }));
                    });
                }
            });
        });
    });
</script>


@endsection
