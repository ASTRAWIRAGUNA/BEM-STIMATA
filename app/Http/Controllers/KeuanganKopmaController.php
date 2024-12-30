<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\UangKeluar;

class KeuanganKopmaController extends Controller
{
    public function index(){
        // Ambil data Uang Masuk
        $uangMasuk = DB::table('orders')
            ->select(
                'id',
                'order_date as tanggal',
                DB::raw('CONCAT("Uang Masuk dari Penjualan Kopma") as keterangan'),
                'total_amount as jumlah',
                DB::raw('"Uang Masuk" as tipe')
            )
            ->get();

        // Ambil data Uang Keluar
        $uangKeluar = DB::table('uang_keluar')
            ->select(
                'id',
                'tanggal',
                'keterangan',
                'jumlah',
                DB::raw('"Uang Keluar" as tipe')
            )
            ->get();

        // Gabungkan data
        $keuangan = $uangMasuk->merge($uangKeluar)->sortBy('tanggal');

        // Hitung total pendapatan
        $totalPendapatan = $keuangan->reduce(function ($carry, $item) {
            if ($item->tipe == 'Uang Masuk') {
                // Tambah jika tipe adalah 'Uang Masuk'
                return $carry + $item->jumlah;
            } elseif ($item->tipe == 'Uang Keluar') {
                // Kurangi jika tipe adalah 'Uang Keluar'
                return $carry - $item->jumlah;
            }
            return $carry;
        }, 0); // Inisialisasi dengan nilai 0

        return view('bendahara.manageKeuangan', compact('keuangan', 'totalPendapatan'));
    }

    public function create(){
        return view('keuangan.uangKeluar'); 
    }

    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0',
        ]);

        try {
            // Mulai transaksi database untuk memastikan konsistensi
            DB::beginTransaction();

            // Simpan data ke tabel `uang_keluar`
            DB::table('uang_keluar')->insert([
                'tanggal' => $request->tanggal,
                'keterangan' => $request->keterangan,
                'jumlah' => $request->jumlah,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Commit transaksi setelah berhasil menyimpan data
            DB::commit();

            // Redirect ke halaman lain dengan pesan sukses
            return redirect()->route('keuangan')->with('success', 'Data uang keluar berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            // Redirect kembali dengan pesan error
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
