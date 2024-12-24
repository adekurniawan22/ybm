<?php

namespace App\Http\Controllers;

use App\Models\Donatur;
use App\Models\Keuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class KeuanganController extends Controller
{
    private const TITLE_INDEX = 'List keuangan';
    private const TITLE_CREATE = 'Tambah keuangan';
    private const TITLE_EDIT = 'Edit keuangan';

    public function index()
    {
        $data = Keuangan::with('ditambahkanOleh')->get();
        return view('menu.keuangan.index', [
            'data' => $data,
            'title' => self::TITLE_INDEX
        ]);
    }

    public function create()
    {
        return view('menu.keuangan.create', [
            'title' => self::TITLE_CREATE
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), (new Keuangan)->rules(), [], (new Keuangan)->attributes());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Cek jika file ada di request
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $folderPath = public_path('keuangan');

            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }

            $file = $request->file('file');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move($folderPath, $fileName);

            Keuangan::create([
                'jenis' => $request->jenis,
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'jumlah' => $request->jumlah,
                'file' => 'keuangan/' . $fileName,
                'keterangan' => $request->keterangan,
                'verifikasi' => '1',
                'ditambahkan_oleh' => session()->get('user_id'),
            ]);
        } else {
            Keuangan::create([
                'jenis' => $request->jenis,
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'jumlah' => $request->jumlah,
                'file' => null,
                'keterangan' => $request->keterangan,
                'verifikasi' => '1',
                'ditambahkan_oleh' => session()->get('user_id'),
            ]);
        }

        return redirect()->route(session()->get('role') . '.keuangan.index')
            ->with(['success' => 'Keuangan berhasil dibuat.']);
    }

    public function edit($id)
    {
        $data = Keuangan::findOrFail($id);
        return view('menu.keuangan.edit', [
            'data' => $data,
            'title' => self::TITLE_EDIT
        ]);
    }

    public function update(Request $request, $id)
    {
        $keuangan = Keuangan::findOrFail($id);
        $validator = Validator::make($request->all(), $keuangan->rules(), [], $keuangan->attributes());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $tanggalTransaksi = \Carbon\Carbon::parse($request->tanggal_transaksi)->format('Y-m-d H:i:s');

        $dataToUpdate = [
            'jenis' => $request->jenis,
            'tanggal_transaksi' => $tanggalTransaksi,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
        ];

        $hasChanges = false;

        foreach ($dataToUpdate as $key => $value) {
            if ($keuangan->$key != $value) {
                $hasChanges = true;
                echo $key;
                break;
            }
        }

        // Cek jika ada file baru di request
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $hasChanges = true;
            $folderPath = public_path('keuangan');

            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }

            if ($keuangan->file && file_exists(public_path($keuangan->file))) {
                unlink(public_path($keuangan->file));
            }

            $file = $request->file('file');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move($folderPath, $fileName);

            $dataToUpdate['file'] = 'keuangan/' . $fileName;
        }

        if (!$hasChanges) {
            return redirect()->back()->with(['info' => 'Tidak ada data yang diubah.']);
        }

        $keuangan->update($dataToUpdate);

        return redirect()->route(session()->get('role') . '.keuangan.index')
            ->with(['success' => 'Keuangan berhasil diupdate.']);
    }

    public function verifikasi(Request $request)
    {
        $keuangan = Keuangan::find($request->keuangan_id);

        if ($keuangan) {
            $keuangan->verifikasi = '1';
            $keuangan->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 400);
    }

    public function destroy($id)
    {
        $keuangan = Keuangan::findOrFail($id);
        if ($keuangan->file && file_exists(public_path($keuangan->file))) {
            unlink(public_path($keuangan->file));
        }

        $keuangan->delete();

        return redirect()->route(session()->get('role') . '.keuangan.index')
            ->with(['success' => 'Keuangan berhasil dihapus.']);
    }

    public function donasi(Request $request)
    {
        $folderPath = public_path('keuangan');

        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        $file = $request->file('bukti');
        $fileName = time() . '-' . $file->getClientOriginalName();
        $file->move($folderPath, $fileName);

        $donatur = [
            'nama_donatur' => $request->nama_donatur,
            'email' => $request->email_donatur,
            'sudah_diberi_notifikasi' => ($request->email_donatur === "anonymous") ? 1 : 0,
        ];
        Donatur::create($donatur);

        $tanggalTransaksi = Carbon::now('Asia/Jakarta');
        $jumlahFormatted = number_format($request->jumlah_donasi, 0, ',', ',');
        $keuangan = [
            'jenis' => 'masuk',
            'tanggal_transaksi' => $tanggalTransaksi,
            'jumlah' => $request->jumlah_donasi,
            'file' => 'keuangan/' . $fileName,
            'keterangan' => "Donasi dari " . $request->nama_donatur . " sejumlah Rp. " . $jumlahFormatted . " pada tanggal" . $tanggalTransaksi->locale('id')->isoFormat('D MMMM YYYY') . " jam " . $tanggalTransaksi->locale('id')->isoFormat('HH:mm') . " WIB",
            'verifikasi' => '0',
            'ditambahkan_oleh' => null,
        ];

        Keuangan::create($keuangan);

        return response()->json([
            'success' => true,
            'message' => 'Donasi berhasil dikirim.',
            'donatur' => $donatur,
            'keuangan' => $keuangan
        ]);
    }
}
