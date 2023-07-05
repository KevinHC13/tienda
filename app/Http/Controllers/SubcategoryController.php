<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function create()
    {
        return view('subcategory.create');
    }

    public function store(Request $request)
    {
        Subcategory::create([
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
        ]);
    }
}
