<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Activitylog\Models\Activity;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Ambil semua data pengguna
        return view('admin.manageUser', compact('users'));
    }

    public function create()
    {
        return view('manageuser.create'); // Tampilkan form tambah pengguna
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|unique:users,nim',
            // 'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:8',
            'role' => 'required|in:Admin,Sekretaris,Bendahara,Kominfo',
        ]);

        User::create([
            'nama' => $validated['nama'],
            'nim' => $validated['nim'],
            // 'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);
       

        return redirect()->route('manageuser')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id); // Cari user berdasarkan ID
        return view('manageuser.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|unique:users,nim,' . $id . ',id',
            // 'username' => 'required|string|unique:users,username,' . $id . ',user_id',
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:Admin,Sekretaris,Bendahara,Kominfo',
        ]);

        $user->update([
            'nama' => $validated['nama'],
            'nim' => $validated['nim'],
            // 'username' => $validated['username'],
            'password' => $validated['password'] ? Hash::make($validated['password']) : $user->password,
            'role' => $validated['role'],
        ]);
       

        return redirect()->route('manageuser')->with('success', 'User berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        
        return redirect()->route('manageuser')->with('success', 'User berhasil dihapus!');
    }

    public function show($id)
    {
        $user = User::findOrFail($id); // Ambil data user berdasarkan ID
        return view('manageuser.show', compact('user'));
    }
    // public function log(User $user){
    //     return view('logactivity.logActivity',[
    //         'logs' => Activity::where('subject_type',User::class)->where('subject_id',$user->id)->latest()->get()
    //     ]);
    // }
}
