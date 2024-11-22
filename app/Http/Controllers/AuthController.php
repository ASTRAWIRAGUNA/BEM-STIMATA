<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

class AuthController extends Controller
{
    public function login() {
        return view('login');
    }

    // protected function attemptLogin(Request $request)
    // {
    // // Cari pengguna berdasarkan kredensial
    // $credentials = $request->only('nim', 'password');
    // $user = \App\Models\User::where('nim', $credentials['nim'])->first();

    // // Validasi jika user ada dan role masih ada
    // if ($user && Role::find($user->role_id)) {
    //     return Auth::attempt($credentials);
    // }

    // // Role tidak valid atau tidak ditemukan
    // return false;
    // }


    public function dologin(Request $request) {
        // validasi
        $credentials = $request->validate([
            // 'email' => 'required|email',
            'nim' => 'required|string',
            'password' => 'required'
        ]);

        if (auth()->attempt($credentials)) {

            // buat ulang session login
            $request->session()->regenerate();

            if (auth()->user()->role_id === 1) {
                // jika user admin
                return redirect()->intended('/dashboardAdmin');
            } if(auth()->user()->role_id === 3){
                return redirect()->intended('/dashboardSekretaris');
            } if(auth()->user()->role_id === 4){
                return redirect()->intended('/dashboardKominfo');
            } else {
                // jika user bendahara
                return redirect()->intended('/dashboardBendahara');
            }
        }

        // jika email atau password salah
        // kirimkan session error
        return back()->with('error', 'nim atau password salah');
    }

    public function logout(Request $request) {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
