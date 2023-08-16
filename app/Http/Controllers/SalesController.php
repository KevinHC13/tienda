<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use Illuminate\Http\Request;

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
        return view('sale.create');
    }

    

}
