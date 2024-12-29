<?php

namespace App\Http\Controllers;

use App\Models\Kopma;
use App\Models\OrderItem;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BendaharaController extends Controller
{

    public function dashboard() {

        $totalbarang = Kopma::count();
        $totalpenjualan = OrderItem::count();
        $totalpendapatan = Order::sum('total_amount');
       
        return view('bendahara.dashboardBendahara',  compact('totalbarang', 'totalpenjualan', 'totalpendapatan'));
    } 
        

    public function edit($id)
    {
        $kopma = Kopma::findOrFail($id); // Cari user berdasarkan ID
        return view('manageKopma.edit', compact('kopma'));
    }
    
    
    public function store(Request $request)
    {

        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'quantity' => 'required',
            'item_price' => 'required'
        ]);

        Kopma::create($request->all());
        return redirect()->route('bendahara')->with('success', 'Item berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $kopma = Kopma::findOrFail($id);

        $request->validate([
           'item_name' => 'required|string|max:255',
            'quantity' => 'required',
            'item_price' => 'required'
        ]);

        $kopma->update($request->all());

        return redirect()->route('bendahara')->with('success', 'Barang berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kopma = Kopma::findOrFail($id);
        $kopma->delete();
        
        return redirect()->route('bendahara')->with('success', 'Barang berhasil dihapus!');
    }

    public function create()
    {
        return view('manageKopma.create'); // Tampilkan form tambah pengguna
    }
    public function index() {

        $kopmas = Kopma::all();
        return view('bendahara.manageKopma', compact('kopmas'));

    }
}
