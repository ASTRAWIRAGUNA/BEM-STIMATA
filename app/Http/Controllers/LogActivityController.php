<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class LogActivityController extends Controller
{
    public function index()
{
    // Ambil semua log aktivitas dari tabel activity_log
    $logs = Activity::with('causer')->orderBy('created_at', 'desc')->get();

    return view('logactivity.logActivity', compact('logs'));
}
}
