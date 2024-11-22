<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function cek() {
        if (auth()->user()->role_id === 1) {
            return redirect('/dashboardAdmin');
        } if (auth()->user()->role_id === 3) {
            return redirect('/dashboardSekretaris');
        } if (auth()->user()->role_id === 4) {
            return redirect('/dashboardKominfo');
        } else {
            return redirect('/dashboardBendahara');
        }
    } 
}
