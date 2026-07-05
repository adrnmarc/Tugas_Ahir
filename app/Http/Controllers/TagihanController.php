<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tagihan;
use App\Models\Siswa;

class TagihanController extends Controller
{
    // 1. TAMPILKAN HALAMAN UTAMA
    public function index()
    {
        $tagihans = Tagihan::with('siswa')->latest()->get();
        // Mengambil daftar siswa untuk dropdown select modal
        $daftarSiswa = Siswa::orderBy('nama', 'asc')->get();

        return view('admin.tagihan', compact('tagihans', 'daftarSiswa'));
    }

    // 2. SIMPAN TAGIHAN BARU (Validasi ketat menolak string pada NIS)
    public function store(Request $request)
    {
        $request->validate([
            // Validasi: Harus berupa nomor angka (integer) dan harus ada di kolom nis tabel siswas
            'siswa_id'        => 'required|integer|exists:siswas,nis', 
            'jenis_tagihan'   => 'required|string',
            'nominal'         => 'required|integer', // Memastikan input nominal tidak disisipi string huruf
            'tanggal_tagihan' => 'required|date',
        ], [
            'siswa_id.required' => 'Anak didik wajib dipilih!',
            'siswa_id.integer'  => 'Format NIS harus berupa nomor angka bulat.',
            'siswa_id.exists'   => 'Nomor NIS siswa tidak terdaftar di sistem.',
            'nominal.integer'   => 'Nominal tagihan harus berupa angka bulat, tidak boleh string huruf.',
        ]);

        // Simpan menggunakan struktur kolom asli database Anda
        Tagihan::create([
            'nis'          => $request->siswa_id, // Di form blade Anda, name-nya 'siswa_id' tapi isinya dioper ke kolom 'nis'
            'nama_tagihan' => $request->jenis_tagihan,
            'jatuh_tempo'  => $request->tanggal_tagihan,
        ]);

        return redirect()->back()->with('sukses', 'Tagihan baru berhasil disimpan!');
    }

    // 3. EDIT DATA TAGIHAN
    public function update(Request $request, $id_tagihan)
    {
        $request->validate([
            'siswa_id'        => 'required|integer|exists:siswas,nis',
            'jenis_tagihan'   => 'required|string',
            'nominal'         => 'required|integer',
            'tanggal_tagihan' => 'required|date',
        ], [
            'siswa_id.exists' => 'Nomor NIS siswa tidak ditemukan.',
            'nominal.integer' => 'Nominal harus berupa angka.',
        ]);

        $tagihan = Tagihan::findOrFail($id_tagihan);
        
        $tagihan->update([
            'nis'          => $request->siswa_id,
            'nama_tagihan' => $request->jenis_tagihan,
            'jatuh_tempo'  => $request->tanggal_tagihan,
        ]);

        return redirect()->back()->with('sukses', 'Data tagihan berhasil diperbarui!');
    }

    // 4. HAPUS DATA TAGIHAN
    public function destroy($id_tagihan)
    {
        $tagihan = Tagihan::findOrFail($id_tagihan);
        $tagihan->delete();

        return redirect()->back()->with('sukses', 'Tagihan berhasil dihapus!');
    }
}