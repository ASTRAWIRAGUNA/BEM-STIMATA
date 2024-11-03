<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;

// Login
Route::get('/', function () {
    return view('login');
});

// Dashboard
// Route::get('/dashboard-admin', function () {
//     return view('admin.dashboardAdmin');
// });

Route::get('/dashboard-admin', function () {
    return view('admin.dashboardAdmin');
})->middleware('role:admin');

Route::get('/log-activity', function () {
    return view('admin.logActivity');
});
Route::get('/manage-ukm-admin', function () {
    return view('admin.manageUKM');
});
// Route::get('/manage-user', function () {
//     return view('admin.manageUser');
// });
// Route::get('/manage-user', [RoleController::class, 'index'])->name('manageUser');

// change route to resources 

// CRUD USER
Route::controller(RoleController::class)->prefix('manageUser')->group(function () {
    Route::get('', 'index')->name('roles');
    Route::get('create', 'create')->name('roles.create');
    Route::post('store', 'store')->name('roles.store');
    Route::get('show/{id}', 'show')->name('roles.show');
    Route::get('edit/{id}', 'edit')->name('roles.edit');
    Route::put('edit/{id}', 'update')->name('roles.update');
    Route::delete('destroy/{id}', 'destroy')->name('roles.destroy');
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
    return view('kopma.penjualanKopma');
});

// Mahasiswa
Route::get('/home', function () {
    return view('mahasiswa.homeMahasiswa');
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
