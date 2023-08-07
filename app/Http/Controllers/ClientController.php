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
        // Devuelve la vista 
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        // Valida los datos enviados por el usuario
        $this->validate($request,[
            'name'=>'required|max:255',
            'codigo'=>'required|numeric|min:0|unique:clients',
            'empresa'=>'required|max:255',
            'telefono'=>'required|numeric|unique:clients',
            'email'=>'required|max:255|unique:clients',
            'pais'=>'required|max:255|',
            'ciudad'=>'required|max:255|',
            'direccion'=>'required|max:255|',
            'picture'=>'required'
            
        ]);
        // Crea un nuevo cliente con los datos enviados por el usuario
        Client::create([
            'picture' => $request->picture,
            'name' => $request -> name,
            'codigo' => $request -> codigo,
            'empresa' => $request -> empresa,
            'telefono' => $request -> telefono,
            'email' => $request -> email,
            'pais' => $request -> pais,
            'ciudad' => $request -> ciudad,
            'direccion' => $request -> direccion,
        ]);
        // Redirige al usuario a la página de listado de clientes
        return redirect()->route('client.index');

    }
    //
    public function destroy(Client $client)
    {
        // Elimina el cliente
        $client->delete();
        //elimina la imagen del cliente
        $imagen_path= public_path('uploads/'.$client->picture);

        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }
        // Redirige al usuario a la página de listado de clientes
        return redirect()->route('client.index');
    }

    public function edit(Client $client)
    {
        // Devuelve lq vista clientes edit con el cliente
        return view('clientes.edit',[
            'client' => $client
        ]);
    }

    public function update(Request $request, Client $client)
    {
        // Valida los datos enviados por el usuario
        $this->validate($request,[
            'name'=>'required|max:255',
            'codigo'=>'required|numeric|min:0|',
            'empresa'=>'required|max:255',
            'telefono'=>'required|numeric|',
            'email'=>'required|max:255',
            'pais'=>'required|max:255',
            'ciudad'=>'required|max:255',
            'direccion'=>'required|max:255',
            'picture'=>'required'
        ]);
        // Actualiza el cliente con los datos enviados por el usuario
        $client->name = $request->name;
        $client->codigo=$request->codigo;
        $client->empresa=$request->empresa;
        $client->telefono=$request->telefono;
        $client->email =$request->email;
        $client->picture=$request->picture;
        $client->pais=$request->pais;
        $client->ciudad=$request->ciudad;
        $client->direccion=$request->direccion;
        //guarda los cambios realizados en la tabla de cliente
        $client->save();
        return redirect()->route('client.index');

    }

    public function show(Client $client)
    {
        //devuelve la vista clientes.show con el cliente
        return view('clientes.show',[
            'client' => $client
        ]);
    }
}
