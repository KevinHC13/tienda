@extends('layouts.admin')

@section('content')

<div class="m-4">
    <div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
      <div class="rounded-t mb-0 px-0 border-0">
        <div class="flex flex-wrap items-center px-4 py-2">
          <div class="relative w-full max-w-full flex-grow flex-1">
            <h3 class=" ml-6 font-semibold text-base text-gray-900 dark:text-gray-50">Lista de Usuarios</h3>
          </div>
          <div class="relative w-full max-w-full flex-grow flex-1 text-right">
            
            <div>
              <a  href="{{ route('usario.create') }}" class="inline-flex px-5 py-3 text-white bg-gray-600 hover:bg-gray-700 focus:bg-gray-700 rounded-md m-5">
                <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="flex-shrink-0 h-6 w-6 text-white -ml-1 mr-2">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Nuevo
              </a>
          </div>
          </div>
        </div>
        <div class=" w-full overflow-x-auto flex justify-center">
          <table class="m-6 text-left border-collapse">
            <thead>
              <tr>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Foto</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Nombre</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Apellido</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Usuario</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Telefono</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Email</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Estatus</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Accion</th>
              </tr>
            </thead>
            <tbody>
              @if ($usarios->count())
                @foreach ($usarios as $usario)
                <tr class="hover:bg-grey-lighter">
                  <td class="py-4 px-6 border-b border-grey-light"><img class="w-1/5 inline mr-5" src="{{ asset('uploads/'. $usario->picture ) }}" alt="Imagen de perfil Cliente"> </td>
                  <td class="py-4 px-6 border-b border-grey-light">{{$usario->name}}</td>
                  <td class="py-4 px-6 border-b border-grey-light">{{$usario->lastname}}</td>
                  <td class="py-4 px-6 border-b border-grey-light">{{$usario->username}}</td>
                  <td class="py-4 px-6 border-b border-grey-light">{{$usario->telefono}}</td>
                  <td class="py-4 px-6 border-b border-grey-light">{{$usario->email}}</td>

                  <td class="py-4 px-6 border-b border-grey-light">
                  
                    <label class="relative inline-flex items-center mr-5 cursor-pointer">
                        <input type="checkbox" value="" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-200 rounded-full peer dark:bg-red-700 peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600"></div>
                      </label>
                
                  </td>


                  <td class="py-4 px-6 border-b border-grey-light">
                    <a href="{{ route('usario.show', $usario) }}" class="block text-sky-600 font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark">Ver</a>
                    <a href="{{ route('usario.edit', $usario) }}" class="text-sky-600 font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark">Editar</a>
                  <form action="{{ route('usario.destroy', $usario) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <input 
                        type="submit" 
                        value="Eliminar"
                        class="text-red-600 font-bold py-1 px-3 rounded text-xs bg-blue hover:bg-blue-dark  cursor-pointer"
                        >
                  </form>
                </td>
              </tr>  
                @endforeach
                
              @endif
            
          

@endsection