<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Siswa;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Login Admin
     */
    public function loginAdmin(Request $request)
    {
        $request->validate([
            'username' => 'required|email',
            'password' => 'required',
        ]);

        $admin = User::where('email', $request->username)->first();

        if (!$admin) {
            return back()->with('gagal', 'Username atau Password Admin salah!');
        }

        if (!Hash::check($request->password, $admin->password)) {
            return back()->with('gagal', 'Username atau Password Admin salah!');
        }

        session([
            'admin_login' => true,
            'admin_id'    => $admin->id,
            'admin_name'  => $admin->name,
        ]);

        return redirect('/admin/dashboard');
    }

    /**
     * Login Orang Tua
     */
    public function loginOrtu(Request $request)
    {
        $request->validate([
            'nis'      => 'required',
            'password' => 'required',
        ]);

        $siswa = Siswa::where('nis', $request->nis)->first();

        if (!$siswa || !Hash::check($request->password, $siswa->password)) {
            return back()->with('gagal', 'NIS atau Password salah!');
        }

        session([
            'ortu_login' => true,
            'siswa_id'   => $siswa->id,
            'nis'        => $siswa->nis,
        ]);

        return redirect('/ortu/dashboard');
    }

    /**
     * Logout Admin
     */
    public function logoutAdmin()
    {
        session()->forget([
            'admin_login',
            'admin_id',
            'admin_name',
        ]);

        return redirect('/login');
    }

    /**
     * Logout Orang Tua
     */
    public function logoutOrtu()
    {
        session()->forget([
            'ortu_login',
            'siswa_id',
            'nis',
        ]);

        return redirect('/login-ortu');
    }
}