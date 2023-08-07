<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body>
  <div class="bg-white py-24 sm:py-32">
    <div class="mx-auto grid max-w-7xl gap-x-8 gap-y-20 px-6 lg:px-8 xl:grid-cols-3">
      <div class="max-w-2xl">
        <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Equipo 6</h2>
        <p class="mt-6 text-lg leading-8 text-gray-600">Punto de venta como proyecto final de la materia de Tecnologías y Aplicaciones en Internet.</p>
      </div>
      <ul role="list" class="grid gap-x-8 gap-y-12 sm:grid-cols-2 sm:gap-y-16 xl:col-span-2">
        <li>
          <div class="flex items-center gap-x-6">
            <img class="h-16 w-16 rounded-full" src="{{asset('images/kevin2.jpg')}}" alt="">
            <div>
              <h3 class="text-base font-semibold leading-7 tracking-tight text-gray-900">Kevin Alejandro Hernandez Campillo</h3>
              <p class="text-sm font-semibold leading-6 text-indigo-600"><a href="https://github.com/KevinHC13">KevinHC13</a></p>
            </div>
          </div>
        </li>
        <li>
          <div class="flex items-center gap-x-6">
            <img class="h-16 w-16 rounded-full" src="{{asset('images/betillo.jpeg')}}" alt="">
            <div>
              <h3 class="text-base font-semibold leading-7 tracking-tight text-gray-900">Ortega Lujan Humberto Erubiel</h3>
              <p class="text-sm font-semibold leading-6 text-indigo-600"><a href="https://github.com/Humerto">Humerto</a></p>
            </div>
          </div>
        </li>

  
        <!-- More people... -->
      </ul>
    </div>
  </div>
  
</body>
</html>