<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function register()
    {
        return view('auth.register');
    }



    public function registerVerify(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password'
        ], [
            'email.required' => 'El email es obligatorio',
            'email.unique' => 'El email no se encuientra disponoble',
        ]);

        User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Usuario registrado satisfactoriamente');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginVerify(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'El email es requerido',
            'email.unique' => 'El email no se encuentra disponible'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('auth/panel_control');
        }

        return back()->withErrors(['invalid_credential' => 'El usuario o contraseña es incorrecto'])->withInput();
    }
}
