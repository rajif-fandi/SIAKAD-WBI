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
        .notification-dropdown::-webkit-scrollbar { width: 4px; }
        .notification-dropdown::-webkit-scrollbar-track { background: transparent; }
        .notification-dropdown::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    </style>
</head>
<body class="bg-gray-50/50">

    @php
        $user = Auth::user();
        $mahasiswa = \App\Models\Mahasiswa::where('user_id', $user->id)->first();
        $notifications = $user ? \App\Models\Notifikasi::where('user_id', $user->id)->orderBy('created_at', 'desc')->get() : collect();
        $unreadNotifications = $notifications->where('is_read', false);
        $unreadCount = $unreadNotifications->count();

        $title = 'Beranda Mahasiswa';
        if (request()->routeIs('jadwal.*')) {
            $title = 'Jadwal Kuliah';
        } elseif (request()->routeIs('KRS.*')) {
            $title = 'Rencana Studi';
        } elseif (request()->routeIs('keberhasilanStudi.*')) {
            $title = 'Keberhasilan Studi';
        } elseif (request()->routeIs('konsultasiNilai.*')) {
            $title = 'Konsultasi Nilai';
        } elseif (request()->routeIs('kehadiran.*')) {
            $title = 'Kehadiran Mahasiswa';
        } elseif (request()->routeIs('profilMahasiswa.*')) {
            $title = 'Profil Mahasiswa';
        } elseif (request()->routeIs('kuliahMahasiswa.*')) {
            $title = 'Data Kuliah Mahasiswa';
        } elseif (request()->routeIs('arsip-nilai.*')) {
            $title = 'Arsip Nilai Mahasiswa';
        } elseif (request()->routeIs('pengajuanJudul.*')) {
            $title = 'Pengajuan Judul';
        } elseif (request()->routeIs('nilaiTransfer.*')) {
            $title = 'Nilai Transfer';
        } elseif (request()->routeIs('notifikasi.*')) {
            $title = 'Riwayat Notifikasi';
        }
    @endphp

    @php
        $user = Auth::user();
        $dosen = \App\Models\Dosen::where('user_id', $user->id)->first();
        $notifications = $user ? \App\Models\Notifikasi::where('user_id', $user->id)->orderBy('created_at', 'desc')->get() : collect();
        $unreadNotifications = $notifications->where('is_read', false);
        $unreadCount = $unreadNotifications->count();

       $title = 'Dashboard Dosen';
    if (request()->routeIs('dosen.jadwal')) {
        $title = 'Jadwal Mengajar';
    } elseif (request()->routeIs('dosen.KRSMahasiswa')) {
        $title = 'Validasi KRS Mahasiswa';
    } elseif (request()->routeIs('dosen.penilaian')) {
        $title = 'Penilaian Mata Kuliah';
    } elseif (request()->routeIs('dosen.profilDosen')) {
        $title = 'Bimbingan Tugas Akhir';
    }
    @endphp

    @php     
    $user = Auth::user();
    $notifications = $user
        ? \App\Models\Notifikasi::where('user_id', $user->id)->latest()->get()
        : collect();

    $unreadNotifications = $notifications->where('is_read', false);
    $unreadCount = $unreadNotifications->count();

    $title = 'Dashboard';
    if ($user->role === 'admin') {
        $title = 'Dashboard Admin';
        if (request()->routeIs('admin.mahasiswa.mahasiswa')) {
            $title = 'Kelola Mahasiswa';
        } elseif (request()->routeIs('admin.dosen.index')) {
            $title = 'Kelola Dosen';
        } elseif (request()->routeIs('admin.mahasiswa.aktivasiAkun')) {
            $title = 'Aktivasi Akun Mahasiswa';
        }
    }
    @endphp

    @php
    $user = Auth::user();
    $notifications = $user ?\app\Models\Notifikasi::where('user_id', $user->id)->latest()->get() : collect();

    $unreadNotifications = $notifications->where('is_read', false);
    $unreadCount = $unreadNotifications->count();

    $title = 'Dashboard';
    if ($user->role === 'Akademik') {
        $title = 'Dashboard Akademik';
    }elseif (request()->routeIs('akademik.matakuliah.index')){
        $title = 'Kelola Matakuliah';
    }elseif (request()->routeIs('akademik.kurikulum.index')){
        $title = 'Kelola Kurikulum';
    }elseif (request()->routeIs('akademik.kelas.index')){
        $title = 'Kelola Kelas';
    }elseif (request()->routeIs('akademik.jadwal.index')){
        $title = 'Kelola Jadwal';
    }
    @endphp

    <nav class="sticky top-0 z-50 w-full border-b border-gray-200/80 bg-white/80 backdrop-blur-xl">
        <div class="px-6 py-4">
            <div class="flex items-center justify-between">
                
                <div class="flex items-center gap-6">
                    <a href="{{ route('dashboard.index') }}" class="block">
                        <img src="{{ asset('img/logo-wbi2.png') }}" alt="Logo Universitas WBI" class="h-12">
                    </a>

                    <div class="hidden h-8 w-px bg-gray-200 lg:block"></div>

                    <div class="hidden lg:block">
                        <h2 class="text-sm font-semibold text-gray-700">{{ $title }}</h2>
                    </div>
                </div>

                {{-- Search Bar --}}
                <div class="hidden max-w-md flex-1 px-12 md:block">
                    <div class="relative group">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-4 w-4 text-gray-400 group-focus-within:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" class="block w-full rounded-2xl border border-gray-100 bg-gray-50/50 py-2.5 pl-10 pr-3 text-sm text-gray-900 placeholder-gray-500 shadow-sm transition-all focus:border-emerald-500 focus:bg-white focus:ring-1 focus:ring-emerald-500" placeholder="Cari mata kuliah, jadwal, atau dosen...">
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    
                    {{-- Notifications Dropdown --}}
                    <div class="relative" id="notification-dropdown-parent">
                        <button onclick="toggleNotifications()" class="relative rounded-xl p-2.5 text-gray-500 transition-all hover:bg-gray-100 hover:text-emerald-600 focus:outline-none">
                            @if($unreadCount > 0)
                                <span class="absolute right-2.5 top-2.5 flex h-4 w-4 transform translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-full bg-red-500 text-[10px] font-bold text-white ring-2 ring-white">
                                    {{ $unreadCount }}
                                </span>
                            @endif
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        </button>

                        <div id="notification-menu" class="absolute right-0 mt-3 hidden w-80 origin-top-right rounded-2xl border border-gray-100 bg-white shadow-2xl ring-1 ring-black/5 focus:outline-none">
                            <div class="p-4 border-b border-gray-50 flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <h3 class="text-sm font-bold text-gray-800">Notifikasi Baru</h3>
                                    @if($unreadCount > 0)
                                        <span class="text-[10px] px-2 py-1 bg-emerald-50 text-emerald-600 rounded-full font-bold">{{ $unreadCount }}</span>
                                    @endif
                                </div>
                                <a href="{{ route('notifikasi.index') }}" class="text-[10px] font-bold text-blue-600 hover:underline uppercase tracking-wider">Lihat Semua</a>
                            </div>
                            <div class="notification-dropdown max-h-96 overflow-y-auto">
                                @forelse($unreadNotifications as $notif)
                                <a href="{{ route('notifikasi.read', $notif->id) }}" class="block px-4 py-4 hover:bg-gray-50 transition-colors border-b border-gray-50 last:border-0 {{ !$notif->is_read ? 'bg-blue-50/10' : '' }}">
                                    <div class="flex gap-3">
                                        <div class="flex-shrink-0 mt-0.5">
                                            @php
                                                $iconColor = $notif->tipe == 'krs' ? 'blue' : ($notif->tipe == 'pembayaran' ? 'orange' : 'emerald');
                                            @endphp
                                            <div class="w-8 h-8 rounded-full bg-{{ $iconColor }}-100 flex items-center justify-center">
                                                <svg class="w-4 h-4 text-{{ $iconColor }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-xs font-bold text-gray-800 mb-0.5">{{ $notif->judul }}</p>
                                            <p class="text-xs text-gray-500 line-clamp-2 leading-relaxed">{{ $notif->pesan }}</p>
                                            <p class="text-[10px] text-gray-400 mt-2 flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                {{ $notif->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                                @empty
                                <div class="px-4 py-12 text-center text-gray-400">
                                    <svg class="w-12 h-12 mx-auto mb-2 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                    <p class="text-xs italic">Tidak ada pesan baru</p>
                                </div>
                                @endforelse
                            </div>
                            @if($unreadCount > 0)
                            <div class="p-3 border-t border-gray-50 text-center">
                                <form action="{{ route('notifikasi.readAll') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full py-2 text-[10px] font-bold text-emerald-600 hover:text-emerald-700 uppercase tracking-widest transition-colors">
                                        Tandai Semua Selesai
                                    </button>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- User Profile --}}
                    <div class="relative" id="profile-dropdown-parent">
                        <button onclick="toggleProfile()" class="flex items-center gap-3 rounded-full border border-gray-100 bg-white p-1.5 shadow-sm transition-all hover:shadow-md hover:border-gray-200 cursor-pointer pr-4 group">
                            <div class="h-8 w-8 overflow-hidden rounded-full bg-emerald-100 ring-2 ring-white">
                               @if($mahasiswa && $mahasiswa->foto)
                                   <img src="{{ asset('storage/' . $mahasiswa->foto) }}" alt="Avatar" class="h-full w-full object-cover">
                               @else
                                   <img src="https://ui-avatars.com/api/?name={{ urlencode($mahasiswa->nama ?? $user->name) }}&background=059669&color=fff" alt="Avatar" class="h-full w-full object-cover">
                               @endif
                            </div>
                            <div class="hidden text-left sm:block">
                                <p class="text-xs font-bold text-gray-700 group-hover:text-emerald-700 transition-colors">{{ $mahasiswa->nama ?? $user->name }}</p>
                                <p class="text-[10px] text-gray-500">{{ ucfirst($user->role) }}</p>
                            </div>
                            <svg class="hidden h-4 w-4 text-gray-400 sm:block group-hover:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>

                        {{-- Profile Dropdown Menu --}}
                        <div id="profile-menu" class="absolute right-0 mt-3 hidden w-48 origin-top-right rounded-2xl border border-gray-100 bg-white shadow-2xl ring-1 ring-black/5 focus:outline-none overflow-hidden">
                            <div class="py-1">
                                @php
                                    $profileRoute = '#';
                                    if ($user->role === 'mahasiswa') $profileRoute = route('profilMahasiswa.index');
                                    elseif ($user->role === 'dosen') $profileRoute = route('dosen.profilDosen');
                                    elseif ($user->role === 'admin') $profileRoute = route('admin.profile');
                                    elseif ($user->role === 'akademik') $profileRoute = route('akademik.profile');
                                @endphp
                                <a href="{{ $profileRoute }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    <span>Profil Saya</span>
                                </a>
                                <hr class="border-gray-50">
                                <form action="{{ route('logout') }}" method="POST" id="logout-form">
                                    @csrf
                                    <button type="submit" class="flex w-full items-center gap-3 px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                        <span>Keluar Sistem</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </nav>

    <script>
        function toggleNotifications() {
            const menu = document.getElementById('notification-menu');
            const profileMenu = document.getElementById('profile-menu');
            menu.classList.toggle('hidden');
            if (profileMenu) profileMenu.classList.add('hidden');
        }

        function toggleProfile() {
            const menu = document.getElementById('profile-menu');
            const notifMenu = document.getElementById('notification-menu');
            menu.classList.toggle('hidden');
            if (notifMenu) notifMenu.classList.add('hidden');
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            const notifDropdown = document.getElementById('notification-dropdown-parent');
            const profileDropdown = document.getElementById('profile-dropdown-parent');
            
            if (notifDropdown && !notifDropdown.contains(event.target)) {
                document.getElementById('notification-menu').classList.add('hidden');
            }
            if (profileDropdown && !profileDropdown.contains(event.target)) {
                document.getElementById('profile-menu').classList.add('hidden');
            }
        });
    </script>

</body>
</html>