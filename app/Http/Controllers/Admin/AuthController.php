<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 1. Fungsi menampilkan halaman view formulir
    public function showLogin() {
        return view('auth.login');
    }

    // 2. Fungsi memproses validasi Submit Log In
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba login dengan kredensial tersebut
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // Arahkan ke rute dashboard jika berhasil
            return redirect()->route('admin.dashboard'); 
        }

        // Jika gagal, kembalikan ke form dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau Password yang Anda berikan tidak terdaftar di rekaman kami.',
        ]);
    }

    // 3. Fungsi memroses Log Out (Keluar)
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}