<?php

namespace App\Http\Controllers;

use App\Models\RKAT;
use Illuminate\Http\Request;

class RKATController extends Controller
{
    private const TITLE_INDEX = 'Daftar RKAT';
    private const TITLE_EDIT = 'Edit RKAT';

    public function index()
    {
        $data = RKAT::all();
        return view('menu.rkat.index', [
            'data' => $data,
            'title' => self::TITLE_INDEX
        ]);
    }

    public function edit()
    {
        $rkat =  RKAT::all();
        return view('menu.rkat.edit', [
            'title' => self::TITLE_EDIT,
            'rkat' => $rkat
        ]);
    }

    public function update(Request $request)
    {
        $rkatIDTerdahulu = RKAT::pluck('rkat_id')->toArray();

        foreach ($request->nama_rkat as $index => $nama_rkat) {
            $rkatId = $request->rkat_id[$index];

            if ($rkatId) {
                $rkat = RKAT::findOrFail($rkatId);
                $rkat->nama_rkat = $nama_rkat;
                $rkat->alokasi_persen = $request->alokasi_persen[$index];
                $rkat->save();

                if (($key = array_search($rkatId, $rkatIDTerdahulu)) !== false) {
                    unset($rkatIDTerdahulu[$key]);
                }
            } else {
                RKAT::create([
                    'nama_rkat' => $nama_rkat,
                    'alokasi_persen' => $request->alokasi_persen[$index],
                ]);
            }
        }

        if (!empty($rkatIDTerdahulu)) {
            RKAT::destroy($rkatIDTerdahulu);
        }

        return redirect()->route(session()->get('role') . '.rkat.index')->with('success', 'RKAT berhasil diperbarui.');
    }
}
