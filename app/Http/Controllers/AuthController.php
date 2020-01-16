<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('usuarios');
        }else{
            return redirect()->back()->with('error', 'Email y/o contrasela incorrectos');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/')->with('success', 'Cerró sesión correctamente.');

    }
}
