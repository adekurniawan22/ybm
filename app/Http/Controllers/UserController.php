<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private const TITLE_INDEX = 'List user';
    private const TITLE_CREATE = 'Tambah user';
    private const TITLE_EDIT = 'Edit user';

    public function index()
    {
        $data = User::all();
        return view('menu.user.index', [
            'data' => $data,
            'title' => self::TITLE_INDEX
        ]);
    }

    public function create()
    {
        return view('menu.user.create', [
            'title' => self::TITLE_CREATE
        ]);
    }

    public function store(Request $request)
    {
        // Validasi menggunakan model User
        $validator = Validator::make($request->all(), (new User)->rules(false), [], (new User)->attributes());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Simpan data user baru
        User::create([
            'role' => $request->role,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route(session()->get('role') . '.user.index')
            ->with(['success' => 'User berhasil dibuat.']);
    }

    public function edit($id)
    {
        $data = User::findOrFail($id);
        return view('menu.user.edit', [
            'data' => $data,
            'title' => self::TITLE_EDIT
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi menggunakan instance model
        $validator = Validator::make($request->all(), $user->rules(true), [], $user->attributes());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Cek apakah ada perubahan data
        $originalData = $user->getOriginal();
        $updatedData = $request->only(['role', 'nama', 'email', 'no_hp']);

        if ($request->filled('password')) {
            $updatedData['password'] = Hash::make($request->password);
        }

        if (array_diff_assoc($updatedData, $originalData) === []) {
            return redirect()->back()->with(['info' => 'Tidak ada data yang diubah.']);
        }

        // Update data user
        $user->fill($updatedData);
        $user->save();

        return redirect()->route(session()->get('role') . '.user.index')
            ->with(['success' => 'User berhasil diupdate.', 'title' => 'User']);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route(session()->get('role') . '.user.index')
            ->with(['success' => 'User berhasil dihapus.']);
    }
}
