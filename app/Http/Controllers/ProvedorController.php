<?php

namespace App\Http\Controllers;

use App\Models\Provedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProvedorController extends Controller
{
    public function __construct()
    {
        // Se aplica el middleware de autenticación a todas las rutas del controlador
        $this->middleware('auth');
    }

    /**
     * Muestra una lista paginada de proveedores.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Obtiene todos los proveedores paginados
        $provedors = Provedor::paginate(10);
        return view('provedores.index', [
            'provedors' => $provedors,
        ]);
    }

    /**
     * Muestra el formulario para crear un nuevo proveedor.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Devuelve la vista `provedor.create`
        return view('provedores.create');
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
            'name' => 'required|max:255',
            'codigo' => 'required|numeric|min:0|unique:provedors',
            'telefono' => 'required|numeric|unique:provedors',
            'email' => 'required|max:255|unique:provedors',
            'picture' => 'required',
            'pais' => 'required|max:255',
            'ciudad' => 'required|max:255',
            'direccion' => 'required|max:255',
        ]);

        // Crea un nuevo proveedor con los datos enviados por el usuario
        Provedor::create([
            'picture' => $request->picture,
            'name' => $request->name,
            'codigo' => $request->codigo,
            'telefono' => $request->telefono,
            'pais' => $request->pais,
            'ciudad' => $request->ciudad,
            'direccion' => $request->direccion,
            'email' => $request->email,
        ]);

        // Redirige al usuario a la página de listado de proveedores
        return redirect()->route('provedor.index');
    }

    /**
     * Elimina un proveedor específico de la base de datos.
     *
     * @param  \App\Models\Provedor  $provedor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Provedor $provedor)
    {
        // Elimina el proveedor
        $provedor->delete();
        // Elimina la imagen del proveedor
        $imagen_path = public_path('uploads/' . $provedor->picture);

        if (File::exists($imagen_path)) {
            unlink($imagen_path);
        }
        // Redirige al usuario a la página de listado de proveedores
        return redirect()->route('provedor.index');
    }

    /**
     * Muestra el formulario para editar un proveedor específico.
     *
     * @param  \App\Models\Provedor  $provedor
     * @return \Illuminate\View\View
     */
    public function edit(Provedor $provedor)
    {
        // Devuelve la vista `provedor.edit` con los datos del proveedor
        return view('provedores.edit', [
            'provedor' => $provedor,
        ]);
    }

    /**
     * Actualiza un proveedor específico en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Provedor  $provedor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Provedor $provedor)
    {
        // Valida los datos enviados por el usuario
        $this->validate($request, [
            'name' => 'required|max:255',
            'codigo' => 'required|numeric|min:0',
            'telefono' => 'required|numeric',
            'email' => 'required|max:255',
            'pais' => 'required|max:255',
            'ciudad' => 'required|max:255',
            'direccion' => 'required|max:255',
            'picture' => 'required',
        ]);

        // Actualiza el proveedor con los datos enviados por el usuario
        $provedor->name = $request->name;
        $provedor->codigo = $request->codigo;
        $provedor->telefono = $request->telefono;
        $provedor->email = $request->email;
        $provedor->pais = $request->pais;
        $provedor->ciudad = $request->ciudad;
        $provedor->direccion = $request->direccion;
        $provedor->picture = $request->picture;
        // Guarda los cambios realizados en la tabla de proveedores
        $provedor->save();
        return redirect()->route('provedor.index');
    }

    /**
     * Muestra los detalles de un proveedor específico.
     *
     * @param  \App\Models\Provedor  $provedor
     * @return \Illuminate\View\View
     */
    public function show(Provedor $provedor)
    {
        // Devuelve la vista `provedor.show` con los datos del proveedor
        return view('provedores.show', [
            'provedor' => $provedor,
        ]);
    }
}
