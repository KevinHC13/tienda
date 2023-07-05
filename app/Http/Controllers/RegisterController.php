<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'username' => $request->username,
            'picture' => $request->picture,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'estatus' => $request->estatus,
            'rol' => $request->rol,
        ]);

        // Autentica al usuario recién registrado
        auth()->attempt($request->only('email','password'));

        return 0;
    }
}
