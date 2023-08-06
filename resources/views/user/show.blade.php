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
          <h3 class="mt-3  ml-6 font-semibold text-base text-gray-900 dark:text-gray-50">Usuario</h3>
        </div>
        <div class="relative w-full max-w-full flex-grow flex-1 text-right">
          
        </div>
      </div>
      <div class=" w-full overflow-x-auto flex justify-center">
  
          <section class="text-gray-600 body-font overflow-hidden">
              <div class="container px-5 py-24 mx-auto">
                <div class="lg:w-4/5 mx-auto flex flex-wrap">
                  <img alt="ecommerce" class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded" src="{{ asset('uploads/'. $user  ->picture) }}">
                  <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                    <h2 class="text-sm title-font text-gray-500 tracking-widest">Usuario</h2>
                    <h1 class="text-black text-3xl title-font font-medium mb-1">{{$user->username}}</h1>
                    <div class="flex mb-4">
                    </div>
                    <div class=" w-full overflow-x-auto flex justify-center">
                      <table class="m-6 w-full text-left border-collapse">
                        <tbody>
                              <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light">Nombre</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{ $user->name }}</td>
                              </tr>                        
                              <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light">Apellido</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{ $user->last_name }}</td>
                              </tr>
                              <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light">Telefono</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{ $user->phone_number }}</td>
                              </tr>    
                              <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light">Email</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{ $user->email }}</td>
                              </tr>
                              <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light">Estatus</td>
                                <td class="py-4 px-6 border-b border-grey-light">
                                  <input
                                  class="mr-2 mt-[0.3rem] h-3.5 w-8 appearance-none rounded-[0.4375rem] bg-neutral-300 before:pointer-events-none before:absolute before:h-3.5 before:w-3.5 before:rounded-full before:bg-transparent before:content-[''] after:absolute after:z-[2] after:-mt-[0.1875rem] after:h-5 after:w-5 after:rounded-full after:border-none after:bg-neutral-100 after:shadow-[0_0px_3px_0_rgb(0_0_0_/_7%),_0_2px_2px_0_rgb(0_0_0_/_4%)] after:transition-[background-color_0.2s,transform_0.2s] after:content-[''] checked:bg-primary checked:after:absolute checked:after:z-[2] checked:after:-mt-[3px] checked:after:ml-[1.0625rem] checked:after:h-5 checked:after:w-5 checked:after:rounded-full checked:after:border-none checked:after:bg-primary checked:after:shadow-[0_3px_1px_-2px_rgba(0,0,0,0.2),_0_2px_2px_0_rgba(0,0,0,0.14),_0_1px_5px_0_rgba(0,0,0,0.12)] checked:after:transition-[background-color_0.2s,transform_0.2s] checked:after:content-[''] hover:cursor-pointer focus:outline-none focus:ring-0 focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[3px_-1px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-5 focus:after:w-5 focus:after:rounded-full focus:after:content-[''] checked:focus:border-primary checked:focus:bg-primary checked:focus:before:ml-[1.0625rem] checked:focus:before:scale-100 checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] disabled:cursor-default disabled:opacity-60 dark:bg-neutral-600 dark:after:bg-neutral-400 dark:checked:bg-primary dark:checked:after:bg-primary dark:focus:before:shadow-[3px_-1px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca]"
                                  type="checkbox"
                                  role="switch"
                                  id="flexSwitchCheckDisabled"
                                  disabled 
                                  @if ($user->estatus == "1")
                                      checked
                                  @endif
                                  />  
                                </td>
                              </tr>   
                              <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light">Rol</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{ $user->rol }}</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                </section>
      
                
      
          </div>
        </div>
          <div class="m-6">
              <a type="button" href="{{ route('user.index') }}" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Cancelar</a>    
          </div>  
      </div>
      <!-- ./Social Traffic -->
      
      </div>


@endsection