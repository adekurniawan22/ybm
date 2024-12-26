<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function landingPage()
    {
        return view('landingPage');
    }

    public function showLogin()
    {
        if (Session::has('user_id')) {
            $user = User::find(Session::get('user_id'));

            if ($user) {
                return $this->redirectBasedOnRole($user->role);
            }
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $customMessages = [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ];

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], $customMessages);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return redirect()->back()
                ->withInput($request->only('email', 'password'));
        }

        // Set session untuk user dan role
        Session::put('user_id', $user->user_id);
        Session::put('role', $user->role);

        return $this->redirectBasedOnRole($user->role);
    }


    public function logout()
    {
        // Hapus sesi yang dimasukkan saat login saja
        Session::forget('user_id');
        Session::forget('role');
        return redirect()->route('login')->with('success', 'Anda berhasil logout');
    }

    // Arahkan berdasarkan role user
    protected function redirectBasedOnRole($role)
    {
        if ($role == 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Selamat datang di menu Admin');
        } elseif ($role == 'ketua') {
            return redirect()->route('ketua.dashboard')->with('success', 'Selamat datang di menu Ketua');
        } elseif ($role == 'distribusi') {
            return redirect()->route('distribusi.dashboard')->with('success', 'Selamat datang di menu Distribusi');
        } elseif ($role == 'bendahara') {
            return redirect()->route('bendahara.dashboard')->with('success', 'Selamat datang di menu Bendahara');
        } elseif ($role == 'publikasi') {
            return redirect()->route('publikasi.dashboard')->with('success', 'Selamat datang di menu Publikasi');
        } else {
            return redirect()->back()->withErrors(['error' => 'Role tidak dikenali']);
        }
    }
}
