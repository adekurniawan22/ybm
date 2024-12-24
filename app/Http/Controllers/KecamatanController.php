<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KecamatanController extends Controller
{
    private const TITLE_INDEX = 'List kecamatan';
    private const TITLE_CREATE = 'Tambah kecamatan';
    private const TITLE_EDIT = 'Edit kecamatan';

    public function index()
    {
        $data = Kecamatan::all();
        return view('menu.kecamatan.index', [
            'data' => $data,
            'title' => self::TITLE_INDEX
        ]);
    }

    public function create()
    {
        return view('menu.kecamatan.create', [
            'title' => self::TITLE_CREATE
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), (new Kecamatan)->rules(), [], (new Kecamatan)->attributes());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Kecamatan::create([
            'nama_kecamatan' => $request->nama_kecamatan,
        ]);

        return redirect()->route(session()->get('role') . '.kecamatan.index')
            ->with(['success' => 'Kecamatan berhasil dibuat.']);
    }

    public function edit($id)
    {
        $data = Kecamatan::findOrFail($id);
        return view('menu.kecamatan.edit', [
            'data' => $data,
            'title' => self::TITLE_EDIT
        ]);
    }

    public function update(Request $request, $id)
    {
        $kecamatan = Kecamatan::findOrFail($id);
        $validator = Validator::make($request->all(), $kecamatan->rules(), [], $kecamatan->attributes());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Periksa apakah ada perubahan pada nama_kecamatan
        if ($kecamatan->nama_kecamatan === $request->input('nama_kecamatan')) {
            return redirect()->back()->with(['info' => 'Tidak ada data yang diubah.']);
        }

        $kecamatan->nama_kecamatan = $request->input('nama_kecamatan');
        $kecamatan->save();

        return redirect()->route(session()->get('role') . '.kecamatan.index')
            ->with(['success' => 'Kecamatan berhasil diupdate.']);
    }

    public function destroy($id)
    {
        $kecamatan = Kecamatan::findOrFail($id);
        $kecamatan->delete();

        return redirect()->route(session()->get('role') . '.kecamatan.index')
            ->with(['success' => 'Kecamatan berhasil dihapus.']);
    }
}
