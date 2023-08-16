<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use App\Models\Category;
use App\Models\cotizacion;
use Illuminate\Http\Request;

class CotizacionController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        
    }
    public function index()
    {
        $cotizaciones = cotizacion::paginate(10);
        return view('cotizaciones.index',[
            'cotizaciones' => $cotizaciones,
        ]);
    }
    
    public function create()
{
    $clients = Client::all();
    $products = Product::all();
    
    // Fetch the latest cotizaciones
    $latestCotizaciones = Cotizacion::latest()->take(10)->get();
    
    return view('cotizaciones.create', [
        'clients' => $clients,
        'products' => $products,
        'latestCotizaciones' => $latestCotizaciones,
    ]);
}
    
    public function store(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $client = Client::findOrFail($request->client_id);
    
        $subtotal = $product->sale_price * $request->quantity;
        $iva = $subtotal * 0.16;


        $this->validate($request, [
            'client_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required|integer|min:1',
            'referencia' => 'required',
            'price' => 'required|numeric|min:0', // Validate the price field
        ]);
    
        Cotizacion::create([
            'client_id' => $client->name, // Store the name of the client
            'product_id' => $product->name, // Store the name of the product
            'cantidad' => $request->quantity,
            'referencia' => $request->referencia, //
            'price' => $request->price,
            'iva' => $iva,
            'subtotal' => $subtotal,
            'total' => $subtotal + $iva,
            'descripcion' => $request->descripcion,
           

        ]);
    
        return redirect()->route('cotizacion.create')->with('success', 'Quotation created successfully.');
    }

    public function destroy(Cotizacion $cotizacion)
    {
        // Delete the cotizacion record
        $cotizacion->delete();

        // Redirect the user or perform other actions
        return redirect()->route('cotizacion.create');
    }
}
    
