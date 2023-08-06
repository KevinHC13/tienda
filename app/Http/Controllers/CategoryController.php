<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra una lista de todas las categorías.
     *
     */
    public function index()
    {
        $categories = Category::paginate(10);

        return view('category.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Muestra el formulario para crear una nueva categoría.
     *
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Guarda una nueva categoría en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'code' => 'required|max:10',
            'description' => 'required|max:255',
        ]);

        Category::create([
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->description,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('category.index');
    }

    /**
     * Muestra la categoría especificada.
     *
     * @param  \App\Models\Category  $category
     *
     */
    public function show(Category $category)
    {
        return view('category.show', [
            'category' => $category,
        ]);
    }

    /**
     * Elimina la categoría especificada de la base de datos.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('category.index');
    }

    /**
     * Muestra el formulario para editar la categoría especificada.
     *
     * @param  \App\Models\Category  $category
     * 
     */
    public function edit(Category $category)
    {
        return view('category.edit',[
            'category' => $category,
        ]);
    }

    /**
     * Actualiza la categoría especificada en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'code' => 'required|max:10',
            'description' => 'required|max:255',
        ]);

        $category->name = $request->name;
        $category->code = $request->code;
        $category->description = $request->description;

        $category->save();

        return redirect()->route('category.index');
    }
}
