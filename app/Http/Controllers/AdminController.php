<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Arsip_surat;
use App\Models\User;
use App\Models\Peminjaman;
use App\Models\Inventory;

class AdminController extends Controller
{
    public function index() {
        $totaluser = User::count();
        $surat = Arsip_surat::count();
        $peminjaman = Peminjaman::count();
        $inventory = Inventory::count();
        // Debugging
        // dd($totaluser, $surat);

        return view('admin.dashboardAdmin',compact('totaluser','surat','peminjaman','inventory'));
        
        
    }
}
