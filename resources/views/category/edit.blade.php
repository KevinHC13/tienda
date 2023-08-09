@extends('layouts.admin')


@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('content')
    
<div class="m-4">
    <div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
      <div class="rounded-t mb-0 px-0 border-0">
        <div class="px-4 py-2">
          <div class="mt-4 relative w-full max-w-full flex-grow flex-1">
            <h3 class="ml-6 font-semibold text-base text-gray-900 dark:text-gray-50">Nuevo categoria</h3>
          </div>

        <div class="flex justify-center">
            <div class="w-1/3 flex mt-11 mb-11 h-max">
                <form action="{{ route('imagenes.store') }}" method="POST" enctype="multipart/form-data" class="dropzone border rounded w-full -h-1/2 text-black" id="dropzone">
                    @csrf
                </form>
            </div>
        <form class="w-1/2 m-9 " action="{{ route('category.update', $category)  }}" method="POST" novalidate>
            @csrf
            @method('PUT')
            <div class="relative z-0 w-full mb-6 group">
                <input value="{{ old('name',$category->name) }}" type="text" name="name" id="name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombre de Categoria</label>
                @error('name')
                    <p class="text-red-600 my-2 rounded-lg text-sm p-2 text-center" >{{ $message }}</p>
                @enderror
            </div>

            <div class="relative z-0 w-full mb-6 group">
                <input value="{{ old('code',$category->code) }}" type="text" name="code" id="code" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="code" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Codigo de categoria</label>
                @error('code')
                    <p class="text-red-600 my-2 rounded-lg text-sm p-2 text-center" >{{ $message }}</p>
                @enderror
            </div>

            <div class="relative z-0 w-full mb-6 group">
                <textarea name="description" id="description" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required >{{ old('description',$category->description) }}</textarea>
                <label for="description" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Description</label>
                @error('description')
                    <p class="text-red-600 my-2 rounded-lg text-sm p-2 text-center" >{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <input type="hidden" name="picture" value="{{old('picture',$category->picture)}}" >
                @error('picture')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >{{ $message }}</p>
                @enderror
            </div>



            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Guardar</button>
        <a type="button" href="{{ route('category.index') }}" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Cancelar</a>
        </form>
    </div>
    </div>
      </div>
    </div>
</div>
</div>



@endsection






