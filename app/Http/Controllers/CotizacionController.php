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
            'price' => 'required|numeric|min:0', 
            'estado' => 'required',
        ]);

        $product = Product::find($request->product_id);
    
        Cotizacion::create([
            'client_id' => $client->name, 
            'product_id' => $product->name, 
            'cantidad' => $request->quantity,
            'referencia' => $request->referencia, 
            'price' => $request->price,
            'iva' => $iva,
            'picture' => $product->picture,
            'subtotal' => $subtotal,
            'total' => $subtotal + $iva,
            'descripcion' => $request->descripcion,
            'estado' => $request->estado,
           

        ]);
    
        return redirect()->route('cotizacion.create')->with('cotizacion realizada.');
    }

    public function destroy(Cotizacion $cotizacion)
    {
        // Delete the cotizacion record
        $cotizacion->delete();

        // Redirect the user or perform other actions
        return redirect()->route('cotizacion.create');
    }


    

    public function edit(Cotizacion $cotizacion)
{
    return view('cotizacion.edit', [
        'cotizacion' => $cotizacion,
        // ... Other data you might need ...
    ]);
}

public function update(Request $request, Cotizacion $cotizacion)
{
    // Validate input...

    $cotizacion->update([
        'client_id' => $request->client_id,
        'product_id' => $request->product_id,
        'price' => $request->price,
        'quantity' => $request->quantity,
        'subtotal' => $request->subtotal,
        'iva' => $request->iva,
        'estatus' => $request->estatus,
        // ... Other fields ...
    ]);

    return redirect()->route('cotizacion.index');
}

}
    
