<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Orang Tua - TK Mutiara Bogor</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Tambahan Lucide Icons agar tampilan input lebih modern -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-slate-950 min-h-screen flex items-center justify-center p-4 antialiased relative overflow-hidden">

    <!-- Efek Cahaya Estetik di Background (Sesuai tema Landing Page & Admin) -->
    <div class="absolute inset-0 z-0 bg-cover bg-center opacity-10 mix-blend-overlay" 
         style="background-image: url('{{ asset('images/ilustrasi-spp.jpg') }}');">
    </div>
    <div class="absolute top-[-20%] left-[-10%] w-[500px] h-[500px] bg-emerald-500/10 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-[-20%] right-[-10%] w-[500px] h-[500px] bg-teal-500/10 rounded-full blur-[120px] pointer-events-none"></div>

    <!-- MAIN CARD -->
    <div class="relative z-10 bg-white/95 backdrop-blur-md w-full max-w-4xl rounded-[32px] shadow-2xl overflow-hidden flex flex-col md:flex-row border border-white/20 p-4 gap-4">
        
        <!-- SISI KIRI: BANNER EMERALD -->
        <div class="bg-gradient-to-br from-emerald-600 via-emerald-700 to-teal-800 p-8 md:p-12 md:w-1/2 rounded-[24px] flex flex-col justify-between text-white relative overflow-hidden text-center md:text-left min-h-[250px] md:min-h-auto">
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-xl pointer-events-none"></div>
            <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-black/10 rounded-full blur-xl pointer-events-none"></div>

            <div class="my-auto space-y-5">
                <div class="bg-white/10 w-16 h-16 rounded-2xl flex items-center justify-center mx-auto md:mx-0 border border-white/10 shadow-inner">
                    <i data-lucide="users" class="w-8 h-8 text-white"></i>
                </div>
                <h1 class="text-2xl md:text-3xl font-bold tracking-tight leading-tight">Portal Orang Tua & Wali Murid</h1>
                <p class="text-emerald-100/90 text-xs md:text-sm leading-relaxed">
                    Pantau informasi pembayaran administrasi, riwayat pembayaran, serta data profil putra-putri Anda dengan mudah, transparan, dan aman.
                </p>
            </div>

            <div class="text-[10px] text-emerald-200/50 tracking-wider pt-4">
                &copy; 2026 TK Mutiara Bogor
            </div>
        </div>

        <!-- SISI KANAN: FORM & NOTES -->
        <div class="p-6 md:p-8 md:w-1/2 flex flex-col justify-center space-y-5">
            
            <a href="/" class="text-xs font-semibold text-slate-400 hover:text-emerald-600 flex items-center gap-1.5 transition w-fit">
                <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i> Kembali ke Beranda
            </a>
            
            <div class="flex items-center gap-3 border-b border-slate-100 pb-4">
                <div class="bg-emerald-50 p-2.5 rounded-xl text-emerald-600 border border-emerald-100 shadow-sm">
                    <img src="{{ asset('images/logo-TKMutiara.png') }}" alt="Logo" class="w-6 h-6 object-contain">
                </div>
                <div>
                    <h2 class="font-bold text-slate-900 text-sm tracking-tight">TK Mutiara Bogor</h2>
                    <p class="text-[10px] text-slate-400 uppercase tracking-wider font-bold">Akses Wali Murid</p>
                </div>
            </div>

            <div>
                <h3 class="text-xl font-bold text-slate-900 tracking-tight">Masuk Portal</h3>
                <p class="text-xs text-slate-500 mt-0.5">Silakan isi kredensial di bawah untuk memverifikasi akun Anda.</p>
            </div>

            <!-- Notifikasi Gagal jika ada session flash -->
            @if(session('gagal'))
                <div class="bg-rose-50 border border-rose-100 text-rose-700 px-4 py-2.5 rounded-xl text-xs font-semibold flex items-center gap-2">
                    <i data-lucide="alert-circle" class="w-4 h-4 text-rose-500 shrink-0"></i>
                    <span>{{ session('gagal') }}</span>
                </div>
            @endif

            <form action="/login-ortu" method="POST" class="space-y-4">
                @csrf
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-slate-700 tracking-wide">Nomor Induk Siswa (NIS)</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                            <i data-lucide="credit-card" class="w-4 h-4"></i>
                        </span>
                        <input type="text" name="nis" placeholder="Contoh: 26270101" required 
                            class="w-full pl-10 pr-4 py-2.5 text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:outline-none focus:border-emerald-600 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 transition-all font-medium text-slate-700">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-slate-700 tracking-wide">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                            <i data-lucide="lock" class="w-4 h-4"></i>
                        </span>
                        <input type="password" name="password" placeholder="••••••••" required 
                            class="w-full pl-10 pr-4 py-2.5 text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:outline-none focus:border-emerald-600 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 transition-all font-medium text-slate-700">
                    </div>
                </div>

                <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold py-2.5 rounded-xl transition shadow-lg shadow-emerald-600/20 transform active:scale-[0.98] cursor-pointer">
                    Masuk Ke Portal
                </button>
            </form>

            <!-- KOTAK NOTES INFORMASI LOGIN (DARI ADMIN & NIS) -->
            <div class="bg-emerald-50/60 border border-emerald-100 rounded-2xl p-4 space-y-1.5">
                <div class="flex items-center gap-2 text-emerald-800 font-bold text-xs">
                    <i data-lucide="info" class="w-4 h-4 text-emerald-600 shrink-0"></i>
                    <span>Informasi Akun Login</span>
                </div>
                <ul class="text-[11px] text-slate-600 space-y-1 pl-1 list-disc list-inside leading-relaxed font-medium">
                    <li>Username wajib menggunakan <span class="font-bold text-slate-800">Nomor Induk Siswa (NIS)</span> resmi.</li>
                    <li>Password akun merupakan data terenkripsi yang didaftarkan oleh <span class="font-bold text-emerald-700">Admin</span>.</li>
                    <li>Jika belum memiliki akun atau lupa sandi, silakan hubungi bagian Tata Usaha.</li>
                </ul>
            </div>

        </div>
    </div>

    <!-- Script Pemanggil Ikon -->
    <script>lucide.createIcons();</script>
</body>
</html>