<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class ClientController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        
    }

    public function index()
    {
        $clients = Client::paginate(10);
        return view('clientes.index',[
            'clients' => $clients,
        ]);
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:255',
            'codigo'=>'required|numeric|min:0|',
            'empresa'=>'required|max:255',
            'telefono'=>'required|numeric|',
            'email'=>'required|max:255|',
            'picture'=>'required'
            
        ]);

        Client::create([
            'picture' => $request->picture,
            'name' => $request -> name,
            'codigo' => $request -> codigo,
            'empresa' => $request -> empresa,
            'telefono' => $request -> telefono,
            'email' => $request -> email,
        ]);

        return redirect()->route('client.index');

    }

    public function destroy(Client $client)
    {
        $client->delete();
        
        $imagen_path= public_path('uploads/'.$client->picture);

        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }
        
        return redirect()->route('client.index');
    }

    public function edit(Client $client)
    {
        return view('clientes.edit',[
            'client' => $client
        ]);
    }

    public function update(Request $request, Client $client)
    {
        $this->validate($request,[
            'name'=>'required|max:255',
            'codigo'=>'required|numeric|min:0',
            'empresa'=>'required|max:255',
            'telefono'=>'required|numeric',
            'email'=>'required|max:255',
            'picture'=>'required'
        ]);

        $client->name = $request->name;
        $client->codigo=$request->codigo;
        $client->empresa=$request->empresa;
        $client->telefono=$request->telefono;
        $client->email =$request->email;
        $client->picture=$request->picture;

        $client->save();
        return redirect()->route('client.index');

    }

    public function show(Client $client)
    {
        return view('clientes.show',[
            'client' => $client
        ]);
    }
}