<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenjualanKopmaController extends Controller
{
    public function index()
    {
       
        return view('kopma.penjualanKopma');
    }

    public function create()
    {
        return view('kopma.create'); // Tampilkan form tambah pengguna
    }
}
