@extends('layouts.admin')

@section('title', 'Verifikasi Pembayaran TK Mutiara')
@section('page_title', 'Verifikasi Pembayaran')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

    .font-display { font-family: 'Space Grotesk', system-ui, sans-serif; }
    .font-body    { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; }
</style>

<div class="font-body">

    <p class="text-xs text-slate-400 -mt-5 mb-6">Sistem Informasi Pembayaran Keuangan Sekolah</p>

    @if(session('sukses'))
        <div class="mb-4 p-4 text-sm text-emerald-800 bg-emerald-50 rounded-xl border border-emerald-100 font-semibold flex items-center gap-2">
            <i data-lucide="check-circle-2" class="w-4 h-4"></i>
            <span>{{ session('sukses') }}</span>
        </div>
    @endif

    {{-- Filter Tab --}}
    <div class="flex flex-wrap gap-2 mb-6">
        @foreach(['menunggu' => 'Menunggu', 'disetujui' => 'Disetujui', 'ditolak' => 'Ditolak', 'semua' => 'Semua'] as $key => $label)
            <a href="{{ route('pembayaran.index', ['status' => $key]) }}"
               class="px-5 py-2 rounded-full text-sm font-semibold transition
               {{ (request('status') ?? 'semua') == $key ? 'bg-emerald-600 text-white shadow-sm' : 'bg-white text-slate-500 border border-slate-200 hover:bg-slate-50' }}">
               {{ $label }}
            </a>
        @endforeach
    </div>

    {{-- Tabel --}}
    <div class="relative bg-white rounded-2xl border border-slate-100 shadow-xs overflow-hidden">

        <span class="absolute left-0 top-0 h-1 w-full bg-gradient-to-r from-emerald-500 via-teal-500 to-emerald-500"></span>

        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
            <h3 class="font-display font-bold text-slate-900 text-base">Daftar Pembayaran</h3>
            <span class="text-xs font-semibold text-slate-400">{{ $pembayarans->count() }} data</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse" id="tabelVerifikasi">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                        <th class="py-4 px-6">Nama Siswa</th>
                        <th class="py-4 px-6">Kelas</th>
                        <th class="py-4 px-6">Jenis Tagihan</th>
                        <th class="py-4 px-6">Nominal</th>
                        <th class="py-4 px-6">Bukti</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm font-medium text-slate-600 divide-y divide-slate-100">

                    @forelse($pembayarans as $pembayaran)

                    @php
                        $nama  = $pembayaran->siswa->nama ?? '-';
                        $palet = ['bg-blue-50 text-[#1E88E5]','bg-emerald-50 text-emerald-600','bg-amber-50 text-amber-600','bg-rose-50 text-rose-500','bg-violet-50 text-violet-600'];
                        $warna = $palet[crc32($nama) % count($palet)];

                        $statusStyle = match($pembayaran->status_tagihan) {
                            'Lunas'                => ['bg-emerald-50 text-emerald-700 border-emerald-100', 'bg-emerald-500'],
                            'Ditolak'              => ['bg-rose-50 text-rose-700 border-rose-100', 'bg-rose-500'],
                            'Menunggu Verifikasi'  => ['bg-amber-50 text-amber-700 border-amber-100', 'bg-amber-500'],
                            default                => ['bg-slate-50 text-slate-600 border-slate-100', 'bg-slate-400'],
                        };
                    @endphp

                    <tr class="baris-verifikasi hover:bg-slate-50/50 transition-colors">

                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full {{ $warna }} font-display font-bold text-xs flex items-center justify-center shrink-0">
                                    {{ strtoupper(substr($nama,0,2)) }}
                                </div>
                                <span class="text-slate-900 font-semibold">{{ $nama }}</span>
                            </div>
                        </td>

                        <td class="py-4 px-6">
                            <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-500 text-xs font-semibold">
                                {{ $pembayaran->siswa->kelas ?? '-' }}
                            </span>
                        </td>

                        <td class="py-4 px-6">{{ $pembayaran->nama_iuran }}</td>

                        <td class="py-4 px-6 font-display text-slate-900 font-semibold">
                            Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}
                        </td>

                        <td class="py-4 px-6">
                            @if(!empty($pembayaran->bukti_bayar))
                                <button type="button"
                                    onclick="openModal('{{ asset('storage/' . $pembayaran->bukti_bayar) }}')"
                                    class="inline-flex items-center gap-1.5 text-blue-600 hover:text-blue-700 hover:underline font-bold text-xs">
                                    <i data-lucide="image" class="w-3.5 h-3.5"></i>
                                    Lihat Bukti
                                </button>
                            @else
                                <span class="text-slate-400 text-xs italic">Belum ada</span>
                            @endif
                        </td>

                        <td class="py-4 px-6">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-semibold rounded-full border {{ $statusStyle[0] }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $statusStyle[1] }}"></span>
                                {{ $pembayaran->status_tagihan }}
                            </span>
                        </td>

                        <td class="py-4 px-6 text-center">
                            @if($pembayaran->status_tagihan == 'Menunggu Verifikasi' && !empty($pembayaran->bukti_bayar))
                                <div class="flex justify-center gap-1.5">
                                    <form action="{{ route('pembayaran.konfirmasi', $pembayaran->id_detail) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="inline-flex items-center gap-1 bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-1.5 rounded-lg text-[10px] font-bold transition">
                                            <i data-lucide="check" class="w-3 h-3"></i> LUNAS
                                        </button>
                                    </form>
                                    <button type="button"
                                        onclick="document.getElementById('modal-tolak-{{ $pembayaran->id_detail }}').classList.remove('hidden')"
                                        class="inline-flex items-center gap-1 bg-rose-600 hover:bg-rose-700 text-white px-3 py-1.5 rounded-lg text-[10px] font-bold transition">
                                        <i data-lucide="x" class="w-3 h-3"></i> TOLAK
                                    </button>
                                </div>
                            @elseif($pembayaran->status_tagihan == 'Lunas')
                                <span class="inline-flex items-center gap-1 text-emerald-600 font-bold text-[10px] bg-emerald-50 px-2 py-1 rounded-lg">
                                    <i data-lucide="check-circle-2" class="w-3 h-3"></i> SUDAH LUNAS
                                </span>
                            @else
                                <span class="text-slate-300 text-[10px] italic">Menunggu upload...</span>
                            @endif
                        </td>

                    </tr>

                    @if(!empty($pembayaran->bukti_bayar))
                    <div id="modal-tolak-{{ $pembayaran->id_detail }}" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
                        <div class="bg-white p-6 rounded-2xl w-80 shadow-2xl border border-slate-100">
                            <div class="flex items-center gap-2 mb-4">
                                <div class="w-8 h-8 rounded-full bg-rose-50 text-rose-500 flex items-center justify-center">
                                    <i data-lucide="alert-triangle" class="w-4 h-4"></i>
                                </div>
                                <h3 class="font-display font-bold text-slate-800">Alasan Penolakan</h3>
                            </div>
                            <form action="{{ route('pembayaran.tolak', $pembayaran->id_detail) }}" method="POST">
                                @csrf
                                <textarea name="alasan" class="w-full border border-slate-200 rounded-xl p-3 mb-4 text-sm focus:outline-none focus:ring-2 focus:ring-rose-100 focus:border-rose-300" rows="3" required placeholder="Tulis alasan penolakan..."></textarea>
                                <div class="flex justify-end gap-2">
                                    <button type="button" onclick="document.getElementById('modal-tolak-{{ $pembayaran->id_detail }}').classList.add('hidden')" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 rounded-lg text-sm font-semibold transition">Batal</button>
                                    <button type="submit" class="px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white rounded-lg text-sm font-semibold transition">Kirim</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif

                    @empty

                    <tr>
                        <td colspan="7" class="py-14 text-center text-slate-400">
                            <div class="flex flex-col items-center justify-center gap-2">
                                <i data-lucide="inbox" class="w-8 h-8 text-slate-300"></i>
                                <span class="font-medium">Tidak ada data tagihan.</span>
                            </div>
                        </td>
                    </tr>

                    @endforelse

                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Preview Bukti Bayar --}}
    <div id="modalPreview" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm p-4" onclick="closeModal()">
        <div class="relative max-w-4xl w-full" onclick="event.stopPropagation()">
            <button onclick="closeModal()"
                class="absolute -top-11 right-0 inline-flex items-center gap-1.5 text-white font-bold text-sm bg-white/10 hover:bg-white/20 px-3 py-1.5 rounded-lg transition">
                <i data-lucide="x" class="w-4 h-4"></i> TUTUP
            </button>
            <img id="gambarPreview" src="" class="w-full h-auto rounded-2xl shadow-2xl border-4 border-white/10">
        </div>
    </div>

</div>

<script>
    function openModal(url) {
        document.getElementById('gambarPreview').src = url;
        document.getElementById('modalPreview').classList.remove('hidden');
    }
    function closeModal() {
        document.getElementById('modalPreview').classList.add('hidden');
    }
    if (window.lucide) lucide.createIcons();
</script>

@endsection