<?php

namespace App\Http\Controllers;

use App\Models\{Pendanaan, Donatur, Keuangan};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PendanaanController extends Controller
{
    private const TITLE_INDEX = 'List pendanaan';
    private const TITLE_CREATE = 'Tambah pendanaan';
    private const TITLE_EDIT = 'Edit pendanaan';

    public function index()
    {
        $data = Pendanaan::with('keuangan', 'donatur', 'ditambahkanOleh')->get();
        return view('menu.pendanaan.index', [
            'data' => $data,
            'title' => self::TITLE_INDEX
        ]);
    }

    public function create()
    {
        $donatur = Donatur::where('nama_donatur', '!=', 'anonymous')->get();
        return view('menu.pendanaan.create', [
            'title' => self::TITLE_CREATE,
            'donatur' => $donatur,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            (new Pendanaan)->rules(isset($request->new_donatur)),
            [],
            (new Pendanaan)->attributes()
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (isset($request->new_donatur)) {
            $donatur = Donatur::create([
                'nama_donatur' => $request->nama_donatur,
                'email' => $request->email,
                'sudah_diberi_notifikasi' => '0',
            ]);
            $donatur_id = $donatur->donatur_id;
        } else {
            $donatur_id = $request->donatur_id;
        }

        $file_path = null;
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $folderPath = public_path('keuangan');

            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }

            $file = $request->file('file');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move($folderPath, $fileName);
            $file_path = 'keuangan/' . $fileName;
        }

        $keuangan = Keuangan::create([
            'jenis' => 'masuk',
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'jumlah' => $request->jumlah,
            'file' => $file_path,
            'keterangan' => $request->keterangan,
            'verifikasi' => '0',
            'ditambahkan_oleh' => session()->get('user_id'),
        ]);

        Pendanaan::create([
            'donatur_id' => $donatur_id,
            'keuangan_id' => $keuangan->keuangan_id,
            'ditambahkan_oleh' => session()->get('user_id'),
        ]);

        return redirect()->route(session()->get('role') . '.pendanaan.index')
            ->with(['success' => 'Pendanaan berhasil dibuat.']);
    }

    public function edit($id)
    {
        $data = Pendanaan::with('keuangan', 'donatur')->findOrFail($id);
        $donatur = Donatur::where('nama_donatur', '!=', 'anonymous')->get();
        return view('menu.pendanaan.edit', [
            'data' => $data,
            'donatur' => $donatur,
            'title' => self::TITLE_EDIT
        ]);
    }

    public function update(Request $request, $id)
    {
        $pendanaan = Pendanaan::with('keuangan', 'donatur')->findOrFail($id);
        $validator = Validator::make($request->all(), $pendanaan->rules(false), [], $pendanaan->attributes());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $tanggalTransaksi = \Carbon\Carbon::parse($request->tanggal_transaksi)->format('Y-m-d H:i:s');

        $updatedData = [
            'donatur_id' => $request->donatur_id,
            'tanggal_transaksi' => $tanggalTransaksi,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
        ];

        $originalData = [
            'donatur_id' => $pendanaan->donatur_id,
            'tanggal_transaksi' => $pendanaan->keuangan->tanggal_transaksi,
            'jumlah' => $pendanaan->keuangan->jumlah,
            'keterangan' => $pendanaan->keuangan->keterangan,
        ];

        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $folderPath = public_path('keuangan');

            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }

            if ($pendanaan->keuangan->file && file_exists(public_path($pendanaan->keuangan->file))) {
                unlink(public_path($pendanaan->keuangan->file));
            }

            $file = $request->file('file');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move($folderPath, $fileName);

            $updatedData['file'] = 'keuangan/' . $fileName;
        }

        if (array_diff_assoc($updatedData, $originalData) === []) {
            return redirect()->back()->with(['info' => 'Tidak ada data yang diubah.']);
        }

        $pendanaan->update([
            'donatur_id' => $updatedData['donatur_id']
        ]);

        // Update tabel keuangan
        $pendanaan->keuangan()->update([
            'tanggal_transaksi' => $updatedData['tanggal_transaksi'],
            'jumlah' => $updatedData['jumlah'],
            'keterangan' => $updatedData['keterangan'],
            'file' => $updatedData['file'] ?? $pendanaan->keuangan->file
        ]);

        return redirect()->route(session()->get('role') . '.pendanaan.index')
            ->with(['success' => 'Pendanaan berhasil diupdate.']);
    }

    public function destroy($id)
    {
        $pendanaan = Pendanaan::findOrFail($id);
        if ($pendanaan->keuangan->file && file_exists(public_path($pendanaan->keuangan->file))) {
            unlink(public_path($pendanaan->keuangan->file));
        }
        $pendanaan->delete();

        return redirect()->route(session()->get('role') . '.pendanaan.index')
            ->with(['success' => 'Pendanaan berhasil dihapus.']);
    }
}
