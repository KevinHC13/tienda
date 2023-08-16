@extends('layouts.admin')

@section('content')

<div class="m-4">
<div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
  <div class="rounded-t mb-0 px-0 border-0">
    <div class="flex flex-wrap items-center px-4 py-2">
      <div class="relative w-full max-w-full flex-grow flex-1">
        <h3 class=" ml-6 font-semibold text-base text-gray-900 dark:text-gray-50">Lista de Cotizaciones</h3>
      </div>
      <div class="relative w-full max-w-full flex-grow flex-1 text-right">
        
        <div>
          <a href="{{ route('quotes.create') }}" class="inline-flex px-5 py-3 text-white bg-gray-600 hover:bg-gray-700 focus:bg-gray-700 rounded-md m-5">
            <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="flex-shrink-0 h-6 w-6 text-white -ml-1 mr-2">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Nuevo
          </a>
      </div>
      </div>
    </div>
    <div class="w-full overflow-x-auto">
      <div class="table-responsive"> </div>
      <table class="m-6 text-left border-collapse w-full">
        <thead>
          <tr>
            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Vendedor</th>
            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Fecha</th>
            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Referencia</th>
            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Productos</th>
            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Cliente</th>
            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Total</th>
            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Facturador</th>
            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Accion</th>
          </tr>
        </thead>
        <tbody>
          @if ($quotes->count())
              @foreach ($quotes as $quote)
            <tr class="hover:bg-grey-lighter">
              <td class="py-4 px-6 border-b border-grey-light">{{ $quote->user->username }}</td>
              <td class="py-4 px-6 border-b border-grey-light">{{ $quote->created_at->format('d/m/Y') }}</td>
              <td class="py-4 px-6 border-b border-grey-light">{{ $quote->code }}</td>
              <td class="py-4 px-6 border-b border-grey-light">{{ $quote->detalles->count() }}</td>
              <td class="py-4 px-6 border-b border-grey-light">{{ $quote->client->name }}</td>
              <td class="py-4 px-6 border-b border-grey-light">$ {{ $quote->total }}</td>
              <td class="py-4 px-6 border-b border-grey-light">{{ $quote->user->username }} </td>
              <td class="py-4 px-6 border-b border-grey-light">
                <div class="relative" data-te-dropdown-ref>
                    <button
                      class="flex items-center whitespace-nowrap rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] motion-reduce:transition-none dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
                      type="button"
                      id="dropdownMenuButton1"
                      data-te-dropdown-toggle-ref
                      aria-expanded="false"
                      data-te-ripple-init
                      data-te-ripple-color="light">
                      Acciones
                      <span class="ml-2 w-2">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 20 20"
                          fill="currentColor"
                          class="h-5 w-5">
                          <path
                            fill-rule="evenodd"
                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                            clip-rule="evenodd" />
                        </svg>
                      </span>
                    </button>
                    <ul
                      class="absolute z-[1000] float-left m-0 hidden min-w-max list-none overflow-hidden rounded-lg border-none bg-white bg-clip-padding text-left text-base shadow-lg dark:bg-neutral-700 [&[data-te-dropdown-show]]:block"
                      aria-labelledby="dropdownMenuButton1"
                      data-te-dropdown-menu-ref>
                      <li>
                        <a
                          class=" text-sky-600 text-left block font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark"
                          href="{{ route('quotes.show', $quote) }}"
                          data-te-dropdown-item-ref
                          ><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 inline-block mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                          </svg>
                          Ver Detalles</a
                        >
                      </li>
                    </ul>
                  </div>
              </td>
            </tr>
            @endforeach
          @endif
        </tbody>
      </table>
    </div>
    </div>
  </div>
  <div class="m-6">
    {{$quotes->links() }}
  </div>
</div>
<!-- ./Social Traffic -->
</div>

@endsection
