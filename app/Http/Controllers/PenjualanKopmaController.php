<?php

namespace App\Http\Controllers;

use App\Models\LogKopma;
use Illuminate\Support\Facades\DB;
use App\Models\Kopma;        // Model untuk tabel kopma
use App\Models\Order;        // Model untuk tabel orders
use Illuminate\Http\Request; // Untuk menangani HTTP request
use App\Models\OrderItem;    // Model untuk tabel order_items
use Illuminate\Support\Facades\Auth; // Untuk mendapatkan user yang sedang login

class PenjualanKopmaController extends Controller
{
     /**
     * Menampilkan daftar order item.
     */
    public function index()
    {
        // Ambil order item untuk pengguna yang sedang login
         // Ambil semua pesanan yang dimiliki oleh pengguna yang sedang login
         $orders = Order::with('orderItems.kopma') // Memuat orderItems beserta kopma-nya
         ->where('user_id', Auth::id()) // Hanya untuk pesanan milik pengguna yang login
         ->get();

    // Kirim data ke view
    return view('kopma.penjualanKopma', compact('orders'));
    }

    /**
     * Menampilkan form untuk membuat pesanan baru.
     */
    public function create()
    {
        // Ambil semua data item kopma dari database
        $kopmas = Kopma::all();

        // Kirimkan data kopmas ke view
        return view('kopma.create', compact('kopmas')); // Pastikan 'kopmas' dikirim ke view
    }

    public function store(Request $request)
    {
         // Validasi input
    $validated = $request->validate([
        'kopma_id' => 'required|array',
        'kopma_id.*' => 'required|exists:kopmas,id',
        'quantity' => 'required|array',
        'quantity.*' => 'required|integer|min:1',
        'payment' => 'required|numeric|min:0',
    ]);

    // Inisialisasi total harga dan error
    $totalPrice = 0;
    $errors = [];

    foreach ($validated['kopma_id'] as $index => $kopmaId) {
        $kopma = Kopma::findOrFail($kopmaId);
        $quantity = $validated['quantity'][$index];

        // Cek stok barang
        if ($kopma->quantity < $quantity) {
            $errors[] = "Stok untuk item '{$kopma->item_name}' tidak mencukupi. Stok tersedia: {$kopma->quantity}.";
        } else {
            $totalPrice += $kopma->item_price * $quantity;
        }
    }
     // Cek apakah pembayaran mencukupi
     if ($request->payment < $totalPrice) {
        $errors[] = "Jumlah pembayaran tidak mencukupi. Total harga: Rp. " . number_format($totalPrice, 0, ',', '.') . ". Pembayaran Anda: Rp. " . number_format($request->payment, 0, ',', '.');
    }

    // Jika ada error, kembalikan ke halaman create dengan pesan error
    if (!empty($errors)) {
        return redirect()->back()
            ->withErrors($errors) // Kirim error sebagai bagian dari session
            ->withInput(); // Kembalikan input ke form
    }

    // Jika tidak ada error, simpan pesanan
    $order = Order::create([
        'user_id' => Auth::id(),
        'order_date' => now(),
        'total_amount' => $totalPrice,
    ]);
     // Tambahkan log ke tabel log_kopma
     LogKopma::create([
        'order_id' => $order->id,
        'user_id' => Auth::id(),
        'transaction_date' => $order->order_date,
        'total_amount' => $order->total_amount,
    ]);


    foreach ($validated['kopma_id'] as $index => $kopmaId) {
        $kopma = Kopma::findOrFail($kopmaId);
        $quantity = $validated['quantity'][$index];

        // Simpan item pesanan
        OrderItem::create([
            'order_id' => $order->id,
            'kopma_id' => $kopma->id,
            'item_name' => $kopma->item_name,
            'quantity' => $quantity,
            'price_per_unit' => $kopma->item_price,
            'total_price' => $kopma->item_price * $quantity,
        ]);

        // Kurangi stok barang
        $kopma->quantity -= $quantity;
        $kopma->save();
    }

    return redirect()->route('penjualan')
        ->with('success', 'Pesanan berhasil dibuat.');

    }
}

