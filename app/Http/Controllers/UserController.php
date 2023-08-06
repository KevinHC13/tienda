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
        $users = User::paginate(10);

        return view('user.index',[
            'users' => $users
        ]);
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
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

        return redirect()->route('user.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        
        $imagen_path= public_path('uploads/'.$user->picture);

        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }
        
        return redirect()->route('user.index');
    }

    public function edit(User $user)
    {
        return view('user.edit',[
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user)
    {
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

        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->picture = $request->picture;
        $user->last_name = $request->last_name;
        $user->phone_number = $request->phone_number;
        $user->rol = $request->rol;

        $user->save();
        return redirect()->route('user.index');
    }

    public function show(User $user)
    {
        return view('user.show',[
            'user' => $user
        ]);
    }

}

