<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KominfoController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\BendaharaController;
use App\Http\Controllers\SekretarisController;

// Login
Route::get('/', function ()  {
   return view('login'); 
});

//  jika user belum login
Route::group(['middleware' => 'guest'], function() {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/', [AuthController::class, 'dologin']);

});

// untuk admin,bendahara,sekretaris dan kominfo 
Route::group(['middleware' => ['auth','verifyrole', 'checkrole:1,2,3,4']], function() {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/redirect', [RedirectController::class, 'cek']);
});

// untuk superadmin
Route::group(['middleware' => ['auth', 'verifyrole','checkrole:1']], function() {
    Route::get('/dashboardAdmin', [AdminController::class, 'index'])->name('admin');
});

// untuk bendahara
Route::group(['middleware' => ['auth', 'verifyrole','checkrole:2']], function() {
    Route::get('/dashboardBendahara', [BendaharaController::class, 'index']);

});
// untuk bendahara
Route::group(['middleware' => ['auth','verifyrole', 'checkrole:3']], function() {
    Route::get('/dashboardSekretaris', [SekretarisController::class, 'index']);

});
// untuk bendahara
Route::group(['middleware' => ['auth','verifyrole', 'checkrole:4']], function() {
    Route::get('/dashboardKominfo', [KominfoController::class, 'index']);

});
// Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
// Route::post('/login', [LoginController::class, 'login']);

//Dashboard
// Route::get('/dashboard-admin', function () {
//     return view('admin.dashboardAdmin');
// })->name('admin')->middleware('role');

// Route::get('/dashboard-admin', function () {
//     return view('admin.dashboardAdmin');
// });

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
