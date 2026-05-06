<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if ($credentials['username'] === 'user' && $credentials['password'] === '123') {
            $request->session()->put('role', 'user');
            $request->session()->put('username', 'user');

            return redirect('/home');
        }

        if ($credentials['username'] === 'admin' && $credentials['password'] === '123') {
            $request->session()->put('role', 'admin');
            $request->session()->put('username', 'admin');

            return redirect('/admin/dashboard');
        }

        return back()->withErrors([
            'login' => 'Invalid username or password.',
        ])->withInput($request->only('username'));
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['role', 'username']);

        return redirect('/login');
    }
}
