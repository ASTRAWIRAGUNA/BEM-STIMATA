<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Arsip_surat;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class KominfoController extends Controller
{

    public function dashboard() {
       
        return view('kominfo.dashboardKominfo');
        
        
    }
    public function index()
    {
         // Ambil semua data inventory
        //  $inventories = Inventory::all();
        $peminjaman = Peminjaman::with('inventory', 'user', 'surat')->get();
        return view('kominfo.peminjaman', compact('peminjaman'));
    }

    public function create()
    {
        // $inventories = Inventory::where('availability_status', 'Available')->get();
        $inventories = Inventory::all();
        $surats = Arsip_surat::all();
        $users = User::all(); // Semua user
        return view('kominfo.peminjaman.create', compact('inventories', 'surats','users'));
    }

    public function store(Request $request)
    {
         // Validasi awal
    $request->validate([
        'user_id' => 'required|exists:users,id', // Pastikan user ID valid 
        'inventory_id' => 'required|exists:inventories,id',
        'borrow_date' => 'required|date',
        'return_date' => 'required|date|after:borrow_date', // Pastikan tanggal pengembalian setelah tanggal pinjam
    ]);

    // Ambil data inventory
    $inventory = Inventory::find($request->inventory_id);

    // Validasi apakah barang memerlukan surat
    if ($inventory->requires_letter) {
        $request->validate([
            'surat_id' => 'required|exists:arsip_surats,id', // Pastikan surat ada jika diperlukan
        ]);
    }

    // Pastikan barang masih tersedia
    if ($inventory->availability_status === 'Unavailable') {
        return back()->with(['error' , 'Barang ini sedang tidak tersedia untuk dipinjam.']);
    }

    // Update status barang menjadi tidak tersedia
    $inventory->update(['availability_status' => 'Unavailable']);

    // Simpan data peminjaman
    Peminjaman::create([
        'inventory_id' => $request->inventory_id,
        // 'user_id' => Auth::id(), // gunakan ini agar hanya 1 orang saja yang bisa meminjam
        'user_id' => $request->user_id, //semua user bisa meminjam
        'surat_id' => $request->surat_id,
        'borrow_date' => $request->borrow_date,
        'return_date' => $request->return_date,
        'status' => 'Pending', // Status awal peminjaman
    ]);

    // Log aktivitas
    activity()
        ->causedBy(Auth::user())
        ->performedOn($inventory)
        ->log('Peminjaman barang ditambahkan');

        return redirect()->route('peminjaman')->with('success', 'Peminjaman berhasil ditambahkan!');
    }

    public function edit(Peminjaman $peminjaman)
    {
       // Ambil hanya barang yang tersedia atau barang yang sedang dipinjam oleh peminjaman ini
        $inventories = Inventory::where('availability_status', 'Available')
        ->orWhere('id', $peminjaman->inventory_id)
        ->get();

        // Ambil data surat untuk validasi jika barang membutuhkan surat
        $surat = Arsip_surat::all();
        return view('kominfo.peminjaman.edit', compact('peminjaman', 'inventories','surat'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {


         // Validasi input
            $request->validate([
                'inventory_id' => 'required|exists:inventories,id',
                'status' => 'required|in:Pending,Approved,Returned',
                'surat_id' => 'nullable|exists:arsip_surats,id', // Surat bisa null jika tidak diperlukan
            ]);

            // Ambil data inventory yang dipilih
            $inventory = Inventory::find($request->inventory_id);

            // Validasi jika barang membutuhkan surat
            if ($inventory->requires_letter && !$request->surat_id) {
                return redirect()->back()->withErrors(['surat_id' => 'Barang ini memerlukan surat peminjaman.']);
            }

            // Jika status diperbarui menjadi Returned
            if ($request->status == 'Returned') {
                $inventory->update(['availability_status' => 'Available']); // Set barang menjadi tersedia
            }

            // Jika barang berubah, perbarui status barang lama dan baru
            if ($peminjaman->inventory_id != $request->inventory_id) {
                // Set barang lama menjadi tersedia
                $peminjaman->inventory->update(['availability_status' => 'Available']);

                // Set barang baru menjadi tidak tersedia
                $inventory->update(['availability_status' => 'Unavailable']);
            }

            // Perbarui peminjaman
            $peminjaman->update([
                'inventory_id' => $request->inventory_id,
                'status' => $request->status,
                'surat_id' => $request->surat_id,
            ]);

            // Log aktivitas
            activity()
                ->causedBy(Auth::user())
                ->performedOn($peminjaman)
                ->logName('Update_Peminjaman')
                ->log('Peminjaman diperbarui');

        // $request->validate([
        //     'status' => 'required|in:Pending,Approved,Returned',
        // ]);

        // if ($request->status == 'Returned') {
        //     $inventory = $peminjaman->inventory;
        //     $inventory->update(['availability_status' => 'Available']);
        // }

        // $peminjaman->update(['status' => $request->status]);

        return redirect()->route('peminjaman')->with('success', 'Status peminjaman berhasil diperbarui!');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        $inventory = $peminjaman->inventory;
        $inventory->update(['availability_status' => 'Available']);
        $peminjaman->delete();

        return redirect()->route('peminjaman')->with('success', 'Peminjaman berhasil dihapus!');
    }
}
