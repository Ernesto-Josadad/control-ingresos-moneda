<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function register(Request $request)
    {
        // return $request->all();

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed|max:20',
            'password_confirmation' => 'required',
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        Auth::login($user);
        return redirect()->route('panel_control');
    }

    public function updatePassword(Request $request)
    {
        $user = auth()->user();
        $repeatPassword = '';
        $notification = '';

        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            $repeatPassword = 'La nueva contraseña no puede ser igual a la anteriro';
        }else {
            $notification = 'La contraseña ha sido actualizada con éxito';
        }

        $request->user()->update([
            'password' => bcrypt($request->password)
        ]);

        return redirect()->back()->with(compact('repeatPassword', 'notification'));
    }

    public function login(Request $request)
    {
        $credenciales = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $remember = ($request->has('remember') ? true : false);

        if (Auth::attempt($credenciales, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended('panel_control');
        } else {
            return back()->withErrors([
                'email' => 'Las credenciales ingresadas no son correctas'
            ])->onlyInput('email');
        }
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
