<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function index()
    {
        $daftarSiswa = Siswa::latest()->get();
        return view('admin.siswa', compact('daftarSiswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|numeric|unique:siswas,nis',
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string',
            'wali' => 'required|string|max:255',
            'kontak' => 'required|string|max:20',
            'nama_orangtua' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',

            // Password
            'password' => 'required|min:6|confirmed',

        ], [
            'nis.required' => 'Nomor Induk Siswa (NIS) wajib diisi!',
            'nis.numeric' => 'Input Gagal! NIS harus berupa angka penuh.',
            'nis.unique' => 'Nomor NIS ini sudah terdaftar.',

            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sama.',
        ]);

        Siswa::create([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'wali' => $request->wali,
            'kontak' => $request->kontak,
            'nama_orangtua' => $request->nama_orangtua,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,

            'password' => Hash::make($request->password),
        ]);

        return redirect('/admin/siswa')
            ->with('sukses', 'Data siswa berhasil dibuat!');
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $request->validate([
            'nis' => 'required|numeric|unique:siswas,nis,' . $id,
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string',
            'wali' => 'required|string|max:255',
            'kontak' => 'required|string|max:20',
            'nama_orangtua' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',

            // Password boleh kosong saat edit
            'password' => 'nullable|min:6|confirmed',

        ], [
            'nis.required' => 'Nomor Induk Siswa (NIS) wajib diisi!',
            'nis.numeric' => 'Input Gagal! NIS harus berupa angka penuh.',
            'nis.unique' => 'Nomor NIS ini sudah digunakan siswa lain.',

            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sama.',
        ]);

        $data = [
            'nis' => $request->nis,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'wali' => $request->wali,
            'kontak' => $request->kontak,
            'nama_orangtua' => $request->nama_orangtua,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
        ];

        // Jika password diisi, update password
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $siswa->update($data);

        return redirect('/admin/siswa')
            ->with('sukses', 'Data siswa berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return redirect('/admin/siswa')
            ->with('sukses', 'Data siswa berhasil dihapus!');
    }
}