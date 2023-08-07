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

    public function create()
    {
        
        $provedores = Provedor::all();
        $products = Product::all();
        //devuelve la vista purchase.create
        return view('purchase.create',[
            'provedores' => $provedores,
            'products' => $products,
        ]);
  
    }

  

    public function store(Request $request)
    {
        $this->validate($request, [
            'provedor_id' => 'required',
            'product_name' => 'required',
            'product_code' => 'required',

            'code' => 'required|unique:purchases',        
            'estatus' => 'required',
            'tota' => 'required', 
            'pagado' => 'required',
            'pendiente' => 'required',
            'estatus_pago' => 'required',
        ]);

        Purchase::create([
            'provedor_id' => $request->provedor_id,
            'product_name' => $request->product_name,
            'product_code' => $request->product_code,
            'code' => $request->code ,
            'estatus' => $request->estatus ,
            'tota' => $request->tota ,
            'pagado' => $request->pagado ,
            'pendiente' => $request->pendiente ,
            'estatus_pago' => $request->estatus_pago ,
        ]);
        
        return redirect()->route('purchase.index');
    }

    public function destroy(Purchase $purchase)
    {
        $purchase->delete();
        return redirect()->route('purchase.index');
    }

    public function edit(Purchase $purchase)
    {
        $provedores = Provedor::all();
        $products = Product::all();
        return view('purchase.edit',[
            'purchase' => $purchase,
            'provedores' => $provedores,
            'products' => $products,
        ]);
    }

    public function update(Request $request, Purchase $purchase)
    {
        $this->validate($request, [
            'provedor_id' => 'required',
            'product_name' => 'required',
            'product_code' => 'required',

            'code' => 'required|unique:purchases,code,'.$purchase->id,        
            'estatus' => 'required',
            'tota' => 'required', 
            'pagado' => 'required',
            'pendiente' => 'required',
            'estatus_pago' => 'required',
        ]);

        $purchase->provedor_id = $request->provedor_id;
        $purchase->product_name = $request->product_name;
        $purchase->product_code = $request->product_code;
        $purchase->code = $request->code;
        $purchase->estatus = $request->estatus;
        $purchase->tota = $request->tota;
        $purchase->pagado = $request->pagado;
        $purchase->pendiente = $request->pendiente;
        $purchase->estatus_pago = $request->estatus_pago;
        $purchase->save();

        return redirect()->route('purchase.index');
    }

    public function show(Purchase $purchase)
    {
        return view('purchase.show',[
            'purchase' => $purchase
        ]);
    }
}
