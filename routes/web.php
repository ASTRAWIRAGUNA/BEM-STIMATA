<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\KominfoController;
use App\Http\Controllers\LogKopmaController;
use App\Http\Controllers\BendaharaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\KeuanganKopmaController;
use App\Http\Controllers\SekretarisController;
use App\Http\Controllers\LogActivityController;
use App\Http\Controllers\PenjualanKopmaController;
use App\Models\Keuangan;

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
    //Detail Account
    Route::get('/account', [AccountController::class, 'detail'])->name('account.detail');
    Route::put('/account', [AccountController::class, 'update'])->name('account.update');


    Route::middleware(['checkrole:Admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboardAdmin');
        Route::resource('manageuser', UserController::class);
        Route::get('/logactivity', [LogActivityController::class, 'index'])->name('logactivity');
    });

    Route::middleware('checkrole:Sekretaris')->group(function () {
        // Routes khusus untuk Sekretaris

        //dashboard 
        Route::get('/dashboardSekretaris', [SekretarisController::class, 'dashboard'])->name('dashboardSekretaris');

        Route::get('/arsipSurat', [SekretarisController::class, 'index'])->name('arsipSurat');
        Route::get('/arsipSurat/create', [SekretarisController::class, 'create'])->name('arsipSurat.create');
        Route::post('/arsipSurat', [SekretarisController::class, 'store'])->name('arsipSurat.store');
        Route::delete('/arsipSurat/{letter}', [SekretarisController::class, 'destroy'])->name('arsipSurat.destroy');
        Route::get('/arsipSurat/export',[SekretarisController::class,'export'])->name('arsipSurat.export');
    });

    Route::middleware('checkrole:Bendahara')->group(function () {
        // Routes khusus untuk Bendahara

        //dashboard Bendahara
        Route::get('/dashboardBendahara', [BendaharaController::class, 'dashboard'])->name('dashboardBendahara');

        //crud manage kopma
        Route::get('/bendahara', [BendaharaController::class, 'index'])->name('bendahara');
        Route::get('/bendahara/create', [BendaharaController::class, 'create'])->name('bendahara.create');
        Route::post('/bendahara', [BendaharaController::class, 'store'])->name('bendahara.store');
        Route::get('/bendahara/{bendahara}/edit', [BendaharaController::class, 'edit'])->name('bendahara.edit');
        Route::put('/bendahara/{bendahara}', [BendaharaController::class, 'update'])->name('bendahara.update');
        Route::delete('/bendahara/{bendahara}', [BendaharaController::class, 'destroy'])->name('bendahara.destroy');
        //penjualan kopma
        Route::get('/penjualan', [PenjualanKopmaController::class, 'index'])->name('penjualan');
        Route::get('/penjualan/create', [PenjualanKopmaController::class, 'create'])->name('penjualan.create');
        Route::post('/penjualan', [PenjualanKopmaController::class, 'store'])->name('penjualan.store');
        Route::get('/penjualan/{penjualan}/edit', [PenjualanKopmaController::class, 'edit'])->name('penjualan.edit');
        Route::put('/penjualan/{penjualan}', [PenjualanKopmaController::class, 'update'])->name('penjualan.update');
        Route::delete('/penjualan/{penjualan}', [PenjualanKopmaController::class, 'destroy'])->name('penjualan.destroy');
        //keuangan kopma
        Route::get('/keuangan', [KeuanganKopmaController::class, 'index'])->name('keuangan');
        Route::get('/keuangan/create', [KeuanganKopmaController::class, 'create'])->name('keuangan.create');
        Route::post('/keuangan', [KeuanganKopmaController::class, 'store'])->name('keuangan.store');
        //logKopma
        Route::get('/logKopma', [LogKopmaController::class, 'index'])->name('logKopma');
    });

    Route::middleware('checkrole:Kominfo')->group(function () {
        // Routes khusus untuk Kominfo

        //dashboard kominfo
        Route::get('/dashboardKominfo', [KominfoController::class, 'dashboard'])->name('dashboardKominfo');

        // Crud Peminjaman
        Route::get('/peminjaman', [KominfoController::class, 'index'])->name('peminjaman');
        Route::get('/peminjaman/create', [KominfoController::class, 'create'])->name('peminjaman.create');
        Route::post('/peminjaman', [KominfoController::class, 'store'])->name('peminjaman.store');
        Route::get('/peminjaman/{peminjaman}/edit', [KominfoController::class, 'edit'])->name('peminjaman.edit');
        Route::put('/peminjaman/{peminjaman}', [KominfoController::class, 'update'])->name('peminjaman.update');
        Route::put('/peminjaman/{peminjaman}/return', [KominfoController::class, 'return'])->name('peminjaman.return');
        Route::get('/peminjaman/{peminjaman}/pengembalian', [KominfoController::class, 'pengembalian'])->name('peminjaman.pengembalian');

        Route::delete('/peminjaman/{peminjaman}', [KominfoController::class, 'destroy'])->name('peminjaman.destroy');

        //CRUD BARANG Kominfo
         // Routes khusus untuk Kominfo (CRUD Barang)
        Route::get('/inventories', [InventoryController::class, 'index'])->name('inventories');
        Route::get('/inventories/create', [InventoryController::class, 'create'])->name('inventories.create');
        Route::post('/inventories', [InventoryController::class, 'store'])->name('inventories.store');
        Route::get('/inventories/{inventory}/edit', [InventoryController::class, 'edit'])->name('inventories.edit');
        Route::put('/inventories/{inventory}', [InventoryController::class, 'update'])->name('inventories.update');
        Route::delete('/inventories/{inventory}', [InventoryController::class, 'destroy'])->name('inventories.destroy');
    });
});

