<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // Untuk menangani HTTP request
use App\Models\Order;        // Model untuk tabel orders
use App\Models\OrderItem;    // Model untuk tabel order_items
use App\Models\Kopma;        // Model untuk tabel kopma
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
            'kopma_id' => 'required|array', // Array of kopma_id
            'kopma_id.*' => 'required|exists:kopmas,id', // Setiap kopma_id harus valid
            'quantity' => 'required|array', // Array of quantity
            'quantity.*' => 'required|integer|min:1', // Jumlah harus integer dan min 1
            'payment' => 'required|numeric|min:0',
        ]);

        // Hitung total harga
        $totalPrice = 0;
        $orderItems = [];

        foreach ($validated['kopma_id'] as $index => $kopmaId) {
            $kopma = Kopma::findOrFail($kopmaId);
            $quantity = $validated['quantity'][$index];
            $totalPrice += $kopma->item_price * $quantity;

            // Simpan order item
            $orderItems[] = [
                'kopma_id' => $kopma->id,
                'item_name' => $kopma->item_name,
                'quantity' => $quantity,
                'price_per_unit' => $kopma->item_price,
                'total_price' => $kopma->item_price * $quantity,
            ];

            // Kurangi stok kopma
            $kopma->quantity -= $quantity;
            $kopma->save();

            if ($kopma->quantity < $quantity) {
                return back()->with('error', 'Stok untuk ' . $kopma->item_name . ' tidak cukup.');
            }
        }

        // Simpan pesanan
        $order = Order::create([
            'user_id' => Auth::id(),
            'order_date' => now(),
            'total_amount' => $totalPrice,
        ]);

        // Simpan item pesanan
        foreach ($orderItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'kopma_id' => $item['kopma_id'],
                'item_name' => $item['item_name'],
                'quantity' => $item['quantity'],
                'price_per_unit' => $item['price_per_unit'],
                'total_price' => $item['total_price'],
            ]);
        }

        // Redirect ke halaman penjualan atau tampilan yang sesuai
        return redirect()->route('penjualan')->with('success', 'Pesanan berhasil dibuat.');
    }
}

