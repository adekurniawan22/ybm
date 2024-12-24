<?php

namespace App\Http\Controllers;

use App\Models\Donatur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DonaturController extends Controller
{
    private const TITLE_INDEX = 'List donatur';
    private const TITLE_CREATE = 'Tambah donatur';
    private const TITLE_EDIT = 'Edit donatur';

    public function index()
    {
        $data = Donatur::all();
        return view('menu.donatur.index', [
            'data' => $data,
            'title' => self::TITLE_INDEX
        ]);
    }

    public function create()
    {
        return view('menu.donatur.create', [
            'title' => self::TITLE_CREATE
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), (new Donatur)->rules(false), [], (new Donatur)->attributes());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Donatur::create([
            'nama_donatur' => $request->nama_donatur,
            'email' => $request->email,
            'sudah_diberi_notifikasi' => '0',
        ]);

        return redirect()->route(session()->get('role') . '.donatur.index')
            ->with(['success' => 'Donatur berhasil dibuat.']);
    }

    public function edit($id)
    {
        $data = Donatur::findOrFail($id);
        return view('menu.donatur.edit', [
            'data' => $data,
            'title' => self::TITLE_EDIT
        ]);
    }

    public function update(Request $request, $id)
    {
        $donatur = Donatur::findOrFail($id);
        $validator = Validator::make($request->all(), $donatur->rules(true), [], $donatur->attributes());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Cek apakah ada perubahan data
        $originalData = $donatur->getOriginal();
        $updatedData = $request->only(['nama_donatur', 'email']);

        if (array_diff_assoc($updatedData, $originalData) === []) {
            return redirect()->back()->with(['info' => 'Tidak ada data yang diubah.']);
        }

        $donatur->fill($updatedData);
        $donatur->save();

        return redirect()->route(session()->get('role') . '.donatur.index')
            ->with(['success' => 'Donatur berhasil diupdate.']);
    }

    public function destroy($id)
    {
        $donatur = Donatur::findOrFail($id);
        $donatur->delete();

        return redirect()->route(session()->get('role') . '.donatur.index')
            ->with(['success' => 'Donatur berhasil dihapus.']);
    }
}
