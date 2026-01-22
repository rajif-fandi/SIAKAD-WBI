<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // file login.blade.php
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email','password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            

            if ($user->role === 'mahasiswa') {
                return redirect()->route('dashboard.index');
            } elseif ($user->role === 'dosen') {
                return redirect()->route('dosen.dashboard');
            }elseif ($user->role === 'admin'){ 
                return redirect()->route('admin.dashboardAdmin');
            }else {
                Auth::logout();
                return redirect('/')->withErrors('Role tidak dikenali!');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah!',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
