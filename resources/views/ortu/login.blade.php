<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Orang Tua - TK Mutiara Bogor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white w-full max-w-4xl rounded-3xl shadow-xl overflow-hidden flex flex-col md:flex-row border border-slate-100">

        <div class="bg-emerald-600 p-12 md:w-1/2 flex flex-col justify-center text-white">
            <div class="mb-8">
                <svg class="w-16 h-16 text-white/90" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
            </div>
            <h1 class="text-3xl font-bold mb-4">Portal Orang Tua & Wali Murid</h1>
            <p class="text-emerald-50 opacity-90">Pantau informasi pembayaran administrasi, riwayat pembayaran, serta data profil putra-putri Anda dengan mudah dan aman.</p>
        </div>

        <div class="p-12 md:w-1/2 flex flex-col justify-center">
            <a href="/" class="text-sm text-slate-400 hover:text-slate-600 mb-6 flex items-center">
                ← Kembali ke Beranda
            </a>

            <div class="flex items-center gap-3 mb-8">
                <div class="bg-emerald-100 p-3 rounded-xl text-emerald-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <div>
                    <h2 class="font-bold text-slate-800">TK Mutiara Bogor</h2>
                    <p class="text-xs text-slate-500 uppercase tracking-wider font-semibold">Akses Wali Murid</p>
                </div>
            </div>

            <h3 class="text-2xl font-bold text-slate-900 mb-2">Masuk Portal</h3>
            <p class="text-slate-500 mb-6">Gunakan Nomor Induk Siswa (NIS) Anda untuk masuk.</p>

            {{-- Pesan error umum, sesuai key session('gagal', ...) yang dikirim LoginController --}}
            @if(session('gagal') || $errors->any())
                <div class="mb-5 flex items-start gap-3 bg-rose-50 border border-rose-200 rounded-xl p-4">
                    <svg class="w-5 h-5 text-rose-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"></path></svg>
                    <div class="text-sm text-rose-700 font-medium">
                        {{ session('gagal') ?? $errors->first() }}
                    </div>
                </div>
            @endif

            <form action="/login-ortu" method="POST">
                @csrf
                <div class="mb-5">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Nomor Induk Siswa (NIS)</label>
                    <input type="text" name="nis" value="{{ old('nis') }}" placeholder="Contoh: 26270101" required
                        class="w-full p-4 bg-slate-50 border rounded-xl focus:ring-2 outline-none transition
                        {{ ($errors->any() || session('gagal')) ? 'border-rose-300 focus:ring-rose-400' : 'border-slate-200 focus:ring-emerald-500' }}">
                    @error('nis')
                        <p class="text-xs text-rose-500 mt-1.5">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Password</label>
                    <div class="relative">
                        <input type="password" name="password" placeholder="••••••••" required
                            class="w-full p-4 bg-slate-50 border rounded-xl focus:ring-2 outline-none transition
                            {{ ($errors->any() || session('gagal')) ? 'border-rose-300 focus:ring-rose-400' : 'border-slate-200 focus:ring-emerald-500' }}">
                    </div>
                    @error('password')
                        <p class="text-xs text-rose-500 mt-1.5">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-4 rounded-xl transition shadow-lg shadow-emerald-200">
                    Masuk Ke Portal
                </button>

                <div class="mt-6 bg-emerald-50 border border-emerald-200 rounded-2xl p-4">
                    <div class="flex items-start gap-3">
                        <div class="bg-emerald-100 rounded-full p-2">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M13 16h-1v-4h-1m1-4h.01M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-emerald-700 text-sm">
                                Informasi Login
                            </h4>
                            <ul class="text-xs text-slate-600 mt-2 space-y-1 leading-5">
                                <li>• Username menggunakan <strong>Nomor Induk Siswa (NIS)</strong>.</li>
                                <li>• Password dibuat oleh <strong>Admin TK Mutiara Bogor</strong>.</li>
                                <li>• Jika lupa password, silakan hubungi pihak sekolah untuk melakukan reset password.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>