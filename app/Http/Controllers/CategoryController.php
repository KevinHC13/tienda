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
    public function index()
    {
        $categories = Category::paginate(10);

        return view('category.index',[
            'categories' => $categories
        ]);
    }


    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'code' => 'required|max:10',
            'description' => 'required|max:255'
        ]);

        Category::create([
            'name' => $request->name,
            'code' => $request->code,    
            'description' => $request->description,
            'user_id' => auth()->user()->id,
        ]);
        
        return redirect()->route('category.index');
    }

    public function show(Category $category)
    {
        return view('category.show',[
            'category' => $category
        ]);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index');
    }

    public function edit(Category $category)
    {
        return view('category.edit',[
            'category' => $category
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'code' => 'required|max:10',
            'description' => 'required|max:255'
        ]);

        $category->name = $request->name;
        $category->code = $request->code;
        $category->description = $request->description;

        $category->save();

        return redirect()->route('category.index');

    }


}
