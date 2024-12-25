<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController, DashboardController, UserController, KecamatanController, RKATController, KeuanganController, DonaturController, PendanaanController, AcaraKegiatanController};

// Routes untuk login dan logout
Route::get('/', [AuthController::class, 'landingPage']);
Route::post('donasi', [KeuanganController::class, 'donasi']);
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// Routes untuk dashboard
Route::middleware(['auth.custom'])->group(function () {

    // // Routes untuk Owner
    // Route::middleware(['role:manajer_produksi'])->group(function () {
    //     // Dashboard
    //     Route::get('manajer-produksi/dashboard', [DashboardController::class, 'manajer_produksi'])->name('manajer_produksi.dashboard');

    //     // CRUD Supplier
    //     Route::get('manajer-produksi/supplier', [SupplierController::class, 'index'])->name('manajer_produksi.supplier.index');
    //     Route::get('manajer-produksi/supplier/create', [SupplierController::class, 'create'])->name('manajer_produksi.supplier.create');
    //     Route::post('manajer-produksi/supplier', [SupplierController::class, 'store'])->name('manajer_produksi.supplier.store');
    //     Route::get('manajer-produksi/supplier/{id}/edit', [SupplierController::class, 'edit'])->name('manajer_produksi.supplier.edit');
    //     Route::put('manajer-produksi/supplier/{id}', [SupplierController::class, 'update'])->name('manajer_produksi.supplier.update');
    //     Route::delete('manajer-produksi/supplier/{id}', [SupplierController::class, 'destroy'])->name('manajer_produksi.supplier.destroy');

    //     // CRUD BahanBaku
    //     Route::get('manajer-produksi/bahan-baku', [BahanBakuController::class, 'index'])->name('manajer_produksi.bahan_baku.index');
    //     Route::get('manajer-produksi/bahan-baku/create', [BahanBakuController::class, 'create'])->name('manajer_produksi.bahan_baku.create');
    //     Route::post('manajer-produksi/bahan-baku', [BahanBakuController::class, 'store'])->name('manajer_produksi.bahan_baku.store');
    //     Route::get('manajer-produksi/bahan-baku/{id}/edit', [BahanBakuController::class, 'edit'])->name('manajer_produksi.bahan_baku.edit');
    //     Route::put('manajer-produksi/bahan-baku/{id}', [BahanBakuController::class, 'update'])->name('manajer_produksi.bahan_baku.update');
    //     Route::delete('manajer-produksi/bahan-baku/{id}', [BahanBakuController::class, 'destroy'])->name('manajer_produksi.bahan_baku.destroy');
    //     Route::get('manajer-produksi/bahan-baku/histori', [BahanBakuController::class, 'getDataMonthYear'])->name('manajer_produksi.bahan_baku.getDataMonthYear');

    //     // CRUD History BahanBaku
    //     Route::get('manajer-produksi/transaksi', [BahanBakuTransaksiController::class, 'index'])->name('manajer_produksi.transaksi.index');
    //     Route::get('manajer-produksi/transaksi/create', [BahanBakuTransaksiController::class, 'create'])->name('manajer_produksi.transaksi.create');
    //     Route::post('manajer-produksi/transaksi', [BahanBakuTransaksiController::class, 'store'])->name('manajer_produksi.transaksi.store');
    //     Route::get('manajer-produksi/transaksi/{id}/edit', [BahanBakuTransaksiController::class, 'edit'])->name('manajer_produksi.transaksi.edit');
    //     Route::put('manajer-produksi/transaksi/{id}', [BahanBakuTransaksiController::class, 'update'])->name('manajer_produksi.transaksi.update');
    //     Route::delete('manajer-produksi/transaksi/{id}', [BahanBakuTransaksiController::class, 'destroy'])->name('manajer_produksi.transaksi.destroy');
    // });

    // Route::middleware(['role:supervisor'])->group(function () {
    //     // Dashboard
    //     Route::get('supervisor/dashboard', [DashboardController::class, 'supervisor'])->name('supervisor.dashboard');

    //     // CRUD History BahanBaku
    //     Route::get('supervisor/transaksi', [BahanBakuTransaksiController::class, 'index'])->name('supervisor.transaksi.index');
    //     Route::get('supervisor/transaksi/create', [BahanBakuTransaksiController::class, 'create'])->name('supervisor.transaksi.create');
    //     Route::post('supervisor/transaksi', [BahanBakuTransaksiController::class, 'store'])->name('supervisor.transaksi.store');
    //     Route::get('supervisor/transaksi/{id}/edit', [BahanBakuTransaksiController::class, 'edit'])->name('supervisor.transaksi.edit');
    //     Route::put('supervisor/transaksi/{id}', [BahanBakuTransaksiController::class, 'update'])->name('supervisor.transaksi.update');
    //     Route::delete('supervisor/transaksi/{id}', [BahanBakuTransaksiController::class, 'destroy'])->name('supervisor.transaksi.destroy');
    // });

    Route::middleware(['role:admin'])->group(function () {
        // Dashboard
        Route::get('admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');

        // User
        Route::get('admin/user', [UserController::class, 'index'])->name('admin.user.index');
        Route::get('admin/user/create', [UserController::class, 'create'])->name('admin.user.create');
        Route::post('admin/user', [UserController::class, 'store'])->name('admin.user.store');
        Route::get('admin/user/{id}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
        Route::put('admin/user/{id}', [UserController::class, 'update'])->name('admin.user.update');
        Route::delete('admin/user/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');

        // Kecamatan
        Route::get('admin/kecamatan', [KecamatanController::class, 'index'])->name('admin.kecamatan.index');
        Route::get('admin/kecamatan/create', [KecamatanController::class, 'create'])->name('admin.kecamatan.create');
        Route::post('admin/kecamatan', [KecamatanController::class, 'store'])->name('admin.kecamatan.store');
        Route::get('admin/kecamatan/{id}/edit', [KecamatanController::class, 'edit'])->name('admin.kecamatan.edit');
        Route::put('admin/kecamatan/{id}', [KecamatanController::class, 'update'])->name('admin.kecamatan.update');
        Route::delete('admin/kecamatan/{id}', [KecamatanController::class, 'destroy'])->name('admin.kecamatan.destroy');

        // RKAT
        Route::get('admin/rkat', [RKATController::class, 'index'])->name('admin.rkat.index');
        Route::get('admin/rkat/edit', [RKATController::class, 'edit'])->name('admin.rkat.edit');
        Route::put('admin/rkat/edit', [RKATController::class, 'update'])->name('admin.rkat.update');

        // Keuangan
        Route::get('admin/keuangan', [KeuanganController::class, 'index'])->name('admin.keuangan.index');
        Route::get('admin/keuangan/create', [KeuanganController::class, 'create'])->name('admin.keuangan.create');
        Route::post('admin/keuangan', [KeuanganController::class, 'store'])->name('admin.keuangan.store');
        Route::get('admin/keuangan/{id}/edit', [KeuanganController::class, 'edit'])->name('admin.keuangan.edit');
        Route::put('admin/keuangan/{id}', [KeuanganController::class, 'update'])->name('admin.keuangan.update');
        Route::delete('admin/keuangan/{id}', [KeuanganController::class, 'destroy'])->name('admin.keuangan.destroy');
        Route::put('admin/keuangan/verifikasi/{id}', [KeuanganController::class, 'verifikasi'])->name('admin.keuangan.verifikasi');

        // Donatur
        Route::get('admin/donatur', [DonaturController::class, 'index'])->name('admin.donatur.index');
        Route::get('admin/donatur/create', [DonaturController::class, 'create'])->name('admin.donatur.create');
        Route::post('admin/donatur', [DonaturController::class, 'store'])->name('admin.donatur.store');
        Route::get('admin/donatur/{id}/edit', [DonaturController::class, 'edit'])->name('admin.donatur.edit');
        Route::put('admin/donatur/{id}', [DonaturController::class, 'update'])->name('admin.donatur.update');
        Route::delete('admin/donatur/{id}', [DonaturController::class, 'destroy'])->name('admin.donatur.destroy');

        // Pendanaan
        Route::get('admin/pendanaan', [PendanaanController::class, 'index'])->name('admin.pendanaan.index');
        Route::get('admin/pendanaan/create', [PendanaanController::class, 'create'])->name('admin.pendanaan.create');
        Route::post('admin/pendanaan', [PendanaanController::class, 'store'])->name('admin.pendanaan.store');
        Route::get('admin/pendanaan/{id}/edit', [PendanaanController::class, 'edit'])->name('admin.pendanaan.edit');
        Route::put('admin/pendanaan/{id}', [PendanaanController::class, 'update'])->name('admin.pendanaan.update');
        Route::delete('admin/pendanaan/{id}', [PendanaanController::class, 'destroy'])->name('admin.pendanaan.destroy');

        // Pendanaan
        Route::get('admin/acara-kegiatan', [AcaraKegiatanController::class, 'index'])->name('admin.acara_kegiatan.index');
        Route::get('admin/acara-kegiatan/create', [AcaraKegiatanController::class, 'create'])->name('admin.acara_kegiatan.create');
        Route::post('admin/acara-kegiatan', [AcaraKegiatanController::class, 'store'])->name('admin.acara_kegiatan.store');
        Route::get('admin/acara-kegiatan/{id}/edit', [AcaraKegiatanController::class, 'edit'])->name('admin.acara_kegiatan.edit');
        Route::put('admin/acara-kegiatan/{id}', [AcaraKegiatanController::class, 'update'])->name('admin.acara_kegiatan.update');
        Route::delete('admin/acara-kegiatan/{id}', [AcaraKegiatanController::class, 'destroy'])->name('admin.acara_kegiatan.destroy');
    });
});
