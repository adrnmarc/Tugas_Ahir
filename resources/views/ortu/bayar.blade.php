<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Bukti Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --hijau: #0FA968;
            --hijau-gelap: #0B7A4E;
            --krem: #F7F3EA;
        }
        body {
            background-color: var(--krem) !important;
        }
        .card-header-hijau {
            background: linear-gradient(135deg, var(--hijau) 0%, var(--hijau-gelap) 100%);
            border-radius: 1rem 1rem 0 0;
            padding: 1.75rem;
            position: relative;
            overflow: hidden;
        }
        .card-header-hijau::before {
            content: "";
            position: absolute;
            width: 130px;
            height: 130px;
            background: rgba(255,255,255,.10);
            border-radius: 50%;
            top: -50px;
            right: -30px;
        }
        .card-header-hijau .label {
            color: #D1FAE5;
            font-size: .7rem;
            font-weight: 700;
            letter-spacing: .05em;
            text-transform: uppercase;
            position: relative;
        }
        .card-header-hijau h5 {
            color: #fff;
            font-weight: 700;
            margin: .25rem 0 0;
            position: relative;
        }
        .card-header-hijau h3 {
            color: #fff;
            font-weight: 800;
            margin: .25rem 0 0;
            position: relative;
        }
        .card-custom {
            border: none;
            border-radius: 1rem;
            overflow: hidden;
        }
        .instruksi-box {
            background-color: #EFF6FF;
            border-radius: .85rem;
            padding: 1.15rem 1.25rem;
        }
        .instruksi-box h6 {
            color: #1e3a8a;
            font-weight: 700;
        }
        .instruksi-row {
            display: flex;
            justify-content: space-between;
            font-size: .875rem;
            padding: .2rem 0;
        }
        .instruksi-row span:first-child {
            color: #94a3b8;
        }
        .instruksi-row span:last-child {
            font-weight: 600;
            color: #334155;
        }
        .btn-hijau {
            background-color: var(--hijau);
            border: none;
            color: #fff;
            font-weight: 700;
            padding: .7rem 1rem;
            border-radius: .75rem;
            transition: background-color .15s ease;
        }
        .btn-hijau:hover {
            background-color: var(--hijau-gelap);
            color: #fff;
        }
        .upload-box {
            border: 2px dashed #e2e8f0;
            border-radius: .85rem;
            padding: 2rem 1rem;
            text-align: center;
            cursor: pointer;
            transition: border-color .15s ease, background-color .15s ease;
        }
        .upload-box:hover {
            border-color: #6ee7b7;
            background-color: #ecfdf5;
        }
        .upload-icon {
            width: 44px;
            height: 44px;
            background-color: #ECFDF5;
            border-radius: .85rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto .5rem;
        }
        .back-link {
            color: #64748b;
            font-size: .875rem;
            text-decoration: none;
        }
        .back-link:hover {
            color: #334155;
        }
    </style>
</head>
<body>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <a href="/ortu/tagihan" class="back-link d-inline-flex align-items-center gap-1 mb-3">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"></path></svg>
                Kembali ke Daftar Tagihan
            </a>

            <div class="card card-custom shadow-sm">

                {{-- Header hijau --}}
                <div class="card-header-hijau">
                    <p class="label mb-0">Tagihan</p>
                    <h5>{{ $tagihan->nama_iuran ?? 'Data tidak ditemukan' }}</h5>
                    <h3>Rp {{ isset($tagihan) ? number_format($tagihan->jumlah_bayar, 0, ',', '.') : '0' }}</h3>
                </div>

                <div class="card-body p-4">

                    {{-- Instruksi Pembayaran --}}
                    <div class="instruksi-box mb-4">
                        <h6 class="mb-2">Instruksi Pembayaran</h6>
                        <p class="small text-secondary mb-2">Silakan transfer ke nomor rekening berikut:</p>
                        <div class="instruksi-row">
                            <span>Bank</span><span>BNI</span>
                        </div>
                        <div class="instruksi-row">
                            <span>No. Rekening</span><span>1234567890</span>
                        </div>
                        <div class="instruksi-row">
                            <span>Atas Nama</span><span>TK Mutiara</span>
                        </div>
                    </div>

                    {{-- Form Upload --}}
                    <form action="{{ url('ortu/bayar/' . ($tagihan->id_detail ?? $tagihan->id)) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <label class="form-label fw-bold">Upload Bukti Transfer</label>

                        <label class="upload-box d-block mb-1">
                            <div class="upload-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#0FA968" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 16V4M12 4l-4 4M12 4l4 4"></path><path d="M4 16v3a2 2 0 002 2h12a2 2 0 002-2v-3"></path></svg>
                            </div>
                            <div class="fw-semibold text-secondary" id="upload-filename" style="font-size:.9rem;">Klik untuk pilih foto atau screenshot</div>
                            <div class="text-muted" style="font-size:.75rem;">Pastikan bukti foto jelas terbaca</div>
                            <input type="file" name="bukti" accept="image/*" required class="d-none"
                                   onchange="document.getElementById('upload-filename').textContent = this.files[0] ? this.files[0].name : 'Klik untuk pilih foto atau screenshot'">
                        </label>

                        <button type="submit" class="btn btn-hijau w-100 mt-3">Kirim Bukti Pembayaran</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>