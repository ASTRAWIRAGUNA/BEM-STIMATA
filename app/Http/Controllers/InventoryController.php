<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::all();
        return view('kominfo.manageBarang', compact('inventories'));
    }

    public function create()
    {
        return view('kominfo.manage_barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'availability_status' => 'required|in:Available,Unavailable',
            'requires_letter' => 'required|boolean',
        ]);

        Inventory::create($request->all());

        return redirect()->route('inventories')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function edit(Inventory $inventory)
    {
        return view('kominfo.manage_barang.edit', compact('inventory'));
    }

    public function update(Request $request, Inventory $inventory)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'availability_status' => 'required|in:Available,Unavailable',
            'requires_letter' => 'required|boolean',
        ]);

        $inventory->update($request->all());

        return redirect()->route('inventories')->with('success', 'Barang berhasil diperbarui!');
    }

    public function destroy(Inventory $inventory)
    {
        $inventory->delete();

        return redirect()->route('inventories')->with('success', 'Barang berhasil dihapus!');
    }   
}
