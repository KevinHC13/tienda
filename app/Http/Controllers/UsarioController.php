<?php

namespace App\Http\Controllers;

use App\Models\Usario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UsarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $usarios = Usario::paginate(10);
        return view('usuarios.index',[
            'usarios'=>$usarios,
        ]);
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:255',
            'lastname'=>'required|max:255',
            'username'=>'required|max:255|unique:usarios',
            'password'=>'required|max:255',
            'telefono'=>'required|max:255|unique:usarios',
            'email'=>'required|max:255|unique:usarios',
            'picture'=>'required',
            'rol'=>'required|max:255|'
        ]);

    Usario::create([
        'picture' => $request->picture,
        'name' => $request -> name,
        'lastname' => $request -> lastname,
        'username' => $request -> username,
        'password' => $request -> password,
        'telefono' => $request -> telefono,
        'email' => $request -> email,
        'rol' => $request -> rol,
    ]);

        return redirect()->route('usario.index');
    
    }

    public function destroy(Usario $usario)
    {
        $usario->delete();

        $imagen_path= public_path('uploads/'.$usario->picture);

        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }

        return redirect()->route('usario.index');
    }

    public function edit(Usario $usario)
    {
        return view('usuarios.edit',[
            'usario'=>$usario,
        ]);
    }
    
    public function update(Request $request, Usario $usario)
    {
       $this->validate($request,[
            'name'=>'required|max:255',
            'lastname'=>'required|max:255',
            'username'=>'required|max:255|',
            'password'=>'required|max:255',
            'telefono'=>'required|max:255|',
            'email'=>'required|max:255|',
            'picture'=>'required',
            'rol'=>'required|max:255|'
       ]);

       $usario->name=$request->name;
        $usario->lastname=$request->lastname;
        $usario->username=$request->username;
        $usario->password=$request->password;
        $usario->telefono=$request->telefono;
        $usario->email=$request->email;
        $usario->picture=$request->picture;
        $usario->rol=$request->rol;

        $usario->save();
        return redirect()->route('usario.index');

    }

    public function show(Usario $usario)
    {
        return view('usuarios.show',[
            'usario'=>$usario,
        ]);
    }
}