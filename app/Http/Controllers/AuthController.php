<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Método para exibir o formulário de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Método para processar o login
    public function login(Request $request)
    {
        // Validação dos campos de login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Tentativa de login
        if (Auth::attempt($request->only('email', 'password'))) {
            // Redireciona para a página principal ou dashboard após login
            return redirect()->route('home');
        }

        // Caso falhe o login, redireciona de volta com erro
        return back()->withErrors([
            'email' => 'As credenciais fornecidas são inválidas.',
        ]);
    }
}
