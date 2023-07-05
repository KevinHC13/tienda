<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        Category::create([
            'name' => $request->name,
            'code' => $request->code,    
            'description' => $request->description,
            'user_id' => $request->user_id,
        ]);
    }
}
