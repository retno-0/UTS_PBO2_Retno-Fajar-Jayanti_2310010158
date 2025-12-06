<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home'); // atau halaman apapun
    }
    
    public function login()
    {
        return view('auth.login');
    }

    public function prosesLogin(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        if ($username === "admin" && $password === "123") {
            session(['login' => true]);
            return redirect('/dashboard');
        }

        return back()->with('error', 'Username atau Password salah!');
    }

    public function dashboard()
    {
        if (!session()->has('login')) {
            return redirect('/login');
        }

        return view('dashboard');
    }

    public function logout()
    {
        session()->forget('login');
        return redirect('/login');
    }
}
