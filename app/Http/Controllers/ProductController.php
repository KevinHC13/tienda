<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;



class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //obtiene todos los productos
        $products = Product::paginate(10);

        return view('product.index',[
            'products' => $products,
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $brands = Brand::all();
        //devuelve  la vista product.create
        return view('product.create',[
            'categories' => $categories,
            'subcategories' => $subcategories,
            'brands' => $brands
        ]);
    }

    public function store(Request $request)
    {
        //valida los datos enviados por el usuario
        $this->validate($request, [
            'name' => 'required|max:255',
            'purchase_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'category_id' => 'required',
            'brand_id' => 'required',
            'picture' => 'required'
        ]);
        

        //crea un nuevo producto con los datos enviados por el usuario
        Product::create([
            'picture' => $request->picture,
            'name' => $request->name,
            'purchase_price' => $request->purchase_price,
            'sale_price' => $request->sale_price,
            'stock' => $request->stock,
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'brand_id' => $request->brand_id,
            
        ]);
        //redirige al usuario a la pagina de listado de productos
        return redirect()->route('product.index');
    }

    public function show(Product $product){
        //devuelve la vista de product.show
        return view('product.show',[
            'product' => $product
        ]);
    }

    public function destroy(Product $product)
    {
        //elimina el producto
        $product->delete();
        //elimina la imagen de producto
        $imagen_path = public_path('uploads/' . $product->picture);

        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }
        //redirige al usuario a la pagina de listado de productos
        return redirect()->route('product.index');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $brands = Brand::all();
        //devuelve la vista del product.edit
        return view('product.edit',[
            'categories' => $categories,
            'subcategories' => $subcategories,
            'brands' => $brands,
            'product' => $product
        ]);

    }

    public function update(Request $request, Product $product)
    {
        //valida los datos enviados por el usuario
        $this->validate($request, [
            'name' => 'required|max:255',
            'purchase_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'category_id' => 'required',
            'brand_id' => 'required',
            'picture' => 'required'
        ]);
        //actualiza el producto con los datos enviados por el usuario
        $product->picture = $request->picture;
        $product->name = $request->name;
        $product->purchase_price = $request->purchase_price;
        $product->sale_price = $request->sale_price;
        $product->stock = $request->stock;
        $product->user_id = auth()->user()->id;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->brand_id = $request->brand_id;
        //guarda los cambios
        $product->save();
        //devuelve la vista de product.show
        return redirect()->route('product.index');

    }

    public function getSubcategories(Request $request, Category $category)
    {
        $subcategories = $category->subcategories->pluck('name', 'id');
        
        return response()->json(['subcategories' => $subcategories]);
    }
}
