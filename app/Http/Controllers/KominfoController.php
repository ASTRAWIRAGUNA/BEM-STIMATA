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
        $totalbarang = Inventory::count();
        $totalpeminjaman = Peminjaman::count();
       
        return view('kominfo.dashboardKominfo', compact('totalbarang', 'totalpeminjaman'));
        
        
    }
    public function index()
    {
         // Ambil semua data inventory
        //  $inventories = Inventory::all();
        $peminjaman = Peminjaman::with('inventory', 'surat')->get();
        return view('kominfo.peminjaman', compact('peminjaman'));
    }

    public function create()
    {
        // $inventories = Inventory::where('availability_status', 'Available')->get();
        $inventories = Inventory::all();
        $surats = Arsip_surat::all();
        return view('kominfo.peminjaman.create', compact('inventories', 'surats'));
    }

    public function store(Request $request)
    {
         // Validasi awal
    $request->validate([
        'nama_peminjam' => 'required|string|max:255', // Pastikan user ID valid 
        'inventory_id' => 'required|exists:inventories,id',
        'borrow_date' => 'required|date',
        'return_date' => 'required|date|after:borrow_date', // Pastikan tanggal pengembalian setelah tanggal pinjam
        'initial_condition_photo' => 'required|image|max:2048',
    ]);


    // Ambil data inventory
    $inventory = Inventory::find($request->inventory_id);
    // Validasi stok barang
    if ($inventory->stock <= 0) {
        return back()->with('error', 'Stok barang habis, tidak dapat dipinjam.');
    }

    // Validasi apakah barang memerlukan surat
    if ($inventory->requires_letter) {
        $request->validate([
            'surat_id' => 'required|exists:arsip_surats,id', // Pastikan surat ada jika diperlukan
        ]);
    }

    // // Pastikan barang masih tersedia
    // if ($inventory->availability_status === 'Unavailable') {
    //     return back()->with(['error' , 'Barang ini sedang tidak tersedia untuk dipinjam.']);
    // }

    // // Update status barang menjadi tidak tersedia
    // $inventory->update(['availability_status' => 'Unavailable']);
     

    // Simpan foto kondisi awal
    $initialPhotoPath = $request->file('initial_condition_photo')->store('initial_condition_photos', 'public');

    // Kurangi stok barang
    $inventory->decreaseStock();
    // Simpan data peminjaman
    Peminjaman::create([
        'inventory_id' => $request->inventory_id,
        // 'user_id' => Auth::id(), // gunakan ini agar hanya 1 orang saja yang bisa meminjam
        'nama_peminjam' => $request->nama_peminjam, //nama peminjam
        'surat_id' => $request->surat_id,
        'borrow_date' => $request->borrow_date,
        'return_date' => $request->return_date,
        'status' => 'Pending', // Status awal peminjaman
        'initial_condition_photo' => $initialPhotoPath,
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
                'return_condition' => 'required_if:status,Returned|string',
                'comments' => 'nullable|string',
            ]);

            // Ambil data inventory yang dipilih
            $inventory = Inventory::find($request->inventory_id);

            // Validasi jika barang membutuhkan surat
            if ($inventory->requires_letter && !$request->surat_id) {
                return redirect()->back()->withErrors(['surat_id' => 'Barang ini memerlukan surat peminjaman.']);
            }
            //  // Jika status menjadi Returned
            // if ($request->status == 'Returned') {
            //     // Tambahkan stok barang
            //     $inventory->increaseStock();

            //     // Perbarui data pengembalian
            //     $peminjaman->update([
            //         'status' => $request->status,
            //         'return_condition' => $request->return_condition,
            //         'comments' => $request->comments,
            //     ]);
            // } else {
            //     $peminjaman->update([
            //         'status' => $request->status,
            //     ]);
            // }

            // // Jika status diperbarui menjadi Returned
            // if ($request->status == 'Returned') {
            //     $inventory->update(['availability_status' => 'Available']); // Set barang menjadi tersedia
            // }

            // // Jika barang berubah, perbarui status barang lama dan baru
            // if ($peminjaman->inventory_id != $request->inventory_id) {
            //     // Set barang lama menjadi tersedia
            //     $peminjaman->inventory->update(['availability_status' => 'Available']);

            //     // Set barang baru menjadi tidak tersedia
            //     $inventory->update(['availability_status' => 'Unavailable']);
            // }

             // Jika barang berubah, perbarui stok barang lama dan baru
    if ($peminjaman->inventory_id != $request->inventory_id) {
        $peminjaman->inventory->increaseStock(); // Tambahkan stok barang lama
        $inventory->decreaseStock(); // Kurangi stok barang baru
    }

    // Jika status menjadi Returned
    if ($request->status === 'Returned') {
        $inventory->increaseStock(); // Tambahkan stok barang
        $peminjaman->update([
            'status' => $request->status,
            'return_condition' => $request->return_condition,
            'comments' => $request->comments,
        ]);
    } else {
        $peminjaman->update([
            'inventory_id' => $request->inventory_id,
            'status' => $request->status,
            'surat_id' => $request->surat_id,
        ]);
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
                // ->logName('Update_Peminjaman')
                ->log('Peminjaman diperbarui');

        return redirect()->route('peminjaman')->with('success', 'Status peminjaman berhasil diperbarui!');
    }
    public function return($id)
{
    $peminjaman = Peminjaman::findOrFail($id);

    // Validasi apakah status sudah 'Approved'
    if ($peminjaman->status != 'Approved') {
        return redirect()->route('peminjaman.index')->with('error', 'Pengembalian hanya bisa diproses untuk barang yang disetujui.');
    }

    // Perbarui status menjadi 'Returned'
    $peminjaman->update([
        'status' => 'Returned',
        'return_date' => now(), // Atur tanggal pengembalian otomatis
    ]);

    // Tambahkan stok barang kembali
    $inventory = $peminjaman->inventory;
    $inventory->increaseStock();

    // Perbarui status ketersediaan barang
    $inventory->update(['availability_status' => 'Available']);

    return redirect()->route('peminjaman')->with('success', 'Barang berhasil dikembalikan.');
}

    public function destroy(Peminjaman $peminjaman)
    {
        $inventory = $peminjaman->inventory;
        // Kembalikan stok barang
    $inventory->increaseStock();
        $peminjaman->delete();

        return redirect()->route('peminjaman')->with('success', 'Peminjaman berhasil dihapus!');
    }
}
