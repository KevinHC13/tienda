<?php

namespace App\Http\Controllers;

use App\Models\Provedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class ProvedorController extends Controller
{
    public function __construct()
    {
    
        $this->middleware('auth');
    }

    public function index()
    {
        // Obtiene todos los provedores
        $provedors = Provedor::paginate(10);
        return view('provedores.index',[
            'provedors'=>$provedors,
        ]);
    }

    public function create()
    {
        // Devuelve la vista `provedor.create`
        return view('provedores.create');
    }

    public function store(Request $request)
    {
        // Valida los datos enviados por el usuario 
        $this->validate($request,[
            'name'=>'required|max:255',
            'codigo'=>'required|numeric|min:0|unique:provedors',
            'telefono'=>'required|numeric|unique:provedors',
            'email'=>'required|max:255|unique:provedors',
            'picture'=>'required',
            'pais'=>'required|max:255|',
            'ciudad'=>'required|max:255|',
            'direccion'=>'required|max:255|'
        ]);
        // Crea un nuevo provedor con los datos enviados por el usuario
    Provedor::create([
        'picture' => $request->picture,
        'name' => $request -> name,
        'codigo' => $request -> codigo,
        'telefono' => $request -> telefono,
        'pais' => $request -> pais,
        'ciudad' => $request -> ciudad,
        'direccion' => $request -> direccion,
        'email' => $request -> email,
    ]);
        // Redirige al usuario a la página de listado de provedores
        return redirect()->route('provedor.index');
    }

    
    public function destroy(Provedor $provedor)
    {
        // Elimina el provedor
        $provedor->delete();
        //elimina la imagen del provedor
        $imagen_path=public_path('uploads/'.$provedor->picture);

        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }
        // Redirige al usuario a la página de listado de provedores
        return redirect()->route('provedor.index');
    }
    public function edit(Provedor $provedor)
    {
        // Devuelve la vista `provedor.edit` con los datos del provedor
        return view('provedores.edit',[
            'provedor'=>$provedor
        ]);
    }

    public function update(Request $request, Provedor $provedor)
    {
        // Valida los datos enviados por el usuario
        $this->validate($request,[
            'name'=>'required|max:255',
            'codigo'=>'required|numeric|min:0|',
            'telefono'=>'required|numeric|',
            'email'=>'required|max:255|',
            'pais'=>'required|max:255|',
            'ciudad'=>'required|max:255|',
            'direccion'=>'required|max:255|',
            'picture'=>'required'
        ]);
        // Actualiza el provedor con los datos enviados por el usuario
        $provedor->name= $request ->name;
        $provedor->codigo=$request->codigo;
        $provedor->telefono=$request->telefono;
        $provedor->email =$request->email;
        $provedor->pais=$request->pais;
        $provedor->ciudad=$request->ciudad;
        $provedor->direccion=$request->direccion;
        $provedor->picture=$request->picture;
        // Guarda los cambios realizados en la tabla  de provedores
        $provedor->save();
        return redirect()->route('provedor.index');
    }

    public function show(Provedor $provedor)
    {
        // Devuelve la vista `provedor.show` con los datos del provedor
        return view('provedores.show',[
            'provedor'=> $provedor
        ]);
    }
}
