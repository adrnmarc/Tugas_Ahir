<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Keuangan</title>
    <style>
        @page {
            margin: 25px 35px;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #1e293b;
        }

        .kop-surat {
            text-align: center;
            padding-bottom: 10px;
            border-bottom: 3px solid #059669;
        }

        .kop-surat h1 {
            margin: 0;
            font-size: 20px;
            letter-spacing: 0.5px;
            color: #065f46;
        }

        .kop-surat p {
            margin: 4px 0 0 0;
            font-size: 11px;
            color: #475569;
        }

        .judul-laporan {
            text-align: center;
            margin: 22px 0 4px 0;
            font-size: 15px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .sub-judul {
            text-align: center;
            margin: 0 0 20px 0;
            font-size: 11px;
            color: #64748b;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        thead th {
            background-color: #059669;
            color: #ffffff;
            font-size: 10.5px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            padding: 9px 8px;
            text-align: left;
            border: 1px solid #059669;
        }

        tbody td {
            padding: 7px 8px;
            border: 1px solid #e2e8f0;
            font-size: 11px;
            vertical-align: middle;
        }

        tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }

        td.nominal {
            text-align: right;
            font-weight: bold;
            white-space: nowrap;
        }

        td.center {
            text-align: center;
        }

        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 8px;
            font-size: 9.5px;
            font-weight: bold;
        }

        .badge-lunas {
            background-color: #d1fae5;
            color: #065f46;
        }

        .badge-menunggu {
            background-color: #fef3c7;
            color: #92400e;
        }

        .badge-tolak {
            background-color: #fee2e2;
            color: #991b1b;
        }

        tfoot td {
            border: 1px solid #e2e8f0;
            padding: 8px;
            font-weight: bold;
            background-color: #ecfdf5;
        }

        .footer-info {
            margin-top: 6px;
            font-size: 9.5px;
            color: #94a3b8;
        }

        .ttd {
            width: 100%;
            margin-top: 45px;
        }

        .ttd td {
            border: none;
            text-align: center;
            font-size: 11px;
            padding: 0;
        }

        .ttd .nama-ttd {
            padding-top: 55px;
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="kop-surat">
        <h1>TK MUTIARA BOGOR</h1>
        <p>Jl. Vila Mutiara Bogor Blok F2, RT.06/RW.12, Mekarwangi, Tanah Sareal, Kota Bogor, Jawa Barat 16168</p>
    </div>

    <div class="judul-laporan">Laporan Transaksi Keuangan</div>
    <div class="sub-judul">Dicetak pada {{ now()->translatedFormat('d F Y, H:i') }} WIB</div>

    @php
        $totalNominal = $riwayatTransaksi->sum('jumlah_bayar');
    @endphp

    <table>
        <thead>
            <tr>
                <th style="width: 4%;">No</th>
                <th style="width: 22%;">Nama Siswa</th>
                <th style="width: 20%;">Jenis Tagihan</th>
                <th style="width: 18%;">Nominal</th>
                <th style="width: 16%;">Status</th>
                <th style="width: 20%;">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($riwayatTransaksi as $tx)
                @php
                    $badgeClass = match($tx->status_tagihan) {
                        'Lunas' => 'badge-lunas',
                        'Menunggu Verifikasi' => 'badge-menunggu',
                        'Ditolak' => 'badge-tolak',
                        default => 'badge-menunggu',
                    };
                @endphp
                <tr>
                    <td class="center">{{ $loop->iteration }}</td>
                    <td>{{ $tx->siswa->nama ?? '-' }}</td>
                    <td>{{ $tx->tagihan->nama_tagihan ?? '-' }}</td>
                    <td class="nominal">Rp {{ number_format($tx->jumlah_bayar, 0, ',', '.') }}</td>
                    <td class="center"><span class="badge {{ $badgeClass }}">{{ $tx->status_tagihan }}</span></td>
                    <td class="center">{{ $tx->created_at->format('d-m-Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="center" style="padding: 20px; color: #94a3b8;">
                        Belum ada data transaksi keuangan.
                    </td>
                </tr>
            @endforelse
        </tbody>
        @if($riwayatTransaksi->count() > 0)
        <tfoot>
            <tr>
                <td colspan="3" style="text-align: right;">Total Keseluruhan</td>
                <td class="nominal">Rp {{ number_format($totalNominal, 0, ',', '.') }}</td>
                <td colspan="2"></td>
            </tr>
        </tfoot>
        @endif
    </table>

    <p class="footer-info">Laporan ini digenerate otomatis oleh Sistem Informasi Pembayaran TK Mutiara Bogor dan sah tanpa tanda tangan basah.</p>

    <table class="ttd">
        <tr>
            <td style="width: 60%;"></td>
            <td style="width: 40%;">
                Bogor, {{ now()->translatedFormat('d F Y') }}<br>
                Bendahara / Admin
                <div class="nama-ttd">( _________________________ )</div>
            </td>
        </tr>
    </table>

</body>

</html>