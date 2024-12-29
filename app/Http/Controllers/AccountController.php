<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AccountController extends Controller
{
    public function detail()
    {
        $user = Auth::user(); // Mendapatkan data pengguna yang sedang login
        return view('account.detail', compact('user'));
    }

    public function update(Request $request)
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
    }

    $request->validate([
        'nama' => 'required|string|max:255',
    ]);

    $user = Auth::user(); // Mendapatkan data pengguna yang sedang login

    // Periksa jika user adalah instance dari model User
    if (!$user instanceof User) {
        return redirect()->route('account.detail')->with('error', 'Pengguna tidak ditemukan.');
    }

    // Perbarui nama pengguna
    $user->nama = $request->input('nama');
    $user->save(); // Simpan perubahan

    return redirect()->route('account.detail')->with('success', 'Nama berhasil diperbarui.');
}

}

