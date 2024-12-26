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

    Route::middleware(['role:ketua'])->group(function () {
        // Dashboard
        Route::get('ketua/dashboard', [DashboardController::class, 'ketua'])->name('ketua.dashboard');

        // User
        Route::get('ketua/user', [UserController::class, 'index'])->name('ketua.user.index');
        Route::get('ketua/user/create', [UserController::class, 'create'])->name('ketua.user.create');
        Route::post('ketua/user', [UserController::class, 'store'])->name('ketua.user.store');
        Route::get('ketua/user/{id}/edit', [UserController::class, 'edit'])->name('ketua.user.edit');
        Route::put('ketua/user/{id}', [UserController::class, 'update'])->name('ketua.user.update');
        Route::delete('ketua/user/{id}', [UserController::class, 'destroy'])->name('ketua.user.destroy');

        // Kecamatan
        Route::get('ketua/kecamatan', [KecamatanController::class, 'index'])->name('ketua.kecamatan.index');
        Route::get('ketua/kecamatan/create', [KecamatanController::class, 'create'])->name('ketua.kecamatan.create');
        Route::post('ketua/kecamatan', [KecamatanController::class, 'store'])->name('ketua.kecamatan.store');
        Route::get('ketua/kecamatan/{id}/edit', [KecamatanController::class, 'edit'])->name('ketua.kecamatan.edit');
        Route::put('ketua/kecamatan/{id}', [KecamatanController::class, 'update'])->name('ketua.kecamatan.update');
        Route::delete('ketua/kecamatan/{id}', [KecamatanController::class, 'destroy'])->name('ketua.kecamatan.destroy');

        // RKAT
        Route::get('ketua/rkat', [RKATController::class, 'index'])->name('ketua.rkat.index');
        Route::get('ketua/rkat/edit', [RKATController::class, 'edit'])->name('ketua.rkat.edit');
        Route::put('ketua/rkat/edit', [RKATController::class, 'update'])->name('ketua.rkat.update');

        // Acara Kegiatan
        Route::get('ketua/acara-kegiatan', [AcaraKegiatanController::class, 'index'])->name('ketua.acara_kegiatan.index');
        Route::get('ketua/acara-kegiatan/create', [AcaraKegiatanController::class, 'create'])->name('ketua.acara_kegiatan.create');
        Route::post('ketua/acara-kegiatan', [AcaraKegiatanController::class, 'store'])->name('ketua.acara_kegiatan.store');
        Route::get('ketua/acara-kegiatan/{id}/edit', [AcaraKegiatanController::class, 'edit'])->name('ketua.acara_kegiatan.edit');
        Route::put('ketua/acara-kegiatan/{id}', [AcaraKegiatanController::class, 'update'])->name('ketua.acara_kegiatan.update');
        Route::delete('ketua/acara-kegiatan/{id}', [AcaraKegiatanController::class, 'destroy'])->name('ketua.acara_kegiatan.destroy');
    });

    Route::middleware(['role:distribusi'])->group(function () {
        // Dashboard
        Route::get('distribusi/dashboard', [DashboardController::class, 'distribusi'])->name('distribusi.dashboard');
    });

    Route::middleware(['role:bendahara'])->group(function () {
        // Dashboard
        Route::get('bendahara/dashboard', [DashboardController::class, 'bendahara'])->name('bendahara.dashboard');

        // Keuangan
        Route::get('bendahara/keuangan', [KeuanganController::class, 'index'])->name('bendahara.keuangan.index');
        Route::get('bendahara/keuangan/create', [KeuanganController::class, 'create'])->name('bendahara.keuangan.create');
        Route::post('bendahara/keuangan', [KeuanganController::class, 'store'])->name('bendahara.keuangan.store');
        Route::get('bendahara/keuangan/{id}/edit', [KeuanganController::class, 'edit'])->name('bendahara.keuangan.edit');
        Route::put('bendahara/keuangan/{id}', [KeuanganController::class, 'update'])->name('bendahara.keuangan.update');
        Route::delete('bendahara/keuangan/{id}', [KeuanganController::class, 'destroy'])->name('bendahara.keuangan.destroy');
        Route::put('bendahara/keuangan/verifikasi/{id}', [KeuanganController::class, 'verifikasi'])->name('bendahara.keuangan.verifikasi');
    });

    Route::middleware(['role:publikasi'])->group(function () {
        // Dashboard
        Route::get('publikasi/dashboard', [DashboardController::class, 'publikasi'])->name('publikasi.dashboard');

        // Donatur
        Route::get('publikasi/donatur', [DonaturController::class, 'index'])->name('publikasi.donatur.index');
        Route::get('publikasi/donatur/create', [DonaturController::class, 'create'])->name('publikasi.donatur.create');
        Route::post('publikasi/donatur', [DonaturController::class, 'store'])->name('publikasi.donatur.store');
        Route::get('publikasi/donatur/{id}/edit', [DonaturController::class, 'edit'])->name('publikasi.donatur.edit');
        Route::put('publikasi/donatur/{id}', [DonaturController::class, 'update'])->name('publikasi.donatur.update');
        Route::delete('publikasi/donatur/{id}', [DonaturController::class, 'destroy'])->name('publikasi.donatur.destroy');

        // Pendanaan
        Route::get('publikasi/pendanaan', [PendanaanController::class, 'index'])->name('publikasi.pendanaan.index');
        Route::get('publikasi/pendanaan/create', [PendanaanController::class, 'create'])->name('publikasi.pendanaan.create');
        Route::post('publikasi/pendanaan', [PendanaanController::class, 'store'])->name('publikasi.pendanaan.store');
        Route::get('publikasi/pendanaan/{id}/edit', [PendanaanController::class, 'edit'])->name('publikasi.pendanaan.edit');
        Route::put('publikasi/pendanaan/{id}', [PendanaanController::class, 'update'])->name('publikasi.pendanaan.update');
        Route::delete('publikasi/pendanaan/{id}', [PendanaanController::class, 'destroy'])->name('publikasi.pendanaan.destroy');

        // Acara Kegiatan
        Route::get('publikasi/acara-kegiatan', [AcaraKegiatanController::class, 'index'])->name('publikasi.acara_kegiatan.index');
        Route::get('publikasi/acara-kegiatan/create', [AcaraKegiatanController::class, 'create'])->name('publikasi.acara_kegiatan.create');
        Route::post('publikasi/acara-kegiatan', [AcaraKegiatanController::class, 'store'])->name('publikasi.acara_kegiatan.store');
        Route::get('publikasi/acara-kegiatan/{id}/edit', [AcaraKegiatanController::class, 'edit'])->name('publikasi.acara_kegiatan.edit');
        Route::put('publikasi/acara-kegiatan/{id}', [AcaraKegiatanController::class, 'update'])->name('publikasi.acara_kegiatan.update');
        Route::delete('publikasi/acara-kegiatan/{id}', [AcaraKegiatanController::class, 'destroy'])->name('publikasi.acara_kegiatan.destroy');
    });

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

        // Acara Kegiatan
        Route::get('admin/acara-kegiatan', [AcaraKegiatanController::class, 'index'])->name('admin.acara_kegiatan.index');
        Route::get('admin/acara-kegiatan/create', [AcaraKegiatanController::class, 'create'])->name('admin.acara_kegiatan.create');
        Route::post('admin/acara-kegiatan', [AcaraKegiatanController::class, 'store'])->name('admin.acara_kegiatan.store');
        Route::get('admin/acara-kegiatan/{id}/edit', [AcaraKegiatanController::class, 'edit'])->name('admin.acara_kegiatan.edit');
        Route::put('admin/acara-kegiatan/{id}', [AcaraKegiatanController::class, 'update'])->name('admin.acara_kegiatan.update');
        Route::delete('admin/acara-kegiatan/{id}', [AcaraKegiatanController::class, 'destroy'])->name('admin.acara_kegiatan.destroy');
    });
});
