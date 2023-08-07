<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {   
        // Obtiene todos los usuarios
        $users = User::paginate(10);

        return view('user.index',[
            'users' => $users
        ]);
    }

    public function create()
    {
        // Devuelve la vista `user.create`
        return view('user.create');
    }

    public function store(Request $request)
    {
        // Valida los datos enviados por el usuario
        $this->validate($request,[
            'name'=>'required|max:255',
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed|max:255',
            'username'=>'required|unique:users|max:255',
            'picture'=>'required',
            'last_name'=>'required|max:255',
            'phone_number'=>'required|numeric|regex:/^\d{10}$/',
            'rol'=>'required'
        ]);
        // Crea un nuevo usuario con los datos enviados por el usuario
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'username' => $request->username,
            'picture' => $request->picture,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'estatus' => "1",
            'rol' => $request->rol,
        ]);
        // Redirige al usuario a la página de listado de usuarios
        return redirect()->route('user.index');
    }

    public function destroy(User $user)
    {
        // Elimina el usuario
        $user->delete();
        //elimina la imagen 
        $imagen_path= public_path('uploads/'.$user->picture);

        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }
        // Redirige al usuario a la página de listado de usuarios
        return redirect()->route('user.index');
    }

    public function edit(User $user)
    {
        // Devuelve la vista `user.edit` con los datos del usuario a editar
        return view('user.edit',[
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user)
    {
        // Valida los datos enviados por el usuario
        $this->validate($request,[
            'name'=>'required|max:255',
            'email'=>'required|email',
            'password'=>'required|confirmed|max:255',
            'username'=>'required|max:255',
            'picture'=>'required',
            'last_name'=>'required|max:255',
            'phone_number'=>'required|numeric|regex:/^\d{10}$/',
            'rol'=>'required'
        ]);
        
        if($request->status)
        {
            $user->estatus = "1";
        }else{
            $user->estatus = "0";
        }
        // Actualiza el usuario con los datos enviados por el usuario
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->picture = $request->picture;
        $user->last_name = $request->last_name;
        $user->phone_number = $request->phone_number;
        $user->rol = $request->rol;
        // Guarda los cambios
        $user->save();
        return redirect()->route('user.index');
    }

    public function show(User $user)
    {
        // Devuelve la vista `user.show` con los datos del usuario  
        return view('user.show',[
            'user' => $user
        ]);
    }

}

