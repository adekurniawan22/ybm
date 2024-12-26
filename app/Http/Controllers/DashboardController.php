<?php

namespace App\Http\Controllers;

use App\Models\{AcaraKegiatan, Donatur, Kecamatan, Keuangan, Mitra, Pendanaan, Proposal, RKAT, User, Zis};

class DashboardController extends Controller
{
    public function admin()
    {
        return view('menu.dashboard.admin', [
            'title' => 'Dashboard',
            'jumlahAcaraKegiatan' => AcaraKegiatan::count(),
            'jumlahDonatur' => Donatur::count(),
            'jumlahKecamatan' => Kecamatan::count(),
            'jumlahKeuangan' => Keuangan::count(),
            'jumlahMitra' => Mitra::count(),
            'jumlahPendanaan' => Pendanaan::count(),
            'jumlahProposal' => Proposal::count(),
            'jumlahRKAT' => RKAT::count(),
            'jumlahUser' => User::count(),
            'jumlahZis' => Zis::count(),
        ]);
    }

    public function ketua()
    {
        return view('menu.dashboard.ketua', [
            'title' => 'Dashboard',
            'jumlahZis' => Zis::count(),
            'jumlahProposal' => Proposal::count(),
            'jumlahRKAT' => RKAT::count(),
            'jumlahKecamatan' => Kecamatan::count(),
            'jumlahUser' => User::count(),
            'jumlahAcaraKegiatan' => AcaraKegiatan::count(),
        ]);
    }

    public function distribusi()
    {
        return view('menu.dashboard.distribusi', [
            'title' => 'Dashboard',
            'jumlahProposal' => Proposal::count(),
            'jumlahZis' => Zis::count(),
            'jumlahMitra' => Mitra::count(),
        ]);
    }

    public function bendahara()
    {
        return view('menu.dashboard.bendahara', [
            'title' => 'Dashboard',
            'jumlahZis' => Zis::count(),
            'jumlahKeuangan' => Keuangan::count(),
        ]);
    }

    public function publikasi()
    {
        return view('menu.dashboard.publikasi', [
            'title' => 'Dashboard',
            'jumlahZis' => Zis::count(),
            'jumlahDonatur' => Donatur::count(),
            'jumlahPendanaan' => Pendanaan::count(),
            'jumlahAcaraKegiatan' => AcaraKegiatan::count(),
        ]);
    }
}
