<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - TK Mutiara Bogor</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .font-display {
            font-family: 'Fredoka', sans-serif;
        }

        .hero-panel {
            background: linear-gradient(160deg, #2F7FE0 0%, #1652A8 55%, #0E3A80 100%);
        }

        .block-shadow {
            filter: drop-shadow(0 12px 20px rgba(6, 27, 61, 0.35));
        }

        @keyframes floaty {
            0%, 100% { transform: translateY(0px) rotate(var(--rot, 0deg)); }
            50% { transform: translateY(-6px) rotate(var(--rot, 0deg)); }
        }

        .block-float {
            animation: floaty 5s ease-in-out infinite;
        }

        @media (prefers-reduced-motion: reduce) {
            .block-float { animation: none; }
        }
    </style>
</head>

<body class="bg-[#EEF4FA] min-h-screen flex items-center justify-center p-4 antialiased">

    <div class="bg-white rounded-[32px] shadow-xl max-w-4xl w-full overflow-hidden flex flex-col md:flex-row p-4 gap-4">

        <!-- LEFT: brand / hero panel -->
        <div class="hero-panel w-full md:w-1/2 rounded-[24px] p-8 md:p-10 flex flex-col justify-between relative overflow-hidden min-h-[280px] md:min-h-[560px] text-white">

            <div class="absolute -top-16 -right-16 w-56 h-56 bg-white/5 rounded-full"></div>
            <div class="absolute -bottom-20 -left-16 w-56 h-56 bg-black/10 rounded-full"></div>

            <!-- eyebrow -->
            <div class="relative flex items-center gap-2 text-[11px] font-bold uppercase tracking-widest text-blue-100/80">
                <i data-lucide="shield-check" class="w-3.5 h-3.5"></i>
                <span>Portal Khusus Admin</span>
            </div>

            <!-- signature illustration: alphabet blocks -->
            <div class="relative flex items-center justify-center py-8 md:py-10">
                <svg viewBox="0 0 260 170" class="w-52 md:w-64 block-shadow" xmlns="http://www.w3.org/2000/svg">
                    <ellipse cx="130" cy="152" rx="88" ry="12" fill="#06224F" opacity="0.35" />

                    <g class="block-float" style="--rot:-6deg; transform-origin:70px 120px;">
                        <rect x="30" y="90" width="70" height="70" rx="16" fill="#FFFFFF" opacity="0.14" stroke="#FFFFFF" stroke-opacity="0.35" stroke-width="2" />
                        <text x="65" y="137" text-anchor="middle" font-family="Fredoka, sans-serif" font-weight="600" font-size="34" fill="#FFC24B">T</text>
                    </g>

                    <g class="block-float" style="--rot:5deg; transform-origin:190px 108px; animation-delay: -1.4s;">
                        <rect x="155" y="78" width="70" height="70" rx="16" fill="#FFFFFF" opacity="0.14" stroke="#FFFFFF" stroke-opacity="0.35" stroke-width="2" />
                        <text x="190" y="126" text-anchor="middle" font-family="Fredoka, sans-serif" font-weight="600" font-size="34" fill="#FFC24B">K</text>
                    </g>

                    <g class="block-float" style="--rot:-3deg; transform-origin:128px 55px; animation-delay: -2.8s;">
                        <rect x="93" y="20" width="70" height="70" rx="16" fill="#FFFFFF" opacity="0.22" stroke="#FFFFFF" stroke-opacity="0.45" stroke-width="2" />
                        <text x="128" y="68" text-anchor="middle" font-family="Fredoka, sans-serif" font-weight="600" font-size="34" fill="#FFFFFF">M</text>
                    </g>

                    <circle cx="222" cy="48" r="6" fill="#FFC24B" />
                    <circle cx="42" cy="70" r="4" fill="#FFC24B" opacity="0.7" />
                </svg>
            </div>

            <!-- headline + features -->
            <div class="relative space-y-5">
                <div class="space-y-2">
                    <h3 class="font-display font-semibold text-2xl leading-snug tracking-tight">
                        Kelola pembayaran TK<br class="hidden md:block"> dengan lebih tenang
                    </h3>
                    <p class="text-[13px] text-blue-100/90 leading-relaxed max-w-xs">
                        Satu tempat untuk mengelola administrasi dan keuangan siswa — mudah, transparan, dan rapi.
                    </p>
                </div>

                <ul class="space-y-2.5 text-[12.5px] font-medium text-blue-50/95">
                    <li class="flex items-center gap-2.5">
                        <span class="flex items-center justify-center w-5 h-5 rounded-full bg-white/15 shrink-0">
                            <i data-lucide="wallet" class="w-3 h-3"></i>
                        </span>
                        Catat pembayaran siswa secara real-time
                    </li>
                    <li class="flex items-center gap-2.5">
                        <span class="flex items-center justify-center w-5 h-5 rounded-full bg-white/15 shrink-0">
                            <i data-lucide="users" class="w-3 h-3"></i>
                        </span>
                        Pantau tunggakan tiap siswa dengan mudah
                    </li>
                    <li class="flex items-center gap-2.5">
                        <span class="flex items-center justify-center w-5 h-5 rounded-full bg-white/15 shrink-0">
                            <i data-lucide="bar-chart-3" class="w-3 h-3"></i>
                        </span>
                        Laporan keuangan tersusun otomatis
                    </li>
                </ul>
            </div>
        </div>

        <!-- RIGHT: form -->
        <div class="w-full md:w-1/2 p-6 md:p-10 flex flex-col justify-center space-y-6">

            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="p-2.5 bg-[#1E88E5] text-white rounded-xl shadow-md shadow-blue-100">
                        <i data-lucide="book-open" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-800 text-sm tracking-tight">TK Mutiara Bogor</h4>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Sistem Informasi Pembayaran</p>
                    </div>
                </div>

                <a href="/" class="inline-flex items-center gap-1.5 text-blue-500 hover:text-blue-700 text-[11px] font-semibold transition-colors shrink-0">
                    <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                    Beranda
                </a>
            </div>

            <div>
                <h2 class="font-display font-semibold text-xl text-slate-800">Login Admin</h2>
                <p class="text-xs text-slate-400 font-medium mt-1">
                    Silakan masukkan akun Anda untuk mengakses dashboard admin.
                </p>
            </div>

            @if(session('gagal'))
                <div class="bg-rose-50 border border-rose-100 text-rose-700 px-4 py-2.5 rounded-xl text-xs font-semibold flex items-center gap-2">
                    <i data-lucide="alert-circle" class="w-4 h-4 text-rose-500 shrink-0"></i>
                    <span>{{ session('gagal') }}</span>
                </div>
            @endif

            <form action="/login" method="POST" class="space-y-4">
                @csrf

                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-500">Username</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                            <i data-lucide="user" class="w-4 h-4"></i>
                        </span>
                        <input type="text" name="username" required placeholder="admin"
                            class="w-full pl-10 pr-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-[#1E88E5] focus:bg-white transition-all font-medium text-slate-700">
                    </div>
                </div>

                <div class="space-y-1">
                    <div class="flex items-center justify-between">
                        <label class="text-xs font-semibold text-slate-500">Password</label>
                        <a href="#" class="text-xs text-[#1E88E5] hover:underline font-semibold">Lupa Password?</a>
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                            <i data-lucide="lock" class="w-4 h-4"></i>
                        </span>
                        <input type="password" name="password" required placeholder="••••••••"
                            class="w-full pl-10 pr-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-[#1E88E5] focus:bg-white transition-all font-medium text-slate-700">
                    </div>
                </div>

                <div class="flex items-center gap-2 pt-1">
                    <input type="checkbox" id="remember" name="remember"
                        class="w-4 h-4 rounded border-slate-300 text-[#1E88E5] focus:ring-[#1E88E5]">
                    <label for="remember" class="text-xs text-slate-500 font-medium select-none">Ingat saya di perangkat ini</label>
                </div>

                <button type="submit"
                    class="w-full text-white py-3 rounded-xl text-sm font-semibold transition-all cursor-pointer mt-2 shadow-md shadow-blue-200 flex items-center justify-center gap-2 hover:brightness-105 active:scale-[0.99]"
                    style="background: linear-gradient(120deg, #1E88E5, #0E5FB8);">
                    <span>Masuk ke Dashboard</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </button>
            </form>

            <div class="bg-slate-50 p-2.5 rounded-xl border border-slate-100 text-center">
                <p class="text-[11px] text-slate-500 font-medium">
                    <span class="inline-flex items-center gap-1">
                        <i data-lucide="info" class="w-3 h-3"></i>
                    </span>
                    Akun Demo &rArr; User: <span class="font-bold text-slate-800">admin</span> | Pass: <span class="font-bold text-slate-800">admin123</span>
                </p>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>