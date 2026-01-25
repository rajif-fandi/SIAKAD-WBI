@extends('layouts.app')

@section('content')

{{-- Welcome Section --}}
<div class="relative bg-gradient-to-br from-[#1F653F] via-[#2F8054] to-[#47AF76] text-white p-8 rounded-3xl mb-8 shadow-2xl overflow-hidden">
    <div class="relative z-10 flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-extrabold mb-2">Dashboard Akademik</h2>
            <p class="text-emerald-100 text-lg mb-1">Selamat Datang, Bagian Akademik</p>
            <p class="text-emerald-200 text-sm">Kelola kurikulum, mata kuliah, dan jadwal perkuliahan</p>
        </div>
        <div class="text-right">
            <div class="bg-white/20 backdrop-blur-sm rounded-2xl p-6 mb-2 border border-white/20 shadow-xl">
                <p class="text-xs uppercase tracking-wider font-bold opacity-80 mb-1">Semester Aktif</p>
                <p class="text-2xl font-black">{{ $stats['active_semester']->nama_semester ?? 'Tidak Ada Semester Aktif' }}</p>
            </div>
        </div>
    </div>
    <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full -ml-24 -mb-24 blur-2xl"></div>
</div>

{{-- Quick Stats Grid --}}
<div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6 mb-8">
    {{-- Total Matakuliah --}}
    <a href="{{ route('akademik.matakuliah.index') }}" class="group bg-white p-6 rounded-3xl shadow-lg border border-gray-100 hover:border-[#1F653F]/30 hover:shadow-2xl transition-all duration-300 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-[#1F653F]/10 to-transparent rounded-bl-full"></div>
        <div class="relative z-10">
            <div class="w-14 h-14 bg-gradient-to-br from-[#1F653F] to-[#2F8054] rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"></path>
                </svg>
            </div>
            <p class="text-sm text-gray-600 font-bold mb-1">Mata Kuliah</p>
            <p class="text-3xl font-black text-gray-900">{{ number_format($stats['total_matakuliah']) }}</p>
        </div>
    </a>

    {{-- Total Kurikulum --}}
    <a href="{{ route('akademik.kurikulum.index') }}" class="group bg-white p-6 rounded-3xl shadow-lg border border-gray-100 hover:border-blue-200 hover:shadow-2xl transition-all duration-300 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-500/10 to-transparent rounded-bl-full"></div>
        <div class="relative z-10">
            <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
                </svg>
            </div>
            <p class="text-sm text-gray-600 font-bold mb-1">Kurikulum</p>
            <p class="text-3xl font-black text-gray-900">{{ number_format($stats['total_kurikulum']) }}</p>
        </div>
    </a>

    {{-- Total Kelas --}}
    <a href="{{ route('akademik.kelas.index') }}" class="group bg-white p-6 rounded-3xl shadow-lg border border-gray-100 hover:border-purple-200 hover:shadow-2xl transition-all duration-300 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-purple-500/10 to-transparent rounded-bl-full"></div>
        <div class="relative z-10">
            <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-fuchsia-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path>
                </svg>
            </div>
            <p class="text-sm text-gray-600 font-bold mb-1">Kelas Kuliah</p>
            <p class="text-3xl font-black text-gray-900">{{ number_format($stats['total_kelas']) }}</p>
        </div>
    </a>

    {{-- Total Dosen --}}
    <div class="group bg-white p-6 rounded-3xl shadow-lg border border-gray-100 hover:border-amber-200 hover:shadow-2xl transition-all duration-300 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-amber-500/10 to-transparent rounded-bl-full"></div>
        <div class="relative z-10">
            <div class="w-14 h-14 bg-gradient-to-br from-amber-500 to-orange-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
                </svg>
            </div>
            <p class="text-sm text-gray-600 font-bold mb-1">Total Dosen</p>
            <p class="text-3xl font-black text-gray-900">{{ number_format($stats['total_dosen']) }}</p>
        </div>
    </div>

    {{-- Total Prodi --}}
    <a href="{{ route('akademik.prodi.index') }}" class="group bg-white p-6 rounded-3xl shadow-lg border border-gray-100 hover:border-emerald-200 hover:shadow-2xl transition-all duration-300 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-emerald-500/10 to-transparent rounded-bl-full"></div>
        <div class="relative z-10">
            <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-green-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"></path>
                </svg>
            </div>
            <p class="text-sm text-gray-600 font-bold mb-1">Program Studi</p>
            <p class="text-3xl font-black text-gray-900">{{ number_format($stats['total_prodi']) }}</p>
        </div>
    </a>

    {{-- Total Mahasiswa --}}
    <div class="group bg-white p-6 rounded-3xl shadow-lg border border-gray-100 hover:border-emerald-200 hover:shadow-2xl transition-all duration-300 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-emerald-500/10 to-transparent rounded-bl-full"></div>
        <div class="relative z-10">
            <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-green-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                </svg>
            </div>
            <p class="text-sm text-gray-600 font-bold mb-1">Mahasiswa</p>
            <p class="text-3xl font-black text-gray-900">{{ number_format($stats['total_mahasiswa']) }}</p>
        </div>
    </div>
</div>

{{-- Quick Actions & Recent Info --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
    {{-- Main Actions --}}
    <div class="bg-white p-8 rounded-3xl shadow-lg border border-gray-100">
        <h3 class="text-xl font-black text-gray-900 mb-6 flex items-center gap-3">
            <div class="w-1.5 h-8 bg-[#1F653F] rounded-full"></div>
            Aksi Cepat Manajemen
        </h3>
        <div class="grid grid-cols-2 gap-4">
            <a href="{{ route('akademik.prodi.index') }}" class="p-6 bg-gradient-to-br from-red-50 to-orange-50 border-2 border-red-100 rounded-2xl hover:border-red-400 hover:shadow-xl transition-all group">
                <div class="w-10 h-10 bg-red-500 text-white rounded-xl flex items-center justify-center mb-3 group-hover:rotate-12 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <p class="font-black text-gray-900">Program Studi</p>
                <p class="text-xs text-gray-600 mt-1">Kelola data program studi</p>
            </a>
            <a href="{{ route('akademik.matakuliah.index') }}" class="p-6 bg-gradient-to-br from-emerald-50 to-green-50 border-2 border-emerald-100 rounded-2xl hover:border-emerald-400 hover:shadow-xl transition-all group">
                <div class="w-10 h-10 bg-emerald-500 text-white rounded-xl flex items-center justify-center mb-3 group-hover:rotate-12 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <p class="font-black text-gray-900">Mata Kuliah</p>
                <p class="text-xs text-gray-600 mt-1">Tambah data mata kuliah baru</p>
            </a>
            <a href="{{ route('akademik.jadwal.index') }}" class="p-6 bg-gradient-to-br from-amber-50 to-orange-50 border-2 border-amber-100 rounded-2xl hover:border-amber-400 hover:shadow-xl transition-all group">
                <div class="w-10 h-10 bg-amber-500 text-white rounded-xl flex items-center justify-center mb-3 group-hover:rotate-12 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <p class="font-black text-gray-900">Jadwal Kuliah</p>
                <p class="text-xs text-gray-600 mt-1">Atur jadwal perkuliahan hari ini</p>
            </a>
            <a href="{{ route('akademik.kurikulum.index') }}" class="p-6 bg-gradient-to-br from-blue-50 to-indigo-50 border-2 border-blue-100 rounded-2xl hover:border-blue-400 hover:shadow-xl transition-all group">
                <div class="w-10 h-10 bg-blue-500 text-white rounded-xl flex items-center justify-center mb-3 group-hover:rotate-12 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <p class="font-black text-gray-900">Kurikulum</p>
                <p class="text-xs text-gray-600 mt-1">Struktur kurikulum prodi</p>
            </a>
            <a href="{{ route('akademik.kelas.index') }}" class="p-6 bg-gradient-to-br from-purple-50 to-fuchsia-50 border-2 border-purple-100 rounded-2xl hover:border-purple-400 hover:shadow-xl transition-all group">
                <div class="w-10 h-10 bg-purple-500 text-white rounded-xl flex items-center justify-center mb-3 group-hover:rotate-12 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <p class="font-black text-gray-900">Kelas Kuliah</p>
                <p class="text-xs text-gray-600 mt-1">Manajemen kelas perkuliahan</p>
            </a>
        </div>
    </div>

    {{-- Recent Activity --}}
    <div class="bg-white p-8 rounded-3xl shadow-lg border border-gray-100">
        <h3 class="text-xl font-black text-gray-900 mb-6 flex items-center gap-3">
            <div class="w-1.5 h-8 bg-blue-600 rounded-full"></div>
            Aktivitas Terbaru
        </h3>
        <div class="space-y-4">
            @forelse($recentActivities as $activity)
                @php
                    $iconColor = [
                        'CREATE' => 'emerald',
                        'UPDATE' => 'blue',
                        'DELETE' => 'red'
                    ][$activity->action] ?? 'gray';
                @endphp
                <div class="p-4 bg-gray-50 rounded-2xl flex items-center gap-4 hover:bg-gray-100 transition-all border border-transparent hover:border-gray-200">
                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-sm text-{{ $iconColor }}-600">
                        @if($activity->action == 'CREATE')
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        @elseif($activity->action == 'UPDATE')
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        @else
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        @endif
                    </div>
                    <div>
                        <p class="font-bold text-gray-900 text-sm">{{ $activity->description }}</p>
                        <p class="text-[10px] text-gray-500 flex items-center gap-1 mt-1">
                            <span class="font-bold text-gray-700">{{ $activity->user->name }}</span>
                            <span>•</span>
                            <span>{{ $activity->created_at->diffForHumans() }}</span>
                        </p>
                    </div>
                </div>
            @empty
                <div class="text-center py-8">
                    <p class="text-gray-500 text-sm">Belum ada aktivitas tercatat.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

@endsection