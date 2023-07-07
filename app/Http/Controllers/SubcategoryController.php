<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::paginate(10);

        return view('subcategory.index', [
            'subcategories' => $subcategories
        ]);
    }

    public function create()
    {
        $categories = Category::all();

        return view('subcategory.create', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        Subcategory::create([ 
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('subcategory.index');
    }

    public function show(Subcategory $subcategory)
    {
        return view('subcategory.show',[
            'subcategory' => $subcategory
        ]);
    }

    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();
        return redirect()->route('subcategory.index');
    }

    public function edit(Subcategory $subcategory)
    {
        $categories = Category::all();
        return view('subcategory.edit', [
            'categories' => $categories,
            'subcategory' => $subcategory
        ]);
    }

    public function update(Request $request, Subcategory $subcategory)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'code' => 'required|max:10',
            'description' => 'required|max:255',
            'category_id' => 'required'

        ]);

        $subcategory->name = $request->name;
        $subcategory->code = $request->code;
        $subcategory->description = $request->description;
        $subcategory->category_id = $request->category_id;
        $subcategory->save();

        return redirect()->route('category.index');

    }
}
