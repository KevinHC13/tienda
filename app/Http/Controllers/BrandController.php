<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $brands = Brand::paginate(10);

        return view('brand.index',[
            'brands' => $brands
        ]);
    }
    public function create()
    {
        return view('brand.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'picture' => 'required'
        ]);

        Brand::create([
            'name' => $request->name,
            'description' => $request->description,
            'picture' => $request->picture,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('brand.index');
    }

    public function show(Brand $brand)
    {
        return view('brand.show',[
            'brand' => $brand
        ]);
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();

        $imagen_path = public_path('uploads/' . $brand->picture);

        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }

        return redirect()->route('brand.index');
    }

    public function edit(Brand $brand)
    {
        return view('brand.edit',[
            'brand' => $brand
        ]);
    }

    public function update(Request $request, Brand $brand)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'picture' => 'required'
        ]);

        $brand->name = $request->name;
        $brand->description = $request->description;
        $brand->picture = $request->picture;
        $brand->user_id = auth()->user()->id;


        $brand->save();

        return redirect()->route('brand.index');

    }
}
