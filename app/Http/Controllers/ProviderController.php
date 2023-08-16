<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function __construct()
    {
        // Aplica el middleware de autenticación a todas las rutas del controlador
        $this->middleware('auth');
    }

    /**
     * Muestra una lista paginada de proveedores.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Obtiene los datos de la tabla providers paginados
        $providers = Provider::paginate(10);

        return view('provider.index', [
            'providers' => $providers
        ]);
    }

    /**
     * Muestra el formulario para crear un nuevo proveedor.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Devuelve la vista `provider.create`
        return view('provider.create');
    }

    /**
     * Almacena un nuevo proveedor en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Valida los datos enviados por el usuario
        $this->validate($request, [
            'name' => 'required|max:255|unique:providers',
            'code' => 'required|max:255|unique:providers',
            'phone' => ['required', 'regex:/^\d{10}$/'],
            'email' => 'required|max:255|email|unique:providers',
        ]);

        // Crea un nuevo proveedor con los datos enviados por el usuario
        Provider::create([
            'name' => $request->name,
            'code' => $request->code,
            'phone' => $request->phone,
            'email' => $request->email,
            'user_id' => auth()->user()->id
        ]);

        // Redirige al usuario a la página de listado de proveedores
        return redirect()->route('provider.index');
    }

    /**
     * Muestra los detalles de un proveedor específico.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\View\View
     */
    public function show(Provider $provider)
    {
        // Devuelve la vista `provider.show` con los datos del proveedor
        return view('provider.show', [
            'provider' => $provider
        ]);
    }

    /**
     * Elimina un proveedor específico de la base de datos.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Provider $provider)
    {
        // Elimina un proveedor
        $provider->delete();
        
        // Redirige al usuario a la página de listado de proveedores
        return redirect()->route('provider.index');
    }

    /**
     * Muestra el formulario para editar un proveedor específico.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\View\View
     */
    public function edit(Provider $provider)
    {
        // Devuelve la vista `provider.edit` con los datos del proveedor
        return view('provider.edit', [
            'provider' => $provider
        ]);
    }

    /**
     * Actualiza un proveedor específico en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Provider $provider)
    {
        // Valida los datos enviados por el usuario
        $this->validate($request, [
            'name' => 'required|max:255',
            'code' => 'required|max:255',
            'phone' => ['required', 'regex:/^\d{10}$/'],
            'email' => 'required|max:255|email',
        ]);   

        // Actualiza el proveedor con los datos enviados por el usuario
        $provider->name = $request->name;
        $provider->code = $request->code;
        $provider->phone = $request->phone;
        $provider->email = $request->email;

        $provider->save();

        // Redirige al usuario a la página de listado de proveedores
        return redirect()->route('provider.index');

    }
}
