@extends('layouts.admin')

@section('title', 'Laporan Keuangan')
@section('page_title', 'Laporan Keuangan')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

    .font-display { font-family: 'Space Grotesk', system-ui, sans-serif; }
    .font-body    { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; }
</style>

<div class="font-body">

    {{-- STATISTIK CARD --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-6">

        <div class="relative bg-white p-5 rounded-2xl border border-slate-100 shadow-xs overflow-hidden">
            <span class="absolute left-0 top-0 h-full w-1 bg-emerald-500"></span>
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold text-slate-400 uppercase">Total Pendapatan</span>
                <div class="p-2 bg-emerald-50 text-emerald-500 rounded-xl"><i data-lucide="trending-up" class="w-4 h-4"></i></div>
            </div>
            <h3 class="font-display text-xl font-bold text-slate-800">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
            <span class="text-[11px] font-semibold text-emerald-600 block mt-1">Uang masuk lunas</span>
        </div>

        <div class="relative bg-white p-5 rounded-2xl border border-slate-100 shadow-xs overflow-hidden">
            <span class="absolute left-0 top-0 h-full w-1 bg-[#1E88E5]"></span>
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold text-slate-400 uppercase">Total Target</span>
                <div class="p-2 bg-blue-50 text-[#1E88E5] rounded-xl"><i data-lucide="dollar-sign" class="w-4 h-4"></i></div>
            </div>
            <h3 class="font-display text-xl font-bold text-slate-800">Rp {{ number_format($totalTagihan, 0, ',', '.') }}</h3>
            <span class="text-[11px] font-semibold text-slate-400 block mt-1">Akumulasi seluruh tagihan</span>
        </div>

        <div class="relative bg-white p-5 rounded-2xl border border-slate-100 shadow-xs overflow-hidden">
            <span class="absolute left-0 top-0 h-full w-1 bg-teal-500"></span>
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold text-slate-400 uppercase">Transaksi Lunas</span>
                <div class="p-2 bg-emerald-50 text-emerald-600 rounded-xl"><i data-lucide="check-circle" class="w-4 h-4"></i></div>
            </div>
            <h3 class="font-display text-xl font-bold text-slate-800">{{ $siswaLunas }} <span class="text-xs font-medium text-slate-400">Transaksi</span></h3>
        </div>

        <div class="relative bg-white p-5 rounded-2xl border border-slate-100 shadow-xs overflow-hidden">
            <span class="absolute left-0 top-0 h-full w-1 bg-rose-400"></span>
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold text-slate-400 uppercase">Belum Bayar</span>
                <div class="p-2 bg-rose-50 text-rose-500 rounded-xl"><i data-lucide="alert-circle" class="w-4 h-4"></i></div>
            </div>
            <h3 class="font-display text-xl font-bold text-slate-800">{{ $siswaBelumLunas }} <span class="text-xs font-medium text-slate-400">Transaksi</span></h3>
        </div>

    </div>

    {{-- FILTER & AKSI — satu grup, konsisten --}}
    <div class="bg-white p-5 rounded-2xl border border-slate-100 mb-6 print:hidden">

        <div class="flex flex-col lg:flex-row gap-4 lg:items-end lg:justify-between">

            <form action="/admin/laporan" method="GET" class="flex flex-wrap gap-3 items-end">
                <div>
                    <label class="text-xs font-bold text-slate-400 block mb-1">DARI TANGGAL</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}"
                        class="p-2 border border-slate-200 rounded-xl w-40 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-100 focus:border-emerald-300">
                </div>
                <div>
                    <label class="text-xs font-bold text-slate-400 block mb-1">SAMPAI TANGGAL</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}"
                        class="p-2 border border-slate-200 rounded-xl w-40 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-100 focus:border-emerald-300">
                </div>
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2 rounded-xl font-semibold text-sm transition">
                    Filter
                </button>
                <a href="/admin/laporan" class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-5 py-2 rounded-xl font-semibold text-sm transition">
                    Reset
                </a>
            </form>

            <div class="flex gap-3">
                <button onclick="window.print()"
                    class="inline-flex items-center gap-2 bg-slate-800 hover:bg-slate-900 text-white px-5 py-2 rounded-xl font-semibold text-sm transition">
                    <i data-lucide="printer" class="w-4 h-4"></i>
                    <span>Cetak Laporan</span>
                </button>

                <a href="/admin/laporan/export?start_date={{ request('start_date') }}&end_date={{ request('end_date') }}"
                    target="_blank"
                    class="inline-flex items-center gap-2 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 px-5 py-2 rounded-xl font-semibold text-sm border border-emerald-100 transition">
                    <i data-lucide="download" class="w-4 h-4"></i>
                    <span>Unduh PDF</span>
                </a>
            </div>

        </div>

    </div>

    {{-- TABEL DATA --}}
    <div class="relative bg-white rounded-2xl border border-slate-100 shadow-xs overflow-hidden">

        <span class="absolute left-0 top-0 h-1 w-full bg-gradient-to-r from-emerald-500 via-teal-500 to-emerald-500"></span>

        <div class="p-5 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
            <h4 class="font-display font-bold text-slate-800 text-sm flex items-center gap-2">
                <i data-lucide="history" class="w-4 h-4 text-slate-400"></i>
                <span>Riwayat Transaksi</span>
            </h4>
            <span class="text-xs font-semibold text-slate-400">{{ $riwayatTransaksi->count() }} data</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                        <th class="py-4 px-6">Nama Siswa</th>
                        <th class="py-4 px-6">Jenis Tagihan</th>
                        <th class="py-4 px-6">Nominal</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="text-sm font-medium text-slate-600 divide-y divide-slate-100">

                    @forelse($riwayatTransaksi as $tx)

                    @php
                        $nama  = $tx->siswa->nama ?? '-';
                        $palet = ['bg-blue-50 text-[#1E88E5]','bg-emerald-50 text-emerald-600','bg-amber-50 text-amber-600','bg-rose-50 text-rose-500','bg-violet-50 text-violet-600'];
                        $warna = $palet[crc32($nama) % count($palet)];

                        $statusStyle = match($tx->status_tagihan) {
                            'Lunas'                => ['bg-emerald-50 text-emerald-700 border-emerald-100', 'bg-emerald-500'],
                            'Ditolak'              => ['bg-rose-50 text-rose-700 border-rose-100', 'bg-rose-500'],
                            'Menunggu Verifikasi'  => ['bg-amber-50 text-amber-700 border-amber-100', 'bg-amber-500'],
                            default                => ['bg-slate-50 text-slate-600 border-slate-100', 'bg-slate-400'],
                        };
                    @endphp

                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full {{ $warna }} font-display font-bold text-[10px] flex items-center justify-center shrink-0">
                                    {{ strtoupper(substr($nama,0,2)) }}
                                </div>
                                <span class="text-slate-900 font-semibold">{{ $nama }}</span>
                            </div>
                        </td>
                        <td class="py-4 px-6">{{ $tx->nama_iuran }}</td>
                        <td class="py-4 px-6 font-display text-slate-900 font-semibold">Rp {{ number_format($tx->jumlah_bayar, 0, ',', '.') }}</td>
                        <td class="py-4 px-6">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-semibold rounded-full border {{ $statusStyle[0] }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $statusStyle[1] }}"></span>
                                {{ $tx->status_tagihan }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-slate-500">
                            {{ \Carbon\Carbon::parse($tx->tagihan->tanggal_tagihan ?? now())->format('d M Y') }}
                        </td>
                    </tr>

                    @empty

                    <tr>
                        <td colspan="5" class="py-14 text-center text-slate-400">
                            <div class="flex flex-col items-center justify-center gap-2">
                                <i data-lucide="inbox" class="w-8 h-8 text-slate-300"></i>
                                <span class="font-medium">Belum ada transaksi.</span>
                            </div>
                        </td>
                    </tr>

                    @endforelse

                </tbody>
            </table>
        </div>

    </div>

    {{-- CSS PRINT --}}
    <style media="print">
        @page { size: landscape; }
        .print\:hidden { display: none !important; }
    </style>

</div>

<script>
    if (window.lucide) lucide.createIcons();
</script>

@endsection