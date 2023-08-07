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
    public function index()
    {
        // Obtiene todas las subcategorias
        $subcategories = Subcategory::paginate(10);

        return view('subcategory.index', [
            'subcategories' => $subcategories
        ]);
    }

    public function create()
    {
       
        $categories = Category::all();
        //devuelve la vista subcategory.create
        return view('subcategory.create', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        // Valida los datos enviados por el usuario
        Subcategory::create([ 
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'user_id' => auth()->user()->id,
        ]);
        // Redirige al usuario a la página de listado de subcategorias

        return redirect()->route('subcategory.index');
    }

    public function show(Subcategory $subcategory)
    {
        // Devuelve la vista subcategory.show
        return view('subcategory.show',[
            'subcategory' => $subcategory
        ]);
    }

    public function destroy(Subcategory $subcategory)
    {
        // Elimina la subcategoria
        $subcategory->delete();
        //
        return redirect()->route('subcategory.index');
    }

    public function edit(Subcategory $subcategory)
    {
       
        $categories = Category::all();
         // Devuelve la vista subcategory.edit
        return view('subcategory.edit', [
            'categories' => $categories,
            'subcategory' => $subcategory
        ]);
    }

    public function update(Request $request, Subcategory $subcategory)
    {
        // Valida los datos enviados por el usuario
        $this->validate($request, [
            'name' => 'required|max:255',
            'code' => 'required|max:10',
            'description' => 'required|max:255',
            'category_id' => 'required'

        ]);
        // Actualiza la subcategoria
        $subcategory->name = $request->name;
        $subcategory->code = $request->code;
        $subcategory->description = $request->description;
        $subcategory->category_id = $request->category_id;
        //guarda los datos
        $subcategory->save();
        // Redirige al usuario a la página de listado de subcategorias
        return redirect()->route('category.index');

    }
}
