<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function create()
    {
        return view('subcategory.create');
    }

    public function store(Request $request)
    {
        dd('Store');
    }
}
