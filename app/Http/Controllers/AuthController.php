<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Activitylog\Models\Activity;


class AuthController extends Controller
{
    public function showLoginForm()
    {
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


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'nim' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('nim', $credentials['nim'])->first();

        if (!$user) {
            // Jika user tidak ditemukan di database
            return back()->withErrors(['nim' => 'Akun dengan NIM ini tidak terdaftar di sistem.']);
        }
    
        if (!Hash::check($credentials['password'], $user->password)) {
            // Jika password salah
            return back()->withErrors(['password' => 'Password yang dimasukkan salah.']);
        }
        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);
            return redirect()->route('dashboard');
        }

        

        //     // Pencatatan aktivitas login
        // activity()
        // ->causedBy(Auth::user()) // Pengguna yang menyebabkan aktivitas
        // ->log('User logged in'); // Pesan log aktivitas
        // return back()->withErrors(['password' => 'Akun tidak terdaftar']);
    }
    // public function log(User $user){
    //     return view('logactivity.logActivity',[
    //         'logs' => Activity::where('subject_type',User::class)->where('subject_id',$user->id)->latest()->get()
    //     ]);
    // }

    public function logout(Request $request) {
        // auth()->logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        // return redirect('/');
        Auth::logout();
        return redirect()->route('login');
    }
}
