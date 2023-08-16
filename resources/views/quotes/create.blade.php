@extends('layouts.admin')

@push('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://kit.fontawesome.com/e56805774d.js" crossorigin="anonymous"></script>
@endpush

@push('js')
  <script src="{{ asset('js/quotes.js') }}" type="module" defer ></script>    
@endpush

@section('content')
<div class="flex justify-center h-full">
<div class="bg-white dark:bg-gray-700 w-full">
    <div class="mx-auto w-full max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
        <div class="mt-4 relative w-full max-w-full flex-grow flex-1">
            <h3 class="ml-6 font-semibold text-base text-gray-900 dark:text-white ">Cotizaciones</h3>
          </div>

        <div>
            <ul class="flex m-8 justify-evenly">
              <li data-categoryId="0" class="cursor-pointer">
                <div class="flex justify-center flex-col items-center w-32 h-32 rounded-xl overflow-hiden bg-transparent">
                  <img class="w-1/2  h-1/2" src="{{ asset('icons/bag.png') }}" alt="">
                  <h2 class=" text-black dark:text-white" >Todos</h2>
              </div>
              </li>
              @foreach ($categories as $category)
                <li data-categoryId="{{ $category->id }}" class="cursor-pointer">
                  <div class="flex justify-center flex-col items-center w-32 h-32 rounded-xl overflow-hiden bg-transparent">
                    <img class="w-1/2 h-1/2 rounded-full" src="{{ asset('uploads/' . $category->picture) }}" alt="">
                    <h2 class=" text-black dark:text-white h-6 text-center overflow-hidden text-ellipsis" >{{ $category->name }}</h2>
                  </div>
                </li>  
              @endforeach
            </ul>
        </div>
      <div data-products class="w-full min-w-full grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">  
      </div>
    </div>
  </div>
</div>

<div class="fixed top-14 right-0 hidden" data-carMenu>
<div class="pointer-events-auto h-screen flex max-w-md">
  <div class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
    <div class="flex-1 overflow-y-auto px-4 py-6 sm:px-6">
      <div class="flex items-start justify-between">
        <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">Productos</h2>
        <div class="ml-3 flex h-7 items-center">
          <button data-showMenu type="button" class="relative -m-2 p-2 text-gray-400 hover:text-gray-500">
            <span class="absolute -inset-0.5"></span>
            <span class="sr-only">Close panel</span>
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>

      <div class="mt-8">
        <div class="flow-root">
          <div class="relative z-0 w-full mb-6 group text-black">
            <label for="client_id" class="block mb-2 text-sm font-medium text-gray-900 ">Cliente</label>
            <select data-clientId name="client_id" id="client_id" class="text-gray-900 dark:text-gray-900" data-provedorId data-te-select-init data-te-select-filter="true">
                @foreach ($clients as $client)
                <option  value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }} class="dark:text-gray-900">
                    {{ $client->name }}
                </option>
                @endforeach

              </select>
        </div>
          <ul data-productsList role="list" class="-my-6 divide-y divide-gray-200">
            <!-- More products... -->
          </ul>
        </div>
      </div>
    </div>

    <div class="border-t border-gray-200 px-4 py-6 sm:px-6">
      <div class="flex justify-between text-base mb-4 font-medium text-gray-900">
        <p>Subtotal</p>
        <p data-subTotal>$0.00</p>
      </div>
      <div class="flex justify-between text-base mb-4 font-medium text-gray-900">
        <p>IVA</p>
        <p data-iva>$0.00</p>
      </div>
      <div class="flex justify-between text-base mb-4 font-medium text-gray-900">
        <p>Total</p>
        <p data-total>$0.00</p>
      </div>
      <p class="mt-0.5 text-sm text-gray-500">Haga click en el boton para terminar la venta.</p>
      <div class="mt-6">
        <a href="#" data-submitButton class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700">
          Terminar Cotizacion
        </a>
      </div>
      <div class="mt-6 flex justify-center text-center text-sm text-gray-500">
        <p>
          or
          <button type="button" class="font-medium text-indigo-600 hover:text-indigo-500">
            Continue Shopping
            <span aria-hidden="true"> &rarr;</span>
          </button>
        </p>
      </div>
    </div>
  </div>
</div>
</div>


<div class="fixed top-20 right-10"
  id="animate-click"
  data-te-animation-reset="true"
  data-te-animation="[tada_1s_ease-in-out]"
  data-carMenu>
  <button
    data-showMenu
    type="button"
    data-te-ripple-init
    data-te-ripple-color="light"
    class="inline-block rounded-full bg-primary p-2 uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 text-white">
      <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
    </svg>
  </button>
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






