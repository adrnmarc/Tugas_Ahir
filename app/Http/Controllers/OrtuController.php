<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\DetailTagihan;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OrtuController extends Controller
{
    /**
     * Dashboard Orang Tua
     */
    public function dashboard()
    {
        $siswaId = session('siswa_id');

        if (!$siswaId) {
            return redirect('/login-ortu');
        }

        $siswa = Siswa::findOrFail($siswaId);

        // Riwayat pembayaran
        $riwayat = DetailTagihan::where('id_siswa', $siswaId)
            ->latest()
            ->get();

        // Statistik
        $jumlahTransaksi = $riwayat->count();

        $totalBayar = DetailTagihan::where('id_siswa', $siswaId)
            ->where('status_tagihan', 'Lunas')
            ->sum('jumlah_bayar');

        $jumlahLunas = DetailTagihan::where('id_siswa', $siswaId)
            ->where('status_tagihan', 'Lunas')
            ->count();

        $jumlahBelumLunas = DetailTagihan::where('id_siswa', $siswaId)
            ->where('status_tagihan', '!=', 'Lunas')
            ->count();

        $totalTagihan = DetailTagihan::where('id_siswa', $siswaId)
            ->sum('jumlah_bayar');

        $pengumuman = Pengumuman::latest()
            ->take(5)
            ->get();

        return view('ortu.dashboard', compact(
            'siswa',
            'riwayat',
            'pengumuman',
            'jumlahTransaksi',
            'totalBayar',
            'jumlahLunas',
            'jumlahBelumLunas',
            'totalTagihan'
        ));
    }

    /**
     * Halaman Tagihan
     */
    public function tagihan()
    {
        $siswaId = session('siswa_id');

        if (!$siswaId) {
            return redirect('/login-ortu');
        }

        $tagihans = DetailTagihan::where('id_siswa', $siswaId)
            ->latest()
            ->get();

        return view('ortu.tagihan', compact('tagihans'));
    }

    /**
     * Form Upload Bukti Pembayaran
     */
    public function formBayar($id)
    {
        $tagihan = DetailTagihan::findOrFail($id);

        return view('ortu.bayar', compact('tagihan'));
    }

    /**
     * Upload Bukti Pembayaran
     */
    public function prosesBayar(Request $request, $id)
    {
        $request->validate([
            'bukti' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $tagihan = DetailTagihan::where('id_detail', $id)->firstOrFail();

        $path = $request->file('bukti')->store('bukti_bayar', 'public');

        $tagihan->update([
            'bukti_bayar' => $path,
            'status_tagihan' => 'Menunggu Verifikasi'
        ]);

        return redirect('/ortu/tagihan')
            ->with('sukses', 'Bukti pembayaran berhasil dikirim.');
    }

    /**
     * Pengumuman
     */
    public function pengumuman()
    {
        $pengumuman = Pengumuman::latest()->get();

        return view('ortu.pengumuman', compact('pengumuman'));
    }

    /**
     * Form Ubah Password
     */
    public function formPassword()
    {
        $siswa = Siswa::findOrFail(session('siswa_id'));

        return view('ortu.password', compact('siswa'));
    }

    /**
     * Proses Ubah Password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password' => 'required|min:6|confirmed',
        ], [
            'password.required' => 'Password baru wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sama.',
        ]);

        $siswa = Siswa::findOrFail(session('siswa_id'));

        if (!Hash::check($request->password_lama, $siswa->password)) {
            return back()->with('gagal', 'Password lama salah.');
        }

        $siswa->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('sukses', 'Password berhasil diubah.');
    }
}