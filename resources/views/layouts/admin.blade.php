<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - TK Mutiara Bogor</title>
    <!-- Tailwind CSS v4 -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-[#F8FAFC] text-slate-800 antialiased flex h-screen overflow-hidden">

    <!-- SIDEBAR KIRI -->
    <aside class="w-64 bg-white border-r border-slate-100 flex flex-col justify-between p-5 shrink-0 shadow-sm">
        <div>
            <!-- Header Sidebar (Ganti Icon dengan Logo Sekolah Berwarna Asli) -->
            <div class="flex items-center gap-3 px-2 py-3 mb-6 border-b border-slate-50 pb-5">
                <img src="{{ asset('images/logo-TKMutiara.png') }}" alt="Logo TK" class="w-10 h-10 object-contain">
                <div>
                    <h1 class="font-bold text-slate-900 leading-tight tracking-tight text-sm">TK Mutiara</h1>
                    <span class="text-[10px] text-blue-600 font-bold tracking-wider block uppercase">Bogor Dashboard</span>
                </div>
            </div>

            <!-- Menu Navigasi -->
            <nav class="space-y-1">
                <a href="/admin/dashboard" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium {{ Request::is('admin/dashboard') ? 'text-blue-700 bg-blue-50/80 font-bold' : 'text-slate-500 hover:text-blue-600 hover:bg-slate-50/80' }} rounded-xl transition-all">
                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                    <span>Dashboard</span>
                </a>
                
                <a href="/admin/siswa" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium {{ Request::is('admin/siswa') ? 'text-blue-700 bg-blue-50/80 font-bold' : 'text-slate-500 hover:text-blue-600 hover:bg-slate-50/80' }} rounded-xl transition-all">
                    <i data-lucide="users" class="w-4 h-4"></i>
                    <span>Data Siswa</span>
                </a>

                <a href="/admin/tagihan" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium {{ Request::is('admin/tagihan') ? 'text-blue-700 bg-blue-50/80 font-bold' : 'text-slate-500 hover:text-blue-600 hover:bg-slate-50/80' }} rounded-xl transition-all">
                    <i data-lucide="credit-card" class="w-4 h-4"></i>
                    <span>Kelola Tagihan</span>
                </a>

                <a href="/admin/verifikasi" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium {{ Request::is('admin/verifikasi') ? 'text-blue-700 bg-blue-50/80 font-bold' : 'text-slate-500 hover:text-blue-600 hover:bg-slate-50/80' }} rounded-xl transition-all">
                    <i data-lucide="file-check-2" class="w-4 h-4"></i>
                    <span>Verifikasi Pembayaran</span>
                </a>

                <a href="/admin/pengumuman" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium {{ Request::is('admin/pengumuman') ? 'text-blue-700 bg-blue-50/80 font-bold' : 'text-slate-500 hover:text-blue-600 hover:bg-slate-50/80' }} rounded-xl transition-all">
                    <i data-lucide="megaphone" class="w-4 h-4"></i>
                    <span>Pengumuman</span>
                </a>

                <a href="/admin/laporan" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium {{ Request::is('admin/laporan') ? 'text-blue-700 bg-blue-50/80 font-bold' : 'text-slate-500 hover:text-blue-600 hover:bg-slate-50/80' }} rounded-xl transition-all">
                    <i data-lucide="trending-up" class="w-4 h-4"></i>
                    <span>Laporan Keuangan</span>
                </a>
            </nav>
        </div>

        <!-- Tombol Logout -->
        <form action="{{ route('logout') }}" method="POST" class="w-full mt-auto">
            @csrf
            <button type="submit" class="flex items-center gap-3 px-4 py-2.5 text-sm font-semibold text-rose-600 hover:bg-rose-50 rounded-xl transition-all w-full text-left cursor-pointer">
                <i data-lucide="log-out" class="w-4 h-4"></i>
                <span>Keluar Sistem</span>
            </button>
        </form>
    </aside>

    <!-- KONTEN SISI KANAN -->
    <div class="flex-1 flex flex-col overflow-y-auto">
        <!-- HEADER UTAMA -->
        <header class="bg-white border-b border-slate-100 px-8 py-4 flex items-center justify-between shrink-0 sticky top-0 z-10 shadow-xs">
            <div>
                <h2 class="text-lg font-bold text-slate-900 tracking-tight">@yield('page_title')</h2>
                <p class="text-[11px] text-slate-400 font-medium">Sistem Informasi Pembayaran Keuangan Sekolah</p>
            </div>

            <!-- Profile Admin -->
            <div class="flex items-center gap-3">
                <div class="text-right">
                    <p class="text-xs font-bold text-slate-900">Admin TK</p>
                    <p class="text-[10px] font-medium text-slate-400">Administrator</p>
                </div>
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&q=80&w=100" class="w-9 h-9 rounded-xl object-cover ring-2 ring-slate-100">
                    <span class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-emerald-500 border-2 border-white rounded-full"></span>
                </div>
            </div>
        </header>

        <!-- AREA MAIN CONTENT -->
        <main class="p-8 space-y-6 max-w-7xl w-full mx-auto">
            @yield('content')
        </main>
    </div>

    <script>lucide.createIcons();</script>
</body>
</html>