<?php

namespace App\Http\Controllers;

use App\Models\LogKopma;
use Illuminate\Http\Request;
use App\Models\Order;
use Spatie\Activitylog\Models\Activity;

class LogKopmaController extends Controller
{
    public function index()
    {
         // Ambil semua data dari tabel log_kopma
         $logs = LogKopma::with(['order', 'user'])->latest()->get();

        return view('bendahara.logKompaPenjualan', compact('logs'));
    }
}
