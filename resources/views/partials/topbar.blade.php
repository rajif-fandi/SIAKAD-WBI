<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SIAKAD Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50/50">

    <nav class="sticky top-0 z-50 w-full border-b border-gray-200/80 bg-white/80 backdrop-blur-xl">
        <div class="px-6 py-4">
            <div class="flex items-center justify-between">
                
                <div class="flex items-center gap-6">
                    <a href="{{ route('dashboard') }}" class="block">
                        <img src="{{ asset('img/logo-wbi2.png') }}"
                             alt="Logo Universitas WBI"
                             class="h-12">
                    </a>


                    <div class="hidden h-8 w-px bg-gray-200 lg:block"></div>

                    <div class="hidden lg:block">
                        @php
                            $title = 'Beranda Mahasiswa';
                            if (request()->routeIs('jadwal.*')) {
                                $title = 'Jadwal Kuliah';
                            } elseif (request()->routeIs('KRS.*') || request()->is('rencana-studi*')) {
                                $title = 'Rencana Studi';
                            } elseif (request()->routeIs('KeberhasilanStudi.*') || request()->is('keberhasilanStudi*')) {
                                $title = 'Keberhasilan Studi';
                            } elseif (request()->routeIs('KonsultasiNilai.*') || request()->is('konsultasiNilai*')) {
                                $title = 'Konsultasi Nilai Tidak Lulus ';
                            } elseif (request()->routeIs('kehadiran.*') || request()->is('kehadiran*')) {
                                $title = 'Kehadiran Mahasiswa';
                            } elseif (request()->routeIs('profilMahasiswa.*') || request()->is('profilMahasiswa*')) {
                                $title = 'Profil Mahasiswa';
                            }
                        @endphp
                        <h2 class="text-sm font-semibold text-gray-700">{{ $title }}</h2>
                    </div>
                </div>

                <div class="hidden max-w-md flex-1 px-12 md:block">
                    <div class="relative group">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-4 w-4 text-gray-400 group-focus-within:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" class="block w-full rounded-2xl border border-gray-100 bg-gray-50/50 py-2.5 pl-10 pr-3 text-sm text-gray-900 placeholder-gray-500 shadow-sm transition-all focus:border-emerald-500 focus:bg-white focus:ring-1 focus:ring-emerald-500" placeholder="Cari mata kuliah, jadwal, atau dosen...">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-2">
                             <kbd class="inline-flex items-center rounded border border-gray-200 px-1 font-sans text-xs text-gray-400">Ctrl K</kbd>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    
                    <button class="relative rounded-xl p-2.5 text-gray-500 transition-all hover:bg-gray-100 hover:text-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-500/20">
                        <span class="absolute right-2.5 top-2.5 h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    </button>

                    <div class="ml-2 flex items-center gap-3 rounded-full border border-gray-100 bg-white p-1.5 shadow-sm transition-all hover:shadow-md hover:border-gray-200 cursor-pointer pr-4 group">
                        <div class="h-8 w-8 overflow-hidden rounded-full bg-emerald-100 ring-2 ring-white">
                           <img src="https://ui-avatars.com/api/?name=Budi+Doremi&background=059669&color=fff" alt="Budi" class="h-full w-full object-cover">
                        </div>
                        <div class="hidden text-left sm:block">
                            <p class="text-xs font-bold text-gray-700 group-hover:text-emerald-700 transition-colors">Budi Doremi</p>
                            <p class="text-[10px] text-gray-500">Mahasiswa</p>
                        </div>
                        <svg class="hidden h-4 w-4 text-gray-400 sm:block group-hover:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>

                </div>
            </div>
        </div>
    </nav>

</body>
</html>