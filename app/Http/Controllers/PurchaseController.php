<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Provedor;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //obtiene todos las compras de la base de datos 
        $purchases = Purchase::paginate(10);

        return view('purchase.index',[
            'purchases' => $purchases
        ]);
    }

    // Muestra la vista para crear una nueva venta
    public function create()
    {
        // Selecciona todos los proveedores para elegir uno en la visa
        $provedores = Provedor::all();
        $products = Product::all();
        //devuelve la vista purchase.create
        return view('purchase.create',[
            'provedores' => $provedores,
            'products' => $products,
        ]);
  
    }

    // Crea un nuevo registro de la compra
    public function store(Request $request)
    {
        /*$this->validate($request, [
            'provedor_id' => 'required',
            'code' => 'required|integer|unique:purchases',        
            'tota' => 'required', 
            'pagado' => 'required',
        ]);

        if($request->pagado > $request->tota)
        {
           // Redireccionar de vuelta a la página anterior con un mensaje de error
            return back()->with('mensaje', 'No puede pagar mas que el total');
        }

        Purchase::create([
            'provedor_id' => $request->provedor_id,
            'code' => $request->code ,
            'estatus' => ($request->tota == $request->pagado) ? "Pagado" : "Pendiente" ,
            'tota' => $request->tota ,
            'pagado' => $request->pagado ,
            'pendiente' => $request->tota - $request->pagado ,
            'estatus_pago' => ($request->tota == $request->pagado) ? "Pagado" : "Pendiente" ,
        ]);
        */

        dd($request);

        
        return redirect()->route('purchase.index');
    }

    // Elimina la compra pasada como parametro
    public function destroy(Purchase $purchase)
    {
        $purchase->delete();
        return redirect()->route('purchase.index');
    }

    // Muestra la vista para editar una compra
    public function edit(Purchase $purchase)
    {
        $provedores = Provedor::all();
        return view('purchase.edit',[
            'purchase' => $purchase,
            'provedores' => $provedores,
        ]);
    }

    // Actualiza a los datos enviados
    public function update(Request $request, Purchase $purchase)
    {
        $this->validate($request, [
            'provedor_id' => 'required',       
            'tota' => 'required', 
            'pagado' => 'required',
        ]);

        // Valida que no se quiera pagar mas del total
        if($request->pagado > $request->tota)
        {
           // Redireccionar de vuelta a la página anterior con un mensaje de error
            return back()->with('mensaje', 'No puede pagar mas que el total');
        }

        $purchase->provedor_id = $request->provedor_id;
        $purchase->estatus = ($request->tota == $request->pagado) ? "Pagado" : "Pendiente" ;
        $purchase->tota = $request->tota;
        $purchase->pagado = $request->pagado;
        $purchase->pendiente = $request->tota - $request->pagado;
        $purchase->estatus_pago = ($request->tota == $request->pagado) ? "Pagado" : "Pendiente" ;
        $purchase->save();

        return redirect()->route('purchase.index');
    }

    // Muestra la informacion general de la compra
    public function show(Purchase $purchase)
    {
        return view('purchase.show',[
            'purchase' => $purchase
        ]);
    }

    public function addProduct(Request $request)
    {
        $stock_product = $request->stock_product;
        $product = Product::findOrFail($request->product_id);

        $respuesta = [
            'product' => $product,
            'stock' => $stock_product,
        ];

        return response()->json($respuesta);
    }
}
