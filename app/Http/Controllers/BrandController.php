<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function create()
    {
        return view('brand.create');
    }

    public function store(Request $request)
    {
        Brand::create([
            'name' => $request->name,
            'picture' => $request->picture,
            'description' => $request->description,
            'user_id' => $request->user_id,

        ]);
        
    }
}
