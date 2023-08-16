<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('user.login');
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();

        if($user->estatus != 1){
            return back()->with('mensaje', 'Cuenta bloqueada');
        }

        // Intentar iniciar sesión con las credenciales proporcionadas
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            // Si las credenciales son incorrectas, redireccionar de vuelta con un mensaje de error
            return back()->with('mensaje', 'Credenciales incorrectas');
        }

        // Si las credenciales son válidas, redireccionar al inicio con el nombre de usuario del usuario autenticado
        return redirect()->route('product.index');
    }
}
