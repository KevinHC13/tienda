<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra la lista de subcategorías paginada.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $subcategories = Subcategory::paginate(10);

        return view('subcategory.index', [
            'subcategories' => $subcategories
        ]);
    }

    /**
     * Muestra el formulario para crear una nueva subcategoría.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::all();
        
        return view('subcategory.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Almacena una nueva subcategoría en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'code' => 'required|max:10',
            'description' => 'required|max:255',
            'picture' => 'required'
        ]);

        Subcategory::create([
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'user_id' => auth()->user()->id,
            'picture' => $request->picture
        ]);

        return redirect()->route('subcategory.index');
    }

    /**
     * Muestra los detalles de una subcategoría específica.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\View\View
     */
    public function show(Subcategory $subcategory)
    {
        return view('subcategory.show', [
            'subcategory' => $subcategory
        ]);
    }

    /**
     * Elimina una subcategoría específica.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();

        return redirect()->route('subcategory.index');
    }

    /**
     * Muestra el formulario para editar una subcategoría existente.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\View\View
     */
    public function edit(Subcategory $subcategory)
    {
        $categories = Category::all();

        return view('subcategory.edit', [
            'categories' => $categories,
            'subcategory' => $subcategory
        ]);
    }

    /**
     * Actualiza una subcategoría existente en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'code' => 'required|max:10',
            'description' => 'required|max:255',
            'category_id' => 'required',
            'picture' => 'required'
        ]);

        $subcategory->name = $request->name;
        $subcategory->code = $request->code;
        $subcategory->description = $request->description;
        $subcategory->category_id = $request->category_id;
        $subcategory->picture = $request->picture;

        $subcategory->save();

        return redirect()->route('subcategory.index');
    }
}
