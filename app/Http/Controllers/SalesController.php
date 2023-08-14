<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Client;
use App\Models\Product;
use App\Models\SaleDetails;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class SalesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //obtiene todos las ventas
        $sales = Sales::paginate(10);
    
        return view('sale.index',[
            'sales' => $sales
        ]);
    }

    public function create()
    {
        //devuelve la vista sale.create
        $categories = Category::all();
        $clients = Client::all();

        return view('sale.create',[
            'categories' => $categories,
            'clients' => $clients,
        ]);
    }

    public function store(Request $request)
    {
        try{
            $this->validate($request, [
                'client_id' => 'required',     
                'products' => 'required', 
            ]);
        }catch(ValidationException $e){
            return response()->json(['message' => 'Debe seleccionar al menos un producto y un cliente', 'errors' => $e->errors()], 422);
        }

        $products = $request->json('products');
        $uuid = Str::uuid(); // Genera un UUID único
        $id = $uuid->toString(); // Convierte el UUID en una cadena para usarlo como ID

        $sale = Sales::create([
            'client_id' => $request->client_id,
            'code' => $id,
            'total' => $request->total,
            'user_id' => auth()->user()->id,


        ]);

        foreach ($products as $product_id => $product) {
            SaleDetails::create([
                'sales_id' => $sale->id,
                'product_id' => $product['id'],
                'quantity' => $product['added'],
            ]);
    
            $product_register = Product::find($product['id']);
    
            if ($product_register) {
                $product_register->stock = $product_register->stock - $product['added']; // Usar $product['added']
                $product_register->save();
            }
        }

        return response()->json($request);
    }


    public function getProducts(Request $request)
    {
        if($request->category_id == 0)
        {
            $products = Product::all();
        }else{
            $products = Product::where('category_id',$request->category_id)->get();

        }
        $products = $products->toJson();
        return response()->json($products);
    }

    public function show( Sales $sale)
    {
        return view('sale.show',[
            'sale' => $sale
        ]);
    }

    

}
