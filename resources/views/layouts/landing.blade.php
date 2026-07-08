<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TK Mutiara Bogor - Official Website</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Inter', sans-serif; scroll-behavior: smooth; }
    </style>
</head>
<body class="bg-slate-900 text-white relative min-h-screen flex flex-col justify-between">

    <div class="absolute inset-0 z-0 bg-cover bg-center opacity-40 mix-blend-overlay" 
         style="background-image: url('{{ asset('images/ilustrasi-spp.jpg') }}');">
    </div>
    <div class="absolute inset-0 bg-gradient-to-b from-slate-950 via-slate-900/90 to-slate-950 z-0"></div>

    <header class="relative z-10 border-b border-white/10 bg-white/5 backdrop-blur-md sticky top-0">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/logo-TKMutiara.png') }}" alt="Logo TK" class="h-10 w-auto">
                <div>
                    <span class="font-bold text-lg block tracking-wide text-white">TK Mutiara Bogor</span>
                    <span class="text-xs text-slate-400 block -mt-1">Sistem Informasi Pembayaran</span>
                </div>
            </div>

            <nav class="hidden lg:flex items-center space-x-8 text-sm font-medium text-slate-300">
                <a href="#beranda" class="text-white hover:text-blue-400 transition">Beranda</a>
                <a href="#tentang" class="hover:text-white transition">Tentang & Program</a>
                <a href="#kontak" class="hover:text-white transition">Kontak</a>
            </nav>

            <div class="flex items-center space-x-3">
                <a href="/login" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-xs font-semibold shadow-md transition flex items-center space-x-1.5">
                    <i data-lucide="user" class="w-3.5 h-3.5"></i>
                    <span>Login Admin</span>
                </a>
                <a href="/login-ortu" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-xs font-semibold shadow-md transition flex items-center space-x-1.5">
                    <i data-lucide="users" class="w-3.5 h-3.5"></i>
                    <span>Login Orang Tua</span>
                </a>
            </div>
        </div>
    </header>

    <div class="relative z-10 flex-1 flex flex-col justify-center">
        
        <section id="beranda" class="max-w-7xl w-full mx-auto px-6 py-12 lg:py-20 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <div class="lg:col-span-7 space-y-6 text-left">
                <div class="inline-flex items-center space-x-2 bg-amber-400 text-slate-950 px-4 py-1.5 rounded-full text-xs font-bold tracking-wide shadow-sm">
                    <span>🎓</span>
                    <span>Penerimaan Peserta Didik Baru Tahun Ajaran 2026 / 2027</span>
                </div>

                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight text-white leading-tight">
                    Tempat Terbaik <br>
                    Untuk Awal Pendidikan <br>
                    <span class="text-amber-400">Buah Hati Anda</span>
                </h1>

                <p class="text-slate-300 text-base md:text-lg max-w-xl leading-relaxed">
                    TK Mutiara Bogor merupakan sekolah anak usia dini yang mengembangkan kemampuan akademik, karakter, kreativitas, sosial, dan spiritual anak melalui pembelajaran yang menyenangkan.
                </p>

                <div class="flex items-center space-x-4 pt-2">
                    <a href="#tentang" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold shadow-lg transition duration-200">
                        Lihat Program
                    </a>
                    <a href="#kontak" class="border border-white/30 hover:border-white hover:bg-white/10 text-white px-6 py-3 rounded-xl font-semibold transition duration-200">
                        Hubungi Kami
                    </a>
                </div>
            </div>

            <div id="tentang" class="lg:col-span-5 scroll-mt-24">
                <div class="bg-white/95 backdrop-blur-md p-8 md:p-10 rounded-3xl shadow-2xl text-slate-900 border border-white/20">
                    <h3 class="text-2xl font-bold text-slate-900 mb-6 tracking-tight">Mengapa Memilih Kami?</h3>
                    
                    <div class="space-y-5">
                        <div class="flex items-start space-x-4">
                            <span class="text-xl bg-amber-100 p-2 rounded-xl">🧑‍🏫</span>
                            <div>
                                <h4 class="font-bold text-slate-900 text-sm md:text-base">Guru Profesional</h4>
                                <p class="text-slate-600 text-xs md:text-sm mt-0.5">Seluruh guru berpengalaman dalam pendidikan anak usia dini.</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <span class="text-xl bg-rose-100 p-2 rounded-xl">🎨</span>
                            <div>
                                <h4 class="font-bold text-slate-900 text-sm md:text-base">Belajar Sambil Bermain</h4>
                                <p class="text-slate-600 text-xs md:text-sm mt-0.5">Metode pembelajaran kreatif sehingga anak tidak mudah bosan.</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <span class="text-xl bg-blue-100 p-2 rounded-xl">🏫</span>
                            <div>
                                <h4 class="font-bold text-slate-900 text-sm md:text-base">Fasilitas Lengkap</h4>
                                <p class="text-slate-600 text-xs md:text-sm mt-0.5">Playground, ruang kelas nyaman, CCTV dan ruang multimedia.</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <span class="text-xl bg-emerald-100 p-2 rounded-xl">💖</span>
                            <div>
                                <h4 class="font-bold text-slate-900 text-sm md:text-base">Pembentukan Karakter</h4>
                                <p class="text-slate-600 text-xs md:text-sm mt-0.5">Anak diajarkan disiplin, mandiri, sopan santun dan nilai agama.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </section>
    </div>

    <footer id="kontak" class="relative z-10 border-t border-white/10 bg-slate-950/80 backdrop-blur-md py-6 mt-12 scroll-mt-10">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-4">
            
            <div class="text-xs text-slate-400 text-center md:text-left">
                <p class="font-semibold text-slate-300">&copy; 2026 TK Mutiara Bogor. All Rights Reserved.</p>
                <p class="text-[11px] text-slate-500 mt-0.5">Alamat: Jl. Raya Mutiara, Kota Bogor, West Java, Indonesia</p>
            </div>

            <div class="flex items-center space-x-4">
                <span class="text-xs text-slate-400 font-medium hidden sm:inline">Hubungi Kami:</span>
                
                <a href="https://wa.me/628XXXXXXXXXX" target="_blank" rel="noopener noreferrer" 
                   class="w-9 h-9 rounded-xl bg-emerald-500/10 hover:bg-emerald-500 text-emerald-400 hover:text-white flex items-center justify-center transition shadow-md group" title="Hubungi via WhatsApp">
                    <i data-lucide="phone" class="w-4 h-4"></i>
                </a>

                <a href="https://instagram.com/tk_mutiarabogor_atau_opsional" target="_blank" rel="noopener noreferrer" 
                   class="w-9 h-9 rounded-xl bg-pink-500/10 hover:bg-gradient-to-tr hover:from-amber-500 hover:to-purple-600 text-pink-400 hover:text-white flex items-center justify-center transition shadow-md" title="Ikuti di Instagram">
                    <i data-lucide="instagram" class="w-4 h-4"></i>
                </a>

                <a href="https://facebook.com/nama_page_sekolah" target="_blank" rel="noopener noreferrer" 
                   class="w-9 h-9 rounded-xl bg-blue-500/10 hover:bg-blue-600 text-blue-400 hover:text-white flex items-center justify-center transition shadow-md" title="Sukai di Facebook">
                    <i data-lucide="facebook" class="w-4 h-4"></i>
                </a>
            </div>

        </div>
    </footer>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>