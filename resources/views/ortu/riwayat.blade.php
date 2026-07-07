@extends('layouts.ortu')
@section('header', 'Riwayat Pembayaran')

@section('content')
<div class="p-8" style="background-color:#F7F3EA;">

    {{-- Cards Ringkasan, gaya sama dengan kartu statistik di dashboard --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        {{-- Total Tagihan --}}
        <div class="relative p-6 bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
            <span class="absolute top-0 left-6 w-8 h-1.5 rounded-b-full" style="background-color:#60A5FA;"></span>
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Tagihan</p>
                    <p class="text-2xl font-bold text-slate-800 mt-1">Rp {{ number_format($totalTagihan, 0, ',', '.') }}</p>
                </div>
                <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0" style="background-color:#EFF6FF;">
                    <svg class="w-4.5 h-4.5" style="width:18px;height:18px;color:#60A5FA;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
            </div>
        </div>

        {{-- Sudah Dibayar --}}
        <div class="relative p-6 bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
            <span class="absolute top-0 left-6 w-8 h-1.5 rounded-b-full" style="background-color:#34D399;"></span>
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Sudah Dibayar</p>
                    <p class="text-2xl font-bold text-emerald-600 mt-1">Rp {{ number_format($sudahDibayar, 0, ',', '.') }}</p>
                </div>
                <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0" style="background-color:#ECFDF5;">
                    <svg class="w-4.5 h-4.5" style="width:18px;height:18px;color:#34D399;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
            </div>
        </div>

        {{-- Belum Dibayar --}}
        <div class="relative p-6 bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
            <span class="absolute top-0 left-6 w-8 h-1.5 rounded-b-full" style="background-color:#FBBF24;"></span>
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Belum Dibayar</p>
                    <p class="text-2xl font-bold text-amber-600 mt-1">Rp {{ number_format($belumDibayar, 0, ',', '.') }}</p>
                </div>
                <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0" style="background-color:#FFFBEB;">
                    <svg class="w-4.5 h-4.5" style="width:18px;height:18px;color:#FBBF24;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel Riwayat --}}
    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100">
            <h2 class="font-bold text-slate-800">Semua Transaksi</h2>
        </div>
        <table class="w-full">
            <thead>
                <tr class="bg-slate-50/60">
                    <th class="px-6 py-3 text-[11px] font-bold text-slate-400 uppercase tracking-wider text-left">Tanggal</th>
                    <th class="px-6 py-3 text-[11px] font-bold text-slate-400 uppercase tracking-wider text-left">Jenis Tagihan</th>
                    <th class="px-6 py-3 text-[11px] font-bold text-slate-400 uppercase tracking-wider text-left">Nominal</th>
                    <th class="px-6 py-3 text-[11px] font-bold text-slate-400 uppercase tracking-wider text-center">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
            @forelse($riwayat as $item)
            <tr class="hover:bg-slate-50/70 transition-colors">
                <td class="px-6 py-4 text-sm text-slate-500 whitespace-nowrap">{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: {{ $item->status_tagihan == 'Lunas' ? '#ECFDF5' : '#FFFBEB' }};">
                            <svg class="w-4 h-4" style="color: {{ $item->status_tagihan == 'Lunas' ? '#34D399' : '#FBBF24' }};" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <span class="text-sm font-semibold text-slate-800">{{ $item->nama_iuran }}</span>
                    </div>
                </td>
                <td class="px-6 py-4 text-sm font-medium text-slate-600 whitespace-nowrap">Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}</td>
                <td class="px-6 py-4 text-center">
                    @if($item->status_tagihan == 'Lunas')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-[10px] font-bold text-emerald-700 bg-emerald-100 rounded-full">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> LUNAS
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-[10px] font-bold text-amber-700 bg-amber-100 rounded-full">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> VERIFIKASI
                        </span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-6 py-16 text-center">
                    <div class="w-12 h-12 mx-auto mb-3 rounded-2xl flex items-center justify-center" style="background-color:#EFF6FF;">
                        <svg class="w-6 h-6" style="color:#60A5FA;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <p class="font-semibold text-slate-600 mb-1">Belum ada riwayat</p>
                    <p class="text-sm text-slate-400">Transaksi yang sudah dilakukan akan muncul di sini.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
        </table>
    </div>
</div>
@endsection