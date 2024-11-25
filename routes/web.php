<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LogActivityController;
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
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/', [AuthController::class, 'login']);
    

});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'login']);


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('checkrole:Admin')->group(function () {
        // Routes khusus untuk Admin

        //route manageuser
        Route::get('/manageuser', [UserController::class, 'index'])->name('manageuser');
        Route::get('/manageuser/create', [UserController::class, 'create'])->name('manageuser.create');
        Route::post('/manageuser', [UserController::class, 'store'])->name('manageuser.store');
        Route::get('/manageuser/{id}/edit', [UserController::class, 'edit'])->name('manageuser.edit');
        Route::put('/manageuser/{id}', [UserController::class, 'update'])->name('manageuser.update');
        Route::delete('/manageuser/{id}', [UserController::class, 'destroy'])->name('manageuser.destroy');
        Route::get('/manageuser/{id}', [UserController::class, 'show'])->name('manageuser.show');
        //route logact
        // Route::get('/logactivity', [AuthController::class, 'log'])->name('logactivity');
        // Route::get('/logactivity', [UserController::class, 'log'])->name('logactivity');
        Route::get('/logactivity', [LogActivityController::class, 'index'])->name('logactivity');
    });

    Route::middleware('checkrole:Sekretaris')->group(function () {
        // Routes khusus untuk Sekretaris

        Route::get('/arsipSurat', [SekretarisController::class, 'index'])->name('arsipSurat');
        Route::get('/arsipSurat/create', [SekretarisController::class, 'create'])->name('arsipSurat.create');
        Route::post('/arsipSurat', [SekretarisController::class, 'store'])->name('arsipSurat.store');
        Route::delete('/arsipSurat/{letter}', [SekretarisController::class, 'destroy'])->name('arsipSurat.destroy');
    });

    Route::middleware('checkrole:Bendahara')->group(function () {
        // Routes khusus untuk Bendahara
    });

    Route::middleware('checkrole:Kominfo')->group(function () {
        // Routes khusus untuk Kominfo
    });
});

// untuk admin,bendahara,sekretaris dan kominfo 
// Route::group(['middleware' => ['auth','verifyrole', 'checkrole:1,2,3,4']], function() {
//     Route::post('/logout', [AuthController::class, 'logout']);
//     Route::get('/redirect', [RedirectController::class, 'cek']);
// });

// untuk superadmin
// Route::group(['middleware' => ['auth', 'verifyrole','checkrole:1']], function() {
//     Route::get('/dashboardAdmin', [AdminController::class, 'index'])->name('admin');
// });

// // untuk bendahara
// Route::group(['middleware' => ['auth', 'verifyrole','checkrole:2']], function() {
//     Route::get('/dashboardBendahara', [BendaharaController::class, 'index']);

// });
// // untuk bendahara
// Route::group(['middleware' => ['auth','verifyrole', 'checkrole:3']], function() {
//     Route::get('/dashboardSekretaris', [SekretarisController::class, 'index']);

// });
// // untuk bendahara
// Route::group(['middleware' => ['auth','verifyrole', 'checkrole:4']], function() {
//     Route::get('/dashboardKominfo', [KominfoController::class, 'index']);

// });
// Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
// Route::post('/login', [LoginController::class, 'login']);

//Dashboard
// Route::get('/dashboard-admin', function () {
//     return view('admin.dashboardAdmin');
// })->name('admin')->middleware('role');

// Route::get('/dashboard-admin', function () {
//     return view('admin.dashboardAdmin');
// });

// Route::get('/log-activity', function () {
//     return view('admin.logActivity');
// });
// Route::get('/manage-ukm-admin', function () {
//     return view('admin.manageUKM');
// });
// Route::get('/manage-user', function () {
//     return view('admin.manageUser');
// })->name('user');
// Route::get('/manage-user', [RoleController::class, 'index'])->name('manageUser');

// change route to resources 

// CRUD USER


// Route::middleware(['auth', 'role:Admin'])->group(function () {
//     Route::get('/manageuser', [UserController::class, 'index'])->name('manageuser');
//     Route::get('/manageuser/create', [UserController::class, 'create'])->name('manageuser.create');
//     Route::post('/manageuser', [UserController::class, 'store'])->name('manageuser.store');
//     Route::get('/manageuser/{id}/edit', [UserController::class, 'edit'])->name('manageuser.edit');
//     Route::put('/manageuser/{id}', [UserController::class, 'update'])->name('manageuser.update');
//     Route::delete('/manageuser/{id}', [UserController::class, 'destroy'])->name('manageuser.destroy');
//     Route::get('/manageuser/{id}', [UserController::class, 'show'])->name('manageuser.show');
// });



// // Bendahara
// Route::get('/dashboard-bendahara', function () {
//     return view('bendahara.dashboardBendahara');
// });

// Route::get('/dashboard-bendahara', function () {
//     return view('bendahara.dashboardBendahara');
// });

// // Kominfo
// Route::get('/dashboard-kominfo', function () {
//     return view('kominfo.dashboardKominfo');
// });

// Kopma
// Route::get('/dashboard-kopma', function () {
//     return view('kopma.penjualanKopma');
// });

// // Mahasiswa
// Route::get('/home', function () {
//     return view('mahasiswa.homeMahasiswa');
// });


// // SDM
// Route::get('/dashboard-sdm', function () {
//     return view('sdm.dashboardSDM');
// });

// Sekertaris
// Route::get('/dashboard-sekertaris', function () {
//     return view('sekertaris.dashboardSekertaris');
// });

// UKM
// Route::get('/dashboard-ukm', function () {
//     return view('ukm.dashboardUKM');
// });
