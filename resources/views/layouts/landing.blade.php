<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TK Mutiara Bogor - Official Website</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; scroll-behavior: smooth; }
    </style>
</head>
<body class="bg-slate-900 text-white relative min-h-screen flex flex-col justify-between">

    <!-- 1. BACKGROUND IMAGE DENGAN OVERLAY GELAP -->
    <div class="absolute inset-0 z-0 bg-cover bg-center opacity-30 mix-blend-overlay" 
         style="background-image: url('{{ asset('images/ilustrasi-spp.jpg') }}');">
    </div>
    <div class="absolute inset-0 bg-gradient-to-b from-slate-950 via-slate-900/90 to-slate-950 z-0"></div>

    <!-- 2. NAVBAR (NAVIGASI ATAS) -->
    <header class="relative z-10 border-b border-white/10 bg-white/5 backdrop-blur-md sticky top-0">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <!-- RESTRUKTURISASI BAGIAN LOGO & NAMA SEKOLAH DI NAVBAR -->
<div class="flex items-center space-x-4 py-1">
    <!-- Ukuran logo diperbesar agar detail bundarnya terlihat jelas & natural -->
    <img src="{{ asset('images/logo-TKMutiara.png') }}" alt="Logo TK" class="h-14 w-auto object-contain transform hover:scale-105 transition duration-200">
    
    <!-- Penyesuaian teks di sebelah kanan logo agar seimbang -->
    <div class="space-y-0.5">
        <span class="font-bold text-xl block tracking-wide text-white leading-none">TK Mutiara Bogor</span>
        <span class="text-xs font-semibold text-slate-400 block tracking-normal">Sistem Informasi Pembayaran</span>
    </div>
</div>

            <!-- Tombol Aksi Login -->
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

    <!-- 3. MAIN CONTENT CONTAINER -->
    <div class="relative z-10 flex-1 flex flex-col justify-center">
        
        <!-- SECTION 1: BERANDA (HERO GRID RESTRUCTURED) -->
        <section id="beranda" class="max-w-7xl w-full mx-auto px-6 py-10 lg:py-16 grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            
            <!-- SISI KIRI: HEADLINE, DESKRIPSI & CTA -->
            <div class="lg:col-span-6 space-y-6 text-left">
                <!-- Badge PPDB Kuning -->
                <div class="inline-flex items-center space-x-2 bg-amber-400 text-slate-950 px-4 py-1.5 rounded-full text-xs font-bold tracking-wide shadow-sm">
                    <span>🎓</span>
                    <span>Penerimaan Peserta Didik Baru TA 2026 / 2027</span>
                </div>

                <!-- Judul Utama -->
                <h1 class="text-4xl md:text-5xl font-bold tracking-tight text-white leading-tight">
                    Tempat Terbaik <br>
                    Untuk Awal Pendidikan <br>
                    <span class="text-amber-400">Buah Hati Anda</span>
                </h1>

                <!-- Deskripsi -->
                <p class="text-slate-300 text-sm md:text-base max-w-xl leading-relaxed">
                    TK Mutiara Bogor merupakan sekolah anak usia dini yang berada di bawah naungan <span class="text-white font-semibold">YAYASAN BUNGA RAYA BOGOR</span>, berdedikasi tinggi mengembangkan kreativitas serta karakter mulia anak.
                </p>

                <!-- Tombol CTA -->
                <div class="pt-2">
                    <a href="#tentang" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold shadow-lg transition duration-200 transform hover:scale-[1.02]">
                        Lihat Program & Tentang Kami
                    </a>
                </div>
            </div>

            <!-- SISI KANAN: DUA KOTAK DIJADIKAN SATU STRUKTUR BESAR & ELEGAN -->
            <div id="tentang" class="lg:col-span-6 scroll-mt-24 space-y-4">
                
                <!-- 1. KOTAK INFORMASI AKREDITASI & DATA RESMI (DIPERBESAR) -->
                <div class="bg-white/5 border border-white/10 p-6 rounded-3xl backdrop-blur-md grid grid-cols-2 gap-4 shadow-xl">
                    <div class="bg-white/5 p-4 rounded-2xl border border-white/5">
                        <span class="text-[10px] uppercase font-bold text-amber-400 tracking-wider flex items-center gap-1 mb-1">
                            <i data-lucide="award" class="w-3.5 h-3.5"></i> Akreditasi
                        </span>
                        <p class="text-base font-bold text-white">Peringkat B</p>
                    </div>
                    
                    <div class="bg-white/5 p-4 rounded-2xl border border-white/5">
                        <span class="text-[10px] uppercase font-bold text-blue-400 tracking-wider flex items-center gap-1 mb-1">
                            <i data-lucide="fingerprint" class="w-3.5 h-3.5"></i> NPSN
                        </span>
                        <p class="text-base font-mono font-bold text-white">20269894</p>
                    </div>
                    
                    <div class="bg-white/5 p-4 rounded-2xl border border-white/5">
                        <span class="text-[10px] uppercase font-bold text-emerald-400 tracking-wider flex items-center gap-1 mb-1">
                            <i data-lucide="building-2" class="w-3.5 h-3.5"></i> Status Sekolah
                        </span>
                        <p class="text-base font-bold text-white">Swasta</p>
                    </div>
                    
                    <div class="bg-white/5 p-4 rounded-2xl border border-white/5">
                        <span class="text-[10px] uppercase font-bold text-purple-400 tracking-wider flex items-center gap-1 mb-1">
                            <i data-lucide="school" class="w-3.5 h-3.5"></i> Bentuk Pendidikan
                        </span>
                        <p class="text-base font-bold text-white">TK / PAUD</p>
                    </div>
                </div>

                <!-- 2. KOTAK MENGAPA MEMILIH KAMI (PUTIH BERSIH) -->
                <div class="bg-white p-6 md:p-8 rounded-3xl shadow-2xl text-slate-900 border border-white/20">
                    <h3 class="text-xl font-bold text-slate-900 mb-5 tracking-tight flex items-center gap-2">
                        <span>✨</span> Mengapa Memilih Kami?
                    </h3>
                    
                    <!-- Daftar Keunggulan -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="flex items-start space-x-3">
                            <span class="text-lg bg-amber-100 p-2 rounded-xl shrink-0">🧑‍🏫</span>
                            <div>
                                <h4 class="font-bold text-slate-900 text-xs md:text-sm">Guru Profesional</h4>
                                <p class="text-slate-500 text-[11px] mt-0.5 leading-snug">Seluruh guru berpengalaman di PAUD.</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3">
                            <span class="text-lg bg-rose-100 p-2 rounded-xl shrink-0">🎨</span>
                            <div>
                                <h4 class="font-bold text-slate-900 text-xs md:text-sm">Belajar & Bermain</h4>
                                <p class="text-slate-500 text-[11px] mt-0.5 leading-snug">Metode kreatif agar anak gembira.</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3">
                            <span class="text-lg bg-blue-100 p-2 rounded-xl shrink-0">🏫</span>
                            <div>
                                <h4 class="font-bold text-slate-900 text-xs md:text-sm">Fasilitas Lengkap</h4>
                                <p class="text-slate-500 text-[11px] mt-0.5 leading-snug">Playground luas, aman, dan ber-CCTV.</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3">
                            <span class="text-lg bg-emerald-100 p-2 rounded-xl shrink-0">💖</span>
                            <div>
                                <h4 class="font-bold text-slate-900 text-xs md:text-sm">Karakter Mulia</h4>
                                <p class="text-slate-500 text-[11px] mt-0.5 leading-snug">Diajarkan nilai agama & sopan santun.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </section>
    </div>

                
    <!-- 4. FOOTER / SECTION KONTAK (DENGAN DETAIL RESMI DARI GAMBAR) -->
    <footer id="kontak" class="relative z-10 border-t border-white/10 bg-slate-950/80 backdrop-blur-md py-6 mt-6 scroll-mt-10">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-6">
            
            <!-- Informasi Alamat & Email Resmi Sesuai Gambar Kemendikbud -->
<div class="text-xs text-slate-400 text-center md:text-left space-y-1">
    <p class="font-bold text-slate-200 text-sm">&copy; 2026 TK Mutiara Bogor. All Rights Reserved.</p>
    
    <!-- Alamat Berupa Link Google Maps -->
    <p class="text-slate-400 leading-relaxed">
        <span class="font-semibold text-slate-300">Alamat:</span> 
        <a href="https://www.google.com/maps/search/?api=1&query=TK+MUTIARA+BOGOR+VILLA+MUTIARA+Kec+Tanah+Sareal+Kota+Bogor" 
           target="_blank" 
           rel="noopener noreferrer" 
           class="hover:text-amber-400 hover:underline transition-all inline-flex items-center gap-1">
            <span>JL. MUTIARA UTARA I BLOK F2 NO.43-45 VILLA MUTIARA BOGOR, Kec. Tanah Sareal, Kota Bogor, Prov. Jawa Barat.</span>
            <i data-lucide="map-pin" class="w-3.5 h-3.5 text-rose-400 shrink-0 inline"></i>
        </a>
    </p>
    
    <p class="text-[11px] text-slate-500">
        <span class="font-semibold text-slate-400">Telp:</span> 02517550253 | <span class="font-semibold text-slate-400">Email:</span> tkmutiarabogor@ymail.com
    </p>
</div>

            <!-- HUBUNGAN SOSIAL MEDIA KANAN (MENGGUNAKAN SVG MURNI - PASTI MUNCUL) -->
<div class="flex items-center space-x-4 shrink-0">
    <span class="text-xs text-slate-400 font-medium hidden sm:inline">Hubungi Kami:</span>
    
    <!-- WhatsApp (Sudah Terhubung ke Nomor: 085716698823) -->
    <a href="https://wa.me/6285716698823?text=Halo%20Admin%20TK%20Mutiara%20Bogor%2C%20saya%20ingin%20bertanya%20mengenai%20informasi%20pembayaran%20dan%20pendaftaran." 
       target="_blank" 
       rel="noopener noreferrer" 
       class="w-9 h-9 rounded-xl bg-emerald-500/10 hover:bg-emerald-500 text-emerald-400 hover:text-white flex items-center justify-center transition shadow-md group" 
       title="Hubungi via WhatsApp">
        <!-- Ikon WhatsApp SVG -->
        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397 0 12.008 0c3.203.001 6.212 1.249 8.477 3.52c2.266 2.27 3.51 5.28 3.505 8.484-.011 6.657-5.347 12.008-11.956 12.008-1.998-.001-3.96-.502-5.707-1.458L0 24zm6.59-4.846c1.66.986 3.288 1.481 4.752 1.483 5.4 0 9.79-4.386 9.797-9.774.004-2.61-1.01-5.064-2.857-6.914C16.435 2.1 13.987.965 11.39.965c-5.4 0-9.79 4.386-9.797 9.774a9.71 9.71 0 0 0 1.503 5.105l-1.01 3.69 3.791-.994zM16.518 14.1c-.263-.13-1.55-.762-1.787-.85-.239-.087-.413-.13-.587.13-.174.26-.674.85-.826 1.022-.152.173-.304.195-.567.064a7.144 7.144 0 0 1-2.107-1.3c-.815-.726-1.366-1.624-1.526-1.9-.16-.263-.017-.405.114-.536.119-.117.263-.304.394-.457.13-.152.174-.26.26-.435.087-.174.044-.326-.021-.456-.065-.13-.587-1.413-.804-1.936-.211-.509-.426-.44-.587-.449-.152-.007-.326-.008-.5-.008a.96.96 0 0 0-.695.326c-.239.26-.913.892-.913 2.174 0 1.282.934 2.52 1.064 2.7 1.135 1.493 2.22 2.247 3.498 2.684.762.26 1.428.28 1.968.2a2.12 2.12 0 0 0 1.385-.975c.456-.913.456-1.696.321-1.85-.134-.154-.304-.24-.567-.37z"/>
        </svg>
    </a>

    <!-- Instagram (Sudah Terhubung ke Akun Resmi @tk_mutiara_bogor) -->
    <a href="https://www.instagram.com/tk_mutiara_bogor?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" 
       target="_blank" 
       rel="noopener noreferrer" 
       class="w-9 h-9 rounded-xl bg-pink-500/10 hover:bg-gradient-to-tr hover:from-amber-500 hover:to-purple-600 text-pink-400 hover:text-white flex items-center justify-center transition shadow-md" 
       title="Ikuti di Instagram">
        <!-- Ikon Instagram SVG -->
        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
        </svg>
    </a>

    <!-- Facebook -->
    <a href="#" 
       target="_blank" 
       rel="noopener noreferrer" 
       class="w-9 h-9 rounded-xl bg-blue-500/10 hover:bg-blue-600 text-blue-400 hover:text-white flex items-center justify-center transition shadow-md" 
       title="Sukai di Facebook">
        <!-- Ikon Facebook SVG -->
        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
        </svg>
    </a>
</div>

        </div>
    </footer>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>