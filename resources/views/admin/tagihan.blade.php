@extends('layouts.admin')

@section('title', 'Kelola Tagihan')
@section('page_title', 'Kelola Tagihan')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

    .font-display { font-family: 'Space Grotesk', system-ui, sans-serif; }
    .font-body    { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; }
</style>

<div class="font-body">

    {{-- Notifikasi Sukses --}}
    @if(session('sukses'))
        <div class="mb-4 p-4 text-sm text-emerald-800 bg-emerald-50 rounded-xl border border-emerald-100 font-semibold flex items-center gap-2">
            <i data-lucide="check-circle" class="w-4 h-4"></i>
            <span>{{ session('sukses') }}</span>
        </div>
    @endif

    {{-- KOTAK NOTIFIKASI VALIDASI GAGAL --}}
    @if($errors->any())
        <div class="mb-4 p-4 text-sm text-rose-800 bg-rose-50 rounded-xl border border-rose-100 font-semibold">
            <div class="flex items-center gap-2 mb-2">
                <i data-lucide="alert-circle" class="w-4 h-4 text-rose-600"></i>
                <span>Gagal Menyimpan Data! Periksa kembali inputan Anda:</span>
            </div>
            <ul class="list-disc pl-5 font-medium text-xs space-y-1 text-rose-700">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="flex flex-col sm:flex-row gap-4 items-center justify-between bg-white p-4 rounded-2xl border border-slate-100 shadow-xs mb-6">

        <div class="relative w-full sm:w-80">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                <i data-lucide="search" class="w-5 h-5"></i>
            </span>
            <input type="text"
                   id="inputCari"
                   placeholder="Cari nama siswa atau jenis tagihan..."
                   class="w-full pl-10 pr-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-100 focus:border-emerald-400 focus:bg-white transition-all">
        </div>

        <button id="btnBukaTagihan" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold shadow-md shadow-emerald-100 transition-all">
            <i data-lucide="plus-circle" class="w-4 h-4"></i>
            <span>Buat Tagihan Baru</span>
        </button>

    </div>

    <div class="relative bg-white rounded-2xl border border-slate-100 shadow-xs overflow-hidden">

        <span class="absolute left-0 top-0 h-1 w-full bg-gradient-to-r from-emerald-500 via-teal-500 to-emerald-500"></span>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse" id="tabelTagihan">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                        <th class="py-4 px-6">Nama Siswa</th>
                        <th class="py-4 px-6">Jenis Tagihan</th>
                        <th class="py-4 px-6">Tanggal Tagihan</th>
                        <th class="py-4 px-6">Nominal</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm font-medium text-slate-600 divide-y divide-slate-100">

                    @forelse($tagihans as $tagihan)

                    @php
                        $namaSiswa = optional($tagihan->siswa)->nama ?? 'Tidak Diketahui';
                        $palet = ['bg-blue-50 text-[#1E88E5]','bg-emerald-50 text-emerald-600','bg-amber-50 text-amber-600','bg-rose-50 text-rose-500','bg-violet-50 text-violet-600'];
                        $warna = $palet[crc32($namaSiswa) % count($palet)];
                        $status = optional($tagihan->detailTagihan)->status_tagihan ?? 'Belum Lunas';

                        $statusStyle = match($status) {
                            'Lunas'   => ['bg-emerald-50 text-emerald-700 border-emerald-100', 'bg-emerald-500'],
                            'Dicicil' => ['bg-amber-50 text-amber-700 border-amber-100', 'bg-amber-500'],
                            default   => ['bg-rose-50 text-rose-700 border-rose-100', 'bg-rose-500'],
                        };
                    @endphp

                    <tr class="baris-data hover:bg-slate-50/50 transition-colors">

                        <td class="py-4 px-6 kolom-siswa">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full {{ $warna }} font-display font-bold text-[10px] flex items-center justify-center shrink-0">
                                    {{ strtoupper(substr($namaSiswa,0,2)) }}
                                </div>
                                <span class="text-slate-900 font-semibold">{{ $namaSiswa }}</span>
                            </div>
                        </td>

                        <td class="py-4 px-6 kolom-jenis">{{ $tagihan->nama_tagihan }}</td>

                        <td class="py-4 px-6 text-xs text-slate-400 font-normal">
                            {{ \Carbon\Carbon::parse($tagihan->jatuh_tempo ?? $tagihan->created_at)->format('d M Y') }}
                        </td>

                        <td class="py-4 px-6 font-display text-slate-900 font-semibold">
                            Rp {{ number_format(optional($tagihan->detailTagihan)->jumlah_bayar ?? 0, 0, ',', '.') }}
                        </td>

                        <td class="py-4 px-6">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-semibold rounded-full border {{ $statusStyle[0] }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $statusStyle[1] }}"></span>
                                {{ $status }}
                            </span>
                        </td>

                        <td class="py-4 px-6">
                            <div class="flex items-center justify-center gap-1">

                                <button type="button"
                                    onclick="openEditModal(
                                        '{{ $tagihan->id_tagihan }}',
                                        '{{ $tagihan->nis }}',
                                        '{{ $tagihan->nama_tagihan }}',
                                        '{{ optional($tagihan->detailTagihan)->jumlah_bayar ?? 0 }}',
                                        '{{ \Carbon\Carbon::parse($tagihan->jatuh_tempo)->format('Y-m-d') }}',
                                        '{{ optional($tagihan->detailTagihan)->status_tagihan ?? "Belum Lunas" }}'
                                    )"
                                    class="p-1.5 text-slate-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-colors">
                                    <i data-lucide="pencil" class="w-4 h-4"></i>
                                </button>

                                <form action="/admin/tagihan/{{ $tagihan->id_tagihan }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data tagihan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>

                    @empty

                    <tr id="barisKosong">
                        <td colspan="6" class="py-14 text-center text-slate-400 font-medium">
                            <div class="flex flex-col items-center justify-center gap-2">
                                <i data-lucide="credit-card" class="w-8 h-8 text-slate-300"></i>
                                <span>Belum ada data tagihan di database.</span>
                            </div>
                        </td>
                    </tr>

                    @endforelse

                    <tr id="pencarianKosong" class="hidden">
                        <td colspan="6" class="py-14 text-center text-slate-400 font-medium">
                            <div class="flex flex-col items-center justify-center gap-2">
                                <i data-lucide="search" class="w-8 h-8 text-slate-300"></i>
                                <span>Data yang Anda cari tidak ditemukan.</span>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-slate-100 flex items-center justify-between text-xs font-semibold text-slate-500 bg-slate-50/50">
            <span>Total {{ $tagihans->count() }} Tagihan</span>
            <div class="flex items-center gap-1">
                <button class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white text-slate-300 cursor-not-allowed" disabled>Sebelumnya</button>
                <button class="px-3 py-1.5 rounded-lg bg-emerald-600 text-white">1</button>
                <button class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50">Selanjutnya</button>
            </div>
        </div>

    </div>

    {{-- MODAL BUAT TAGIHAN BARU --}}
    <div id="modalTagihan" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4 hidden z-50">
        <div class="bg-white rounded-2xl max-w-md w-full shadow-xl border border-slate-100 overflow-hidden">

            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50">
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                        <i data-lucide="file-plus" class="w-4 h-4"></i>
                    </div>
                    <h3 class="font-display font-bold text-slate-800 text-sm">Buat Tagihan Baru</h3>
                </div>
                <button id="btnTutupTagihan" class="text-slate-400 hover:text-slate-600 p-1 rounded-lg hover:bg-slate-200 transition-colors">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>

            <form action="/admin/tagihan" method="POST" class="p-6 space-y-4">
                @csrf

                <div>
                    <label class="text-xs font-semibold text-slate-500 block mb-1">Pilih Siswa</label>
                    <select name="siswa_id" required class="w-full px-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-100 focus:border-emerald-400 focus:bg-white transition-all">
                        <option value="">-- Pilih Anak Didik --</option>
                        @foreach($daftarSiswa as $siswa)
                            <option value="{{ $siswa->nis }}">{{ $siswa->nama }} ({{ $siswa->kelas }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="text-xs font-semibold text-slate-500 block mb-1">Jenis Tagihan</label>
                    <select name="jenis_tagihan" id="buat_jenis_tagihan" required class="w-full px-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-100 focus:border-emerald-400 focus:bg-white transition-all">
                        <option value="" disabled selected data-harga="">-- Pilih Jenis Tagihan --</option>
                        <option value="Uang Sekolah / Uang Program" data-harga="1000000">Uang Sekolah (Uang Program)</option>
                        <option value="Uang Ekskul" data-harga="100000">Uang Ekskul</option>
                        <option value="Uang POMG" data-harga="150000">Uang POMG</option>
                        <option value="Uang MMP" data-harga="200000">Uang MMP</option>
                        <option value="Uang SPP / Bulan" data-harga="0">Uang SPP / Bulan</option>
                    </select>
                </div>

                <div>
                    <label class="text-xs font-semibold text-slate-500 block mb-1">Nominal (Rupiah)</label>
                    <input type="number" name="nominal" id="buat_nominal" required placeholder="Contoh: 350000" class="w-full px-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-100 focus:border-emerald-400 focus:bg-white transition-all">
                </div>

                <div>
                    <label class="text-xs font-semibold text-slate-500 block mb-1">Tanggal Tagihan Dibuat</label>
                    <input type="date" name="tanggal_tagihan" required value="{{ date('Y-m-d') }}" class="w-full px-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-100 focus:border-emerald-400 focus:bg-white transition-all">
                </div>

                <div class="flex items-center justify-end gap-2 pt-2 border-t border-slate-100 mt-4">
                    <button type="button" id="btnBatalTagihan" class="px-4 py-2 text-xs font-semibold text-slate-500 hover:bg-slate-100 rounded-xl transition-colors">Batal</button>
                    <button type="submit" class="px-4 py-2 text-xs font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl shadow-md shadow-emerald-100 transition-all">Simpan Tagihan</button>
                </div>

            </form>
        </div>
    </div>

    {{-- MODAL EDIT TAGIHAN --}}
    <div id="modalEditTagihan" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4 hidden z-50">
        <div class="bg-white rounded-2xl max-w-md w-full shadow-xl border border-slate-100 overflow-hidden">

            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50">
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center">
                        <i data-lucide="pencil" class="w-4 h-4"></i>
                    </div>
                    <h3 class="font-display font-bold text-slate-800 text-sm">Edit Data Tagihan</h3>
                </div>
                <button type="button" onclick="closeEditModal()" class="text-slate-400 hover:text-slate-600 p-1 rounded-lg hover:bg-slate-200 transition-colors">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>

            <form id="formEditTagihan" action="" method="POST" class="p-6 space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="text-xs font-semibold text-slate-500 block mb-1">Pilih Siswa</label>
                    <select name="siswa_id" id="edit_siswa_id" required class="w-full px-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-100 focus:border-emerald-400 focus:bg-white transition-all">
                        @foreach($daftarSiswa as $siswa)
                            <option value="{{ $siswa->nis }}">{{ $siswa->nama }} ({{ $siswa->kelas }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="text-xs font-semibold text-slate-500 block mb-1">Jenis Tagihan</label>
                    <select name="jenis_tagihan" id="edit_jenis_tagihan" required class="w-full px-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-100 focus:border-emerald-400 focus:bg-white transition-all">
                        <option value="Uang Sekolah / Uang Program" data-harga="1000000">Uang Sekolah (Uang Program)</option>
                        <option value="Uang Ekskul" data-harga="100000">Uang Ekskul</option>
                        <option value="Uang POMG" data-harga="150000">Uang POMG</option>
                        <option value="Uang MMP" data-harga="200000">Uang MMP</option>
                        <option value="Uang SPP / Bulan" data-harga="0">Uang SPP / Bulan</option>
                    </select>
                </div>

                <div>
                    <label class="text-xs font-semibold text-slate-500 block mb-1">Nominal (Rupiah)</label>
                    <input type="number" name="nominal" id="edit_nominal" required class="w-full px-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-100 focus:border-emerald-400 focus:bg-white transition-all">
                </div>

                <div>
                    <label class="text-xs font-semibold text-slate-500 block mb-1">Tanggal Tagihan</label>
                    <input type="date" name="tanggal_tagihan" id="edit_tanggal_tagihan" required class="w-full px-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-100 focus:border-emerald-400 focus:bg-white transition-all">
                </div>

                <div>
                    <label class="text-xs font-semibold text-slate-500 block mb-1">Status Pembayaran</label>
                    <select name="status_tagihan" id="edit_status_tagihan" required class="w-full px-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-100 focus:border-emerald-400 focus:bg-white transition-all">
                        <option value="Belum Lunas">Belum Lunas</option>
                        <option value="Dicicil">Dicicil</option>
                        <option value="Lunas">Lunas</option>
                    </select>
                </div>

                <div class="flex items-center justify-end gap-2 pt-2 border-t border-slate-100 mt-4">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 text-xs font-semibold text-slate-500 hover:bg-slate-100 rounded-xl transition-colors">Batal</button>
                    <button type="submit" class="px-4 py-2 text-xs font-semibold text-white bg-amber-500 hover:bg-amber-600 rounded-xl shadow-md shadow-amber-100 transition-all">Simpan Perubahan</button>
                </div>

            </form>
        </div>
    </div>

</div>

{{-- SCRIPTS JAVASCRIPT — logika tidak diubah sama sekali --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Kontrol Modal Tambah
        const modal = document.getElementById('modalTagihan');
        const btnBuka = document.getElementById('btnBukaTagihan');
        const btnTutup = document.getElementById('btnTutupTagihan');
        const btnBatal = document.getElementById('btnBatalTagihan');

        btnBuka.addEventListener('click', function() {
            modal.classList.remove('hidden');
        });

        function tutupModal() {
            modal.classList.add('hidden');
        }

        btnTutup.addEventListener('click', tutupModal);
        btnBatal.addEventListener('click', tutupModal);

        // Fitur Live Search Sederhana di Sisi Klien
        const inputCari = document.getElementById('inputCari');
        const barisData = document.querySelectorAll('.baris-data');
        const pencarianKosong = document.getElementById('pencarianKosong');

        inputCari.addEventListener('input', function() {
            const filter = inputCari.value.toLowerCase().trim();
            let adaDataCocok = false;

            barisData.forEach(row => {
                const namaSiswa = row.querySelector('.kolom-siswa').textContent.toLowerCase();
                const jenisTagihan = row.querySelector('.kolom-jenis').textContent.toLowerCase();

                if (namaSiswa.includes(filter) || jenisTagihan.includes(filter)) {
                    row.classList.remove('hidden');
                    adaDataCocok = true;
                } else {
                    row.classList.add('hidden');
                }
            });

            if (!adaDataCocok && filter !== "") {
                pencarianKosong.classList.remove('hidden');
            } else {
                pencarianKosong.classList.add('hidden');
            }
        });

        // Otomatisasi Nominal Harga di Modal Tambah
        const selectJenisBuat = document.getElementById('buat_jenis_tagihan');
        const inputNominalBuat = document.getElementById('buat_nominal');

        if (selectJenisBuat && inputNominalBuat) {
            selectJenisBuat.addEventListener('change', function() {
                const hargaSelected = this.options[this.selectedIndex].getAttribute('data-harga');
                inputNominalBuat.value = hargaSelected;

                if (hargaSelected === "0") {
                    inputNominalBuat.placeholder = "Masukkan nominal SPP...";
                    inputNominalBuat.focus();
                }
            });
        }

        // Otomatisasi Nominal Harga di Modal Edit
        const selectJenisEdit = document.getElementById('edit_jenis_tagihan');
        const inputNominalEdit = document.getElementById('edit_nominal');

        if (selectJenisEdit && inputNominalEdit) {
            selectJenisEdit.addEventListener('change', function() {
                const hargaSelected = this.options[this.selectedIndex].getAttribute('data-harga');
                if (hargaSelected !== null) {
                    inputNominalEdit.value = hargaSelected;
                }
            });
        }

        // FILTER ANTI-HURUF & KARAKTER STRANGE DI INPUT NOMINAL
        [inputNominalBuat, inputNominalEdit].forEach(input => {
            if (input) {
                input.addEventListener('keydown', function(e) {
                    if (['e', 'E', '-', '+', ',', '.'].includes(e.key)) {
                        e.preventDefault();
                    }
                });
            }
        });
    });

    // Kontrol Modal Edit Terpisah
    function openEditModal(id, nis, jenis, nominal, tanggal, status) {
        document.getElementById('formEditTagihan').action = '/admin/tagihan/' + id;
        document.getElementById('edit_siswa_id').value = nis;
        document.getElementById('edit_jenis_tagihan').value = jenis;
        document.getElementById('edit_nominal').value = nominal;
        document.getElementById('edit_tanggal_tagihan').value = tanggal;
        document.getElementById('edit_status_tagihan').value = status;

        document.getElementById('modalEditTagihan').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('modalEditTagihan').classList.add('hidden');
    }

    if (window.lucide) lucide.createIcons();
</script>

@endsection