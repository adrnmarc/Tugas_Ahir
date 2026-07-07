@extends('layouts.ortu')
@section('header', 'Tagihan')

@section('content')
<div class="pt-8 px-8 pb-12 max-w-7xl mx-auto" style="background-color:#F7F3EA;">

    @php
        $totalAktif   = $tagihans->where('status_tagihan', '!=', 'Lunas')->sum('jumlah_bayar');
        $jumlahLunas  = $tagihans->where('status_tagihan', '=', 'Lunas')->count();
        $jumlahProses = $tagihans->where('status_tagihan', '=', 'Menunggu Verifikasi')->count();
        $jumlahBelum  = $tagihans->where('status_tagihan', '!=', 'Lunas')->where('status_tagihan', '!=', 'Menunggu Verifikasi')->count();

        // satu sumber warna untuk semua elemen (dot, garis aksen, ikon, badge) -> tidak akan pernah beda lagi
        $palet = [
            'Lunas'    => ['solid' => '#10B981', 'soft' => '#ECFDF5', 'text' => '#047857', 'badgeBg' => '#D1FAE5'],
            'Menunggu' => ['solid' => '#F59E0B', 'soft' => '#FFFBEB', 'text' => '#B45309', 'badgeBg' => '#FEF3C7'],
            'Belum'    => ['solid' => '#F43F5E', 'soft' => '#FFF1F2', 'text' => '#BE123C', 'badgeBg' => '#FFE4E6'],
        ];
    @endphp

    {{-- Card Ringkasan --}}
    <div class="rounded-3xl p-8 text-white mb-6 shadow-xl flex justify-between items-center relative overflow-hidden"
         style="background: linear-gradient(135deg, #0FA968 0%, #0B7A4E 100%);">

        <div class="absolute -right-6 -top-10 w-44 h-44 rounded-full bg-white/10"></div>
        <div class="absolute right-16 -bottom-4 w-14 h-14 opacity-20" style="clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%);background:white;"></div>

        <div class="relative z-10">
            <p class="text-emerald-50 text-xs font-semibold tracking-wide uppercase">Total Tagihan Aktif</p>
            <h1 class="text-4xl font-bold mt-1">
                Rp {{ number_format($totalAktif, 0, ',', '.') }}
            </h1>
            <p class="text-emerald-50 text-xs mt-2 opacity-90">Segera lakukan pembayaran sebelum jatuh tempo.</p>
        </div>
        <div class="bg-white/15 p-4 rounded-2xl relative z-10 backdrop-blur-sm">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
        </div>
    </div>

    {{-- Mini ringkasan status --}}
    <div class="grid grid-cols-3 gap-4 mb-10">
        <div class="bg-white rounded-2xl p-4 border border-slate-100 shadow-sm">
            <div class="flex items-center gap-2 mb-1">
                <span class="w-2 h-2 rounded-full" style="background-color:{{ $palet['Lunas']['solid'] }};"></span>
                <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide">Lunas</p>
            </div>
            <p class="text-xl font-bold text-slate-800">{{ $jumlahLunas }} <span class="text-xs font-medium text-slate-400">tagihan</span></p>
        </div>
        <div class="bg-white rounded-2xl p-4 border border-slate-100 shadow-sm">
            <div class="flex items-center gap-2 mb-1">
                <span class="w-2 h-2 rounded-full" style="background-color:{{ $palet['Menunggu']['solid'] }};"></span>
                <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide">Menunggu</p>
            </div>
            <p class="text-xl font-bold text-slate-800">{{ $jumlahProses }} <span class="text-xs font-medium text-slate-400">tagihan</span></p>
        </div>
        <div class="bg-white rounded-2xl p-4 border border-slate-100 shadow-sm">
            <div class="flex items-center gap-2 mb-1">
                <span class="w-2 h-2 rounded-full" style="background-color:{{ $palet['Belum']['solid'] }};"></span>
                <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide">Belum Dibayar</p>
            </div>
            <p class="text-xl font-bold text-slate-800">{{ $jumlahBelum }} <span class="text-xs font-medium text-slate-400">tagihan</span></p>
        </div>
    </div>

    <h2 class="text-xl font-bold text-slate-800 mb-6">Rincian Tagihan</h2>

    {{-- Notifikasi Sukses --}}
    @if(session('sukses'))
        <div class="mb-6 p-4 text-sm text-emerald-800 bg-emerald-50 rounded-xl border border-emerald-100 font-semibold flex items-center gap-2">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            {{ session('sukses') }}
        </div>
    @endif

    {{-- Grid Kartu Tagihan --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($tagihans as $tagihan)
            @php
                $status = $tagihan->status_tagihan == 'Lunas' ? 'Lunas'
                    : ($tagihan->status_tagihan == 'Menunggu Verifikasi' ? 'Menunggu' : 'Belum');
                $warna = $palet[$status];

                $namaLower = strtolower($tagihan->nama_iuran);
                $jenisIkon = str_contains($namaLower, 'spp') || str_contains($namaLower, 'bulan')
                    ? 'uang'
                    : ((str_contains($namaLower, 'seragam') || str_contains($namaLower, 'buku')) ? 'buku' : 'dokumen');
            @endphp
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-between overflow-hidden transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5">
                <div class="h-1.5 w-full" style="background-color: {{ $warna['solid'] }};"></div>

                <div class="p-6 flex flex-col justify-between flex-1">
                    <div>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0" style="background-color: {{ $warna['soft'] }};">
                                @if($jenisIkon === 'uang')
                                    {{-- ikon uang kertas, valid dan bersih di ukuran kecil --}}
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="{{ $warna['solid'] }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="2" y="6" width="20" height="12" rx="2"></rect>
                                        <circle cx="12" cy="12" r="2"></circle>
                                        <path d="M6 12h.01M18 12h.01"></path>
                                    </svg>
                                @elseif($jenisIkon === 'buku')
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="{{ $warna['solid'] }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M2 4h6a3 3 0 0 1 3 3v13a2 2 0 0 0-2-2H2z"></path>
                                        <path d="M22 4h-6a3 3 0 0 0-3 3v13a2 2 0 0 1 2-2h7z"></path>
                                    </svg>
                                @else
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="{{ $warna['solid'] }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                        <path d="M6 3h8l5 5v11a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"></path>
                                        <path d="M9 13h6M9 17h6"></path>
                                    </svg>
                                @endif
                            </div>
                            <h3 class="font-bold text-slate-800 leading-tight">{{ $tagihan->nama_iuran }}</h3>
                        </div>

                        <div class="mb-1">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[9px] font-bold uppercase"
                                  style="background-color: {{ $warna['badgeBg'] }}; color: {{ $warna['text'] }};">
                                <span class="w-1.5 h-1.5 rounded-full" style="background-color: {{ $warna['solid'] }};"></span>
                                {{ $status === 'Lunas' ? 'Lunas' : ($status === 'Menunggu' ? 'Menunggu' : 'Belum Bayar') }}
                            </span>
                        </div>

                        <p class="text-xs text-slate-400 mt-4 mb-1">Total Tagihan</p>
                        <p class="text-lg font-bold text-slate-900 mb-6">Rp {{ number_format($tagihan->jumlah_bayar, 0, ',', '.') }}</p>
                    </div>

                    @if($status === 'Belum')
                        <a href="{{ url('ortu/bayar/' . $tagihan->id_detail) }}"
                           class="block w-full text-center text-white py-2.5 rounded-xl text-sm font-semibold transition-colors"
                           style="background-color:#0FA968;"
                           onmouseover="this.style.backgroundColor='#0B7A4E'"
                           onmouseout="this.style.backgroundColor='#0FA968'">
                           Bayar Sekarang
                        </a>
                    @else
                        <button disabled class="block w-full text-center bg-slate-100 text-slate-400 py-2.5 rounded-xl text-sm font-semibold cursor-not-allowed">
                            {{ $status === 'Lunas' ? 'Lunas' : 'Sedang Diproses' }}
                        </button>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full p-12 text-center bg-white rounded-2xl border border-dashed border-slate-200">
                <div class="w-14 h-14 mx-auto mb-4 rounded-2xl flex items-center justify-center" style="background-color:#ECFDF5;">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#0FA968" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                        <path d="M6 3h8l5 5v11a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"></path>
                        <path d="M9 13h6M9 17h6"></path>
                    </svg>
                </div>
                <p class="font-semibold text-slate-700 mb-1">Belum ada tagihan</p>
                <p class="text-sm text-slate-400">Tagihan baru akan muncul di sini begitu tersedia.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection