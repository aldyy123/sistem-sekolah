<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function check(Request $request)
    {
        if (!Auth::check() && $request->is('login')) {
            return view('shared.login');
        } elseif (!Auth::check()) {
            return redirect('login');
        }

        return redirect('dashboard');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            return redirect()->intended('dashboard');
        }

        return redirect('login')->withErrors([
            'username' => 'Invalid credentials',
        ]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
