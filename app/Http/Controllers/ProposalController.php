<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProposalController extends Controller
{
    private const TITLE_INDEX = 'Daftar Proposal';
    private const TITLE_CREATE = 'Tambah Proposal';
    private const TITLE_EDIT = 'Edit Proposal';

    public function __construct() {}

    public function index()
    {
        $data = Proposal::all();
        return view('menu.proposal.index', [
            'data' => $data,
            'title' => self::TITLE_INDEX
        ]);
    }

    public function create()
    {
        return view('menu.proposal.create', [
            'title' => self::TITLE_CREATE
        ]);
    }

    public function store(Request $request)
    {
        $this->validateStoreOrUpdate($request);

        Proposal::create([
            'role' => $request->role,
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route(session()->get('role') . '.proposal.index')->with('success', 'Proposal berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $proposal = Proposal::findOrFail($id);

        return view('menu.proposal.edit', [
            'proposal' => $proposal,
            'title' => self::TITLE_EDIT
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validateStoreOrUpdate($request, $id);

        $proposal = Proposal::findOrFail($id);

        $proposal->role = $request->role;
        $proposal->nama = $request->nama;
        $proposal->email = $request->email;
        $proposal->no_hp = $request->no_hp;
        $proposal->password = $request->password ? Hash::make($request->password) : $proposal->password;

        // Cek apakah ada perubahan
        if ($proposal->isDirty()) {
            $proposal->save();
            return redirect()->route(session()->get('role') . '.proposal.index')->with('success', 'Proposal berhasil diedit.');
        }

        return redirect()->route(session()->get('role') . '.proposal.index')->with('info', 'Tidak ada perubahan yang dilakukan.');
    }


    public function destroy($id)
    {
        Proposal::findOrFail($id)->delete();
        return redirect()->route(session()->get('role') . '.proposal.index')->with('success', 'Proposal berhasil dihapus.');
    }

    private function validateStoreOrUpdate(Request $request, $id = null)
    {
        $rules = [
            'role' => 'required',
            'nama' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:user,email' . ($id ? ",$id,user_id" : ''),
            'no_hp' => 'nullable|numeric',
            'password' => 'nullable|string|min:8',
        ];

        $customAttributes = [
            'role' => 'Role',
            'nama' => 'Nama Lengkap',
            'email' => 'Email',
            'no_hp' => 'No. HP',
            'password' => 'Password',
        ];

        return $request->validate($rules, [], $customAttributes);
    }
}
