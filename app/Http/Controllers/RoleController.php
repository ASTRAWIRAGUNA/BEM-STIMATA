<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = Role::orderBy('created_at', 'DESC')->get();
        
        return view('admin.manageUser',compact('role'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        $request->validate([
            'nim' => 'required|numeric', // nim harus berupa angka
            'nama' => 'required|string|max:255', // Contoh validasi untuk kolom lain
            'role_type' => 'required|in:admin,sekretaris,user', // validasi role
        ]);  
        Role::create($request->all());
        return redirect()->route('roles')->with('success','User Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::findOrFail($id);
  
        return view('roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::findOrFail($id);
  
        return view('roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',  // Validasi nama harus diisi
            'nim' => 'required|numeric',          // Validasi nim harus berupa angka
            'role_type' => 'required|in:admin,sekretaris,user',
        ]);

        $role = Role::findOrFail($id);
  
        $role->update($request->all());
  
        return redirect()->route('roles')->with('success', 'user updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
  
        $role->delete();
  
        return redirect()->route('roles')->with('success', 'user deleted successfully');
    }
}
