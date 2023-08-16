<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Constructor: Define el middleware de autenticación para el controlador.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra una lista paginada de categorías.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Obtiene todas las categorías paginadas
        $categories = Category::paginate(10);

        // Devuelve la vista `category.index` con las categorías
        return view('category.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Muestra el formulario para crear una nueva categoría.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Devuelve la vista `category.create`
        return view('category.create');
    }

    /**
     * Almacena una nueva categoría en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Valida los datos enviados por el usuario
        $this->validate($request, [
            'name' => 'required|max:255',
            'code' => 'required|max:10',
            'description' => 'required|max:255',
        ]);

        // Crea una nueva categoría con los datos enviados por el usuario
        Category::create([
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->description,
            'user_id' => auth()->user()->id,
        ]);

        // Redirige al usuario a la página de listado de categorías
        return redirect()->route('category.index');
    }

    /**
     * Muestra los detalles de una categoría específica.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\View\View
     */
    public function show(Category $category)
    {
        // Devuelve la vista `category.show` con la categoría
        return view('category.show', [
            'category' => $category,
        ]);
    }

    /**
     * Elimina una categoría de la base de datos.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        // Elimina la categoría
        $category->delete();

        // Redirige al usuario a la página de listado de categorías
        return redirect()->route('category.index');
    }

    /**
     * Muestra el formulario de edición de una categoría.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\View\View
     */
    public function edit(Category $category)
    {
        // Devuelve la vista `category.edit` con la categoría
        return view('category.edit', [
            'category' => $category,
        ]);
    }

    /**
     * Actualiza los datos de una categoría en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Category $category)
    {
        // Valida los datos enviados por el usuario
        $this->validate($request, [
            'name' => 'required|max:255',
            'code' => 'required|max:10',
            'description' => 'required|max:255',
        ]);

        // Actualiza la categoría con los datos enviados por el usuario
        $category->name = $request->name;
        $category->code = $request->code;
        $category->description = $request->description;

        // Guarda los cambios en la categoría
        $category->save();

        // Redirige al usuario a la página de listado de categorías
        return redirect()->route('category.index');
    }
}
