<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Obtiene todas las marcas
        $brands = Brand::paginate(10);

        // Devuelve la vista `brand.index` con las marcas
        return view('brand.index', [
            'brands' => $brands
        ]);
    }

    public function create()
    {
        // Devuelve la vista `brand.create`
        return view('brand.create');
    }

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

    public function show(Brand $brand)
    {
        // Devuelve la vista `brand.show` con la marca
        return view('brand.show', [
            'brand' => $brand
        ]);
    }

    public function destroy(Brand $brand)
    {
        // Elimina la marca
        $brand->delete();

        // Elimina la imagen de la marca
        $imagen_path = public_path('uploads/' . $brand->picture);

        if (File::exists($imagen_path)) {
            unlink($imagen_path);
        }

        // Redirige al usuario a la página de listado de marcas
        return redirect()->route('brand.index');
    }

    public function edit(Brand $brand)
    {
        // Devuelve la vista `brand.edit` con la marca
        return view('brand.edit', [
            'brand' => $brand
        ]);
    }

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
