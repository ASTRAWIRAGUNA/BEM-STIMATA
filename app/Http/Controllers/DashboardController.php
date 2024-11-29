<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        switch ($user->role) {
            case 'Admin':
                return redirect()->route('dashboardAdmin');
            case 'Sekretaris':
               return redirect()->route('dashboardSekretaris');
            case 'Bendahara':
                return redirect()->route('dashboardBendahara');
            case 'Kominfo':
                return redirect()->route('dashboardKominfo');
            default:
                abort(403, 'Unauthorized');
        }
    }
}
