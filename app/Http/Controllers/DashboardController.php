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
                return view('admin.dashboardAdmin',compact('user'));
            case 'Sekretaris':
                return view('sekertaris.dashboardSekertaris',compact('user'));
            case 'Bendahara':
                return view('bendahara.dashboardBendahara',compact('user'));
            case 'Kominfo':
                return view('kominfo.dashboardKominfo',compact('user'));
            default:
                abort(403, 'Unauthorized');
        }
    }
}
