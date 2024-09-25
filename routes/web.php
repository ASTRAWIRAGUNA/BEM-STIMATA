<?php

use Illuminate\Support\Facades\Route;

// Login
Route::get('/', function () {
    return view('login');
});

// Dashboard
Route::get('/dashboard-admin', function () {
    return view('admin.dashboardAdmin');
});
Route::get('/log-activity', function () {
    return view('admin.logActivity');
});
Route::get('/manage-ukm-admin', function () {
    return view('admin.manageUKM');
});
Route::get('/manage-user', function () {
    return view('admin.manageUser');
});


// Bendahara
Route::get('/dashboard-bendahara', function () {
    return view('bendahara.dashboardBendahara');
});

Route::get('/dashboard-bendahara', function () {
    return view('bendahara.dashboardBendahara');
});

// Kominfo
Route::get('/dashboard-kominfo', function () {
    return view('kominfo.dashboardKominfo');
});

// Kopma
Route::get('/dashboard-kopma', function () {
    return view('kopma.dashboardKopma');
});

// Mahasiswa
Route::get('/home', function () {
    return view('mahasiswa.dashboardMahasiswa');
});


// SDM
Route::get('/dashboard-sdm', function () {
    return view('sdm.dashboardSDM');
});

// Sekertaris
Route::get('/dashboard-sekertaris', function () {
    return view('sekertaris.dashboardSekertaris');
});

// UKM
Route::get('/dashboard-ukm', function () {
    return view('ukm.dashboardUKM');
});
