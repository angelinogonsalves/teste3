<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loga(LoginRequest $request)
    {
        $validatedUser = $request->validated();
        if (Auth::attempt($validatedUser)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/');
        }
 
        return back()->withErrors([
            'email' => 'E-mail ou senha inválidos',
        ])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse 
    {
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/');
    }
    

    public function register()
    {
        return view('auth.register');
    }

    public function cadastrar(Request $request)
    {
     /*   return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => 2,
            'ra' => $data['ra'],
            'sexo' => $data['sexo'],
            'password' => bcrypt($data['password'])
        ]);*/
    }

    public function recuperarSenha()
    {
        return view('auth.password.recuperar-senha');
    }
}
