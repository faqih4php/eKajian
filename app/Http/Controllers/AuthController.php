<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm() {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Allow email OR username in the same field
        $validated = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginField = filter_var($validated['email'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([
            $loginField => $validated['email'],
            'password' => $validated['password'],
        ], (bool) $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->hasRole(['super-admin', 'admin'])) {
                return redirect()->route('home.index');
            }

            return redirect()->route('guest.index');
        }

        return back()->withErrors([
            'email' => 'Email/Username atau password salah.'
        ])->withInput();
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('welcome');
    }

    public function welcome() {
        return view('welcome');
    }
}
