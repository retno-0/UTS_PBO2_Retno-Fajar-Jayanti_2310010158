<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email tidak ditemukan');
        }

        // PASSWORD TIDAK HASH (plaintext)
        if ($user->password === $request->password) {

            Auth::login($user);

            return redirect('/dashboard');
        }

        return back()->with('error', 'Password salah');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
