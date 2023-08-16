<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    /**
     * Constructor: Define el middleware de autenticación para el controlador.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra una lista paginada de marcas.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Obtiene todas las marcas paginadas
        $brands = Brand::paginate(10);

        // Devuelve la vista `brand.index` con las marcas
        return view('brand.index', [
            'brands' => $brands
        ]);
    }

    /**
     * Muestra el formulario de creación de una nueva marca.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Devuelve la vista `brand.create`
        return view('brand.create');
    }

    /**
     * Almacena una nueva marca en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Valida los datos enviados por el usuario
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'picture' => 'required'
        ]);

        // Crea una nueva marca con los datos enviados por el usuario
        Brand::create([
            'name' => $request->name,
            'description' => $request->description,
            'picture' => $request->picture,
            'user_id' => auth()->user()->id
        ]);

        // Redirige al usuario a la página de listado de marcas
        return redirect()->route('brand.index');
    }

    /**
     * Muestra los detalles de una marca específica.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\View\View
     */
    public function show(Brand $brand)
    {
        // Devuelve la vista `brand.show` con la marca
        return view('brand.show', [
            'brand' => $brand
        ]);
    }

    /**
     * Elimina una marca y su imagen asociada de la base de datos y el sistema de archivos.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Brand $brand)
    {
        // Elimina la marca
        $brand->delete();

        // Elimina la imagen de la marca del sistema de archivos
        $imagen_path = public_path('uploads/' . $brand->picture);

        if (File::exists($imagen_path)) {
            unlink($imagen_path);
        }

        // Redirige al usuario a la página de listado de marcas
        return redirect()->route('brand.index');
    }

    /**
     * Muestra el formulario de edición de una marca.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\View\View
     */
    public function edit(Brand $brand)
    {
        // Devuelve la vista `brand.edit` con la marca
        return view('brand.edit', [
            'brand' => $brand
        ]);
    }

    /**
     * Actualiza los datos de una marca en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Brand $brand)
    {
        // Valida los datos enviados por el usuario
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'picture' => 'required'
        ]);

        // Actualiza la marca con los datos enviados por el usuario
        $brand->name = $request->name;
        $brand->description = $request->description;
        $brand->picture = $request->picture;
        $brand->user_id = auth()->user()->id;

        // Guarda los cambios en la marca
        $brand->save();

        // Redirige al usuario a la página de listado de marcas
        return redirect()->route('brand.index');
    }
}
