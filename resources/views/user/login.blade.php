<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  @vite('resources/js/app.js')
  @stack('styles')
</head>
<body>

<!-- component -->
<style>
    /*remove custom style*/
      .circles{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }
      .circles li{
        position: absolute;
        display: block;
        list-style: none;
        width: 20px;
        height: 20px;
        background: rgba(255, 255, 255, 0.2);
        animation: animate 25s linear infinite;
        bottom: -150px;  
    }
    .circles li:nth-child(1){
        left: 25%;
        width: 80px;
        height: 80px;
        animation-delay: 0s;
    }
     
     
    .circles li:nth-child(2){
        left: 10%;
        width: 20px;
        height: 20px;
        animation-delay: 2s;
        animation-duration: 12s;
    }
     
    .circles li:nth-child(3){
        left: 70%;
        width: 20px;
        height: 20px;
        animation-delay: 4s;
    }
     
    .circles li:nth-child(4){
        left: 40%;
        width: 60px;
        height: 60px;
        animation-delay: 0s;
        animation-duration: 18s;
    }
     
    .circles li:nth-child(5){
        left: 65%;
        width: 20px;
        height: 20px;
        animation-delay: 0s;
    }
     
    .circles li:nth-child(6){
        left: 75%;
        width: 110px;
        height: 110px;
        animation-delay: 3s;
    }
     
    .circles li:nth-child(7){
        left: 35%;
        width: 150px;
        height: 150px;
        animation-delay: 7s;
    }
     
    .circles li:nth-child(8){
        left: 50%;
        width: 25px;
        height: 25px;
        animation-delay: 15s;
        animation-duration: 45s;
    }
     
    .circles li:nth-child(9){
        left: 20%;
        width: 15px;
        height: 15px;
        animation-delay: 2s;
        animation-duration: 35s;
    }
     
    .circles li:nth-child(10){
        left: 85%;
        width: 150px;
        height: 150px;
        animation-delay: 0s;
        animation-duration: 11s;
    }
      @keyframes animate {
     
        0%{
            transform: translateY(0) rotate(0deg);
            opacity: 1;
            border-radius: 0;
        }
     
        100%{
            transform: translateY(-1000px) rotate(720deg);
            opacity: 0;
            border-radius: 50%;
        }
     
    }
    </style>
    <div class="relative min-h-screen flex ">
        <div class="flex flex-col sm:flex-row items-center md:items-start sm:justify-center md:justify-start flex-auto min-w-0 bg-white">
          <div class="sm:w-1/2 xl:w-3/5 h-full hidden md:flex flex-auto items-center justify-center p-10 overflow-hidden bg-purple-900 text-white bg-no-repeat bg-cover relative"
            style="background-image: url({{asset('images/login.jpg')}});">
            <div class="absolute bg-gradient-to-b from-indigo-600 to-blue-500 opacity-75 inset-0 z-0"></div>
            <div class="w-full  max-w-md z-10">
              <div class="sm:text-4xl xl:text-5xl font-bold leading-tight mb-6">ShopSmart</div>
              <div class="sm:text-sm xl:text-md text-gray-200 font-normal"> En ShopSmart, nos enorgullece ofrecerte una experiencia de compra en línea excepcional. Nuestro objetivo es brindarte una amplia gama de productos de alta calidad y a precios competitivos. Creemos que comprar en línea no solo debe ser conveniente, sino también emocionante y satisfactorio.</div>
            </div>
            <!---remove custom style-->
           <ul class="circles">
          <li></li>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
       </ul>
          </div>
          <div class="md:flex md:items-center md:justify-center w-full sm:w-auto md:h-full w-2/5 xl:w-2/5 p-8  md:p-10 lg:p-14 sm:rounded-lg md:rounded-none bg-white">
            <div class="max-w-md w-full space-y-8">
              <div class="text-center">
                <h2 class="mt-6 text-3xl font-bold text-gray-900">
                  Bienvenido!
                </h2>
                <p class="mt-2 text-sm text-gray-500">¡Por favor, inicia sesión en ShopSmart!

                </p>
              <form class="mt-8 space-y-6" action="{{ route('user.login') }}" method="POST" novalidate>
                @csrf
                @if (session('mensaje'))
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >
                    {{ session('mensaje') }}
                </p>
                @endif
                <div class="relative">
                  <label for="email" class="ml-3 text-sm font-bold text-gray-700 tracking-wide">Email</label>
                  <input
                    class=" w-full text-base px-4 py-2 border-b border-gray-300 focus:outline-none rounded-2xl focus:border-indigo-500"
                    type="email" placeholder="mail@gmail.com" name="email" value="{{ old('email') }}">
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-8 content-center">
                  <label for="password" class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                    Password
                  </label>
                  <input
                    class="w-full content-center text-base px-4 py-2 border-b rounded-2xl border-gray-300 focus:outline-none focus:border-indigo-500"
                    type="password" name="password" placeholder="Enter your password" value="">
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center" >{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-center justify-between">
                  <div class="flex items-center">
                    <input id="rememver" name="rememver" type="checkbox"
                      class="h-4 w-4 bg-blue-500 focus:ring-blue-400 border-gray-300 rounded">
                    <label for="rememver" class="ml-2 block text-sm text-gray-900">
                      Mantener sesión
                    </label>
                  </div>
                  
                </div>
                <div>
                  <button type="submit"
                    class="w-full flex justify-center bg-gradient-to-r from-indigo-500 to-blue-600  hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 p-4  rounded-full tracking-wide font-semibold  shadow-lg cursor-pointer transition ease-in duration-500">
                    Sign in
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    </body>
    </html>