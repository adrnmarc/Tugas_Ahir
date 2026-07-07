<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function loginAdmin(Request $request)
{
    $request->validate(['username' => 'required', 'password' => 'required']);

    if (Auth::attempt(['email' => $request->username, 'password' => $request->password])) {
        session(['role' => 'admin']);
        return redirect('/admin/dashboard');
    }

    return back()->with('gagal', 'Login Admin gagal!');
}

public function loginOrtu(Request $request)
{
    $request->validate([
        'nis' => 'required',
        'password' => 'required'
    ]);

    $siswa = Siswa::where('nis', $request->nis)->first();

    if (!$siswa) {
        return back()->with('gagal', 'NIS atau Password salah!');
    }

    if (!Hash::check($request->password, $siswa->password)) {
        return back()->with('gagal', 'NIS atau Password salah!');
    }

    session([
        'is_logged_in' => true,
        'role' => 'orang_tua',
        'siswa_id' => $siswa->id,
        'nis' => $siswa->nis,
    ]);

    return redirect('/ortu/dashboard');
}

    public function logout(Request $request)
    {
        session()->flush();
        Auth::logout();     
        
        return redirect('/'); 
    }
}