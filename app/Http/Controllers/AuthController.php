<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Afficher le formulaire de connexion
    public function showLogin()
    {
        return view('auth.login');
    }

    // Connecter l'utilisateur
    public function login(Request $request)
    {
        $credentials = [
            'email'    => $request['email'],
            'password' => $request['password'],
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->isGestionnaire()) {
                return to_route('dashboard');
            }

            return to_route('catalogue');
        }

        return back()->with('error', 'Email ou mot de passe incorrect.');
    }

    // Afficher le formulaire d'inscription
    public function showRegister()
    {
        return view('auth.register');
    }

    // Enregistrer un nouveau client
    public function register(Request $request)
    {
        $user = new User();
        $user->name     = $request['name'];
        $user->email    = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->role     = 'client';
        $user->save();

        Auth::login($user);

        return to_route('catalogue');
    }

    // Déconnecter
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('login');
    }
}
