<?php

namespace App\Http\Controllers;

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
        $purchases = Purchase::paginate(10);

        return view('purchase.index',[
            'purchases' => $purchases
        ]);
    }

    public function create()
    {
        $provedores = Provedor::all();
        return view('purchase.create',[
            'provedores' => $provedores,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'provedor_id' => 'required',
            'code' => 'required|unique:purchases',        
            'estatus' => 'required',
            'tota' => 'required', 
            'pagado' => 'required',
            'pendiente' => 'required',
            'estatus_pago' => 'required',
        ]);

        Purchase::create([
            'provedor_id' => $request->provedor_id,
            'code' => $request->code ,
            'estatus' => $request->estatus ,
            'tota' => $request->tota ,
            'pagado' => $request->pagado ,
            'pendiente' => $request->pendiente ,
            'estatus_pago' => $request->estatus_pago ,
        ]);
        
        return redirect()->route('purchase.index');
    }
}
