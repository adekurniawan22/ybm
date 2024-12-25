<?php

namespace App\Http\Controllers;

use App\Models\{AcaraKegiatan, Donatur, Keuangan};
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AcaraKegiatanController extends Controller
{
    private const TITLE_INDEX = 'List acara dan kegiatan';
    private const TITLE_CREATE = 'Tambah acara dan kegiatan';
    private const TITLE_EDIT = 'Edit acara dan kegiatan';

    public function index()
    {
        $data = AcaraKegiatan::with('keuangan', 'ditambahkanOleh')->get();
        return view('menu.acara_kegiatan.index', [
            'data' => $data,
            'title' => self::TITLE_INDEX
        ]);
    }

    public function create()
    {
        return view('menu.acara_kegiatan.create', [
            'title' => self::TITLE_CREATE,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            (new AcaraKegiatan)->rules(isset($request->butuh_dana)),
            [],
            (new AcaraKegiatan)->attributes()
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (isset($request->butuh_dana)) {
            $keuangan = Keuangan::create([
                'jenis' => 'keluar',
                'tanggal_transaksi' => Carbon::now('Asia/Jakarta'),
                'jumlah' => $request->jumlah_dana,
                'file' => null,
                'keterangan' => $request->keterangan,
                'verifikasi' => '0',
                'ditambahkan_oleh' => session()->get('user_id'),
            ]);

            $data_keuangan = [
                'nama_acara' => $request->nama_acara,
                'tanggal' => $request->tanggal,
                'keterangan' => $request->keterangan,
                'butuh_dana' => '1',
                'keuangan_id' => $keuangan->keuangan_id,
                'jumlah_dana' => $request->jumlah_dana,
                'ditambahkan_oleh' => session()->get('user_id'),
            ];
        } else {
            $data_keuangan = [
                'nama_acara' => $request->nama_acara,
                'tanggal' => $request->tanggal,
                'keterangan' => $request->keterangan,
                'ditambahkan_oleh' => session()->get('user_id'),
            ];
        }

        AcaraKegiatan::create($data_keuangan);

        return redirect()->route(session()->get('role') . '.acara_kegiatan.index')
            ->with(['success' => 'Acara/Kegiatan berhasil dibuat.']);
    }

    public function edit($id)
    {
        $data = AcaraKegiatan::with('keuangan')->findOrFail($id);
        return view('menu.acara_kegiatan.edit', [
            'data' => $data,
            'title' => self::TITLE_EDIT
        ]);
    }

    public function update(Request $request, $id)
    {
        $acara_kegiatan = AcaraKegiatan::with('keuangan')->findOrFail($id);
        $validator = Validator::make(
            $request->all(),
            (new AcaraKegiatan)->rules(isset($request->butuh_dana)),
            [],
            (new AcaraKegiatan)->attributes()
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $originalData = [
            'nama_acara' => $acara_kegiatan->nama_acara,
            'tanggal' =>  Carbon::parse($acara_kegiatan->tanggal)->format('Y-m-d'),
            'butuh_dana' => $acara_kegiatan->butuh_dana,
            'jumlah_dana' => $acara_kegiatan->jumlah_dana,
            'keterangan' => $acara_kegiatan->keterangan,
        ];

        $updatedData = [
            'nama_acara' => $request->nama_acara,
            'tanggal' => $request->tanggal,
            'butuh_dana' => isset($request->butuh_dana) ? '1' : '0',
            'jumlah_dana' => $request->jumlah_dana,
            'keterangan' => $request->keterangan,
        ];

        // dd($originalData, $updatedData);

        if (array_diff_assoc($updatedData, $originalData) === []) {
            return redirect()->back()->with(['info' => 'Tidak ada data yang diubah.']);
        }

        $data_acara_kegiatan = [
            'nama_acara' => $request->nama_acara,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'butuh_dana' => isset($request->butuh_dana) ? '1' : '0',
            'jumlah_dana' => $request->jumlah_dana,
            'ditambahkan_oleh' => session()->get('user_id'),
            'keuangan_id' => null,
        ];

        if (isset($request->butuh_dana)) {
            if ($acara_kegiatan->keuangan_id === null) {
                $keuangan = Keuangan::create([
                    'jenis' => 'keluar',
                    'tanggal_transaksi' => Carbon::now('Asia/Jakarta'),
                    'jumlah' => $request->jumlah_dana,
                    'file' => null,
                    'keterangan' => $request->keterangan,
                    'verifikasi' => '0',
                    'ditambahkan_oleh' => session()->get('user_id'),
                ]);
                $data_acara_kegiatan['keuangan_id'] = $keuangan->keuangan_id;
            } else {
                $acara_kegiatan->keuangan()->update([
                    'jumlah' => $request->jumlah_dana,
                    'keterangan' => $request->keterangan,
                ]);
                $data_acara_kegiatan['keuangan_id'] = $acara_kegiatan->keuangan_id;
            }
        } elseif ($acara_kegiatan->keuangan_id !== null) {
            $keuangan = Keuangan::findOrFail($acara_kegiatan->keuangan_id);
            $keuangan->delete();
        }
        $acara_kegiatan->update($data_acara_kegiatan);


        return redirect()->route(session()->get('role') . '.acara_kegiatan.index')
            ->with(['success' => 'Acara/Kegiatan berhasil diupdate.']);
    }


    public function destroy($id)
    {
        $acara_kegiatan = AcaraKegiatan::findOrFail($id);
        $acara_kegiatan->delete();

        return redirect()->route(session()->get('role') . '.acara_kegiatan.index')
            ->with(['success' => 'Acara/Kegiatan berhasil dihapus.']);
    }
}
