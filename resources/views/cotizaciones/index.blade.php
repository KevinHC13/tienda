@extends('layouts.admin')

@section('content')

<div class="m-4">
  <div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
      <div class="rounded-t mb-0 px-0 border-0">
          <div class="flex flex-wrap items-center px-4 py-2">
              <div class="relative w-full max-w-full flex-grow flex-1">
                  <h3 class="ml-6 font-semibold text-base text-gray-900 dark:text-gray-50">Lista de Cotizaciónes</h3>
              </div>
              <div class="relative w-full max-w-full flex-grow flex-1 text-right">
                  <div>
                      <a href="{{ route('cotizacion.create') }}" class="inline-flex px-5 py-3 text-white bg-gray-600 hover:bg-gray-700 focus:bg-gray-700 rounded-md m-5">
                          <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="flex-shrink-0 h-6 w-6 text-white -ml-1 mr-2">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                          </svg>
                          Nuevo
                      </a>
                  </div>
              </div>
          </div>
          <div class="w-full overflow-x-auto">
              <div class="table-responsive">
                  <table class="m-6 text-left border-collapse w-full">
                      <thead>
                          <tr>
                              <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light m">Foto</th>
                              <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Nombre Producto</th>
                              <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Nombre Cliente</th>
                              <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">No° Referencia</th>
                              
                              <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Estado</th>
                              <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Total($)</th>
                              <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Accion</th>
                          </tr>
                      </thead>
                      <tbody>
                          @if ($cotizaciones->count())
                          @foreach ($cotizaciones as $cotizacion)
                          <tr class="hover:bg-grey-lighter">
                            <td><img src="{{ asset('uploads/' . $cotizacion->picture) }}" alt="Product Image" class="h-20 w-20"></td>
                                                       
                            <td class="py-4 px-6 border-b border-grey-light">{{$cotizacion->product_id}}</td>
                            <td class="py-4 px-6 border-b border-grey-light">{{$cotizacion->client_id}}</td>
                            <td class="py-4 px-6 border-b border-grey-light">{{$cotizacion->referencia}}</td>
                            <td class="py-4 px-6 border-b border-grey-light">{{$cotizacion->estado}}</td>
                                                      
                            <td class="py-4 px-6 border-b border-grey-light">${{$cotizacion->total}}</td>
                              <td class="py-4 px-6 border-b border-grey-light">
                                    <form action="{{ route('cotizacion.destroy', $cotizacion->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">Eliminar</button>
                                    </form>
                                  </form>
                              </td>
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


@endsection