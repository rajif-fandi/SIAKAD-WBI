@extends('layouts.app')

@section('content')

{{-- Welcome Section --}}
<div class="relative bg-gradient-to-br from-[#1F653F] via-[#2F8054] to-[#47AF76] text-white p-8 rounded-3xl mb-8 shadow-2xl overflow-hidden">
    <div class="relative z-10 flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-bold mb-2">Dashboard Administrator</h2>
            <p class="text-purple-100 text-lg mb-1">Selamat Datang, Admin SIAKAD</p>
            <p class="text-purple-200 text-sm">Kelola seluruh data akademik institusi</p>
        </div>
        <div class="text-right">
            <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-xl p-4 mb-2">
                <p class="text-sm opacity-90">Semester Aktif</p>
                <p class="text-2xl font-bold">2025/2026 Ganjil</p>
            </div>
            <p class="text-sm text-purple-200">Selasa, 7 Januari 2025</p>
        </div>
    </div>
    <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -mr-32 -mt-32"></div>
    <div class="absolute bottom-0 left-0 w-48 h-48 bg-white opacity-5 rounded-full -ml-24 -mb-24"></div>
</div>

{{-- Quick Stats --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-6">
    {{-- Total Mahasiswa --}}
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white p-6 rounded-2xl shadow-lg relative overflow-hidden group hover:scale-105 transition-transform cursor-pointer">
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-3">
                <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-sm opacity-90 mb-1">Total Mahasiswa</p>
            <p class="text-4xl font-bold">1,247</p>
            <p class="text-xs opacity-75 mt-1">Mahasiswa Aktif</p>
        </div>
        <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-white opacity-10 rounded-full"></div>
    </div>

    {{-- Total Dosen --}}
    <div class="bg-gradient-to-br from-green-500 to-green-600 text-white p-6 rounded-2xl shadow-lg relative overflow-hidden group hover:scale-105 transition-transform cursor-pointer">
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-3">
                <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-sm opacity-90 mb-1">Total Dosen</p>
            <p class="text-4xl font-bold">87</p>
            <p class="text-xs opacity-75 mt-1">Dosen Aktif</p>
        </div>
        <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-white opacity-10 rounded-full"></div>
    </div>

    {{-- Total Mata Kuliah --}}
    <div class="bg-gradient-to-br from-orange-500 to-orange-600 text-white p-6 rounded-2xl shadow-lg relative overflow-hidden group hover:scale-105 transition-transform cursor-pointer">
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-3">
                <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-sm opacity-90 mb-1">Mata Kuliah</p>
            <p class="text-4xl font-bold">156</p>
            <p class="text-xs opacity-75 mt-1">Total Mata Kuliah</p>
        </div>
        <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-white opacity-10 rounded-full"></div>
    </div>

    {{-- Akun Pending --}}
    <div class="bg-gradient-to-br from-red-500 to-red-600 text-white p-6 rounded-2xl shadow-lg relative overflow-hidden group hover:scale-105 transition-transform cursor-pointer">
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-3">
                <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
            <p class="text-sm opacity-90 mb-1">Akun Pending</p>
            <p class="text-4xl font-bold">24</p>
            <p class="text-xs opacity-75 mt-1">Perlu Aktivasi</p>
        </div>
        <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-white opacity-10 rounded-full"></div>
    </div>
</div>

{{-- Quick Actions Grid --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    {{-- Kelola Mahasiswa --}}
    <a href="#" class="bg-white rounded-2xl shadow-sm border-2 border-blue-200 hover:border-blue-400 p-6 hover:shadow-xl transition group">
        <div class="flex items-center gap-4 mb-4">
            <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                </svg>
            </div>
            <div class="flex-1">
                <h3 class="text-lg font-bold text-gray-800 group-hover:text-blue-600 transition">Kelola Mahasiswa</h3>
                <p class="text-sm text-gray-600">Tambah, edit, hapus data</p>
            </div>
        </div>
        <div class="flex items-center justify-between text-sm">
            <span class="text-gray-600">1,247 mahasiswa terdaftar</span>
            <svg class="w-5 h-5 text-blue-600 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </div>
    </a>

    {{-- Kelola Dosen --}}
    <a href="#" class="bg-white rounded-2xl shadow-sm border-2 border-green-200 hover:border-green-400 p-6 hover:shadow-xl transition group">
        <div class="flex items-center gap-4 mb-4">
            <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"></path>
                </svg>
            </div>
            <div class="flex-1">
                <h3 class="text-lg font-bold text-gray-800 group-hover:text-green-600 transition">Kelola Dosen</h3>
                <p class="text-sm text-gray-600">Tambah, edit, hapus data</p>
            </div>
        </div>
        <div class="flex items-center justify-between text-sm">
            <span class="text-gray-600">87 dosen terdaftar</span>
            <svg class="w-5 h-5 text-green-600 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </div>
    </a>

    {{-- Kelola Mata Kuliah --}}
    <a href="#" class="bg-white rounded-2xl shadow-sm border-2 border-orange-200 hover:border-orange-400 p-6 hover:shadow-xl transition group">
        <div class="flex items-center gap-4 mb-4">
            <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
                </svg>
            </div>
            <div class="flex-1">
                <h3 class="text-lg font-bold text-gray-800 group-hover:text-orange-600 transition">Kelola Mata Kuliah</h3>
                <p class="text-sm text-gray-600">Tambah, edit, hapus data</p>
            </div>
        </div>
        <div class="flex items-center justify-between text-sm">
            <span class="text-gray-600">156 mata kuliah</span>
            <svg class="w-5 h-5 text-orange-600 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </div>
    </a>
</div>

{{-- Main Content Grid --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    {{-- Recent Registrations --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Pendaftaran Terbaru</h3>
                    <p class="text-sm text-gray-500">Mahasiswa baru</p>
                </div>
                <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm font-semibold">24 Pending</span>
            </div>
        </div>
        <div class="p-6">
            @php
                $registrations = [
                    ['name' => 'Ahmad Fauzi', 'nim' => '2305010089', 'prodi' => 'RPL', 'time' => '2 jam lalu', 'status' => 'pending'],
                    ['name' => 'Siti Nurhaliza', 'nim' => '2305010090', 'prodi' => 'TI', 'time' => '3 jam lalu', 'status' => 'pending'],
                    ['name' => 'Budi Santoso', 'nim' => '2305010091', 'prodi' => 'SI', 'time' => '5 jam lalu', 'status' => 'approved'],
                ];
            @endphp

            <div class="space-y-3">
                @foreach($registrations as $reg)
                <div class="flex items-center gap-4 p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                    <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="text-purple-600 font-bold text-sm">{{ substr($reg['name'], 0, 1) }}</span>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-gray-800 text-sm">{{ $reg['name'] }}</p>
                        <p class="text-xs text-gray-500">{{ $reg['nim'] }} • {{ $reg['prodi'] }} • {{ $reg['time'] }}</p>
                    </div>
                    @if($reg['status'] == 'pending')
                        <button class="px-3 py-1 bg-purple-500 hover:bg-purple-600 text-white rounded-lg text-xs font-semibold transition">
                            Aktivasi
                        </button>
                    @else
                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Aktif</span>
                    @endif
                </div>
                @endforeach
            </div>
            <button class="w-full mt-4 py-2 text-purple-600 hover:text-purple-700 font-semibold text-sm">
                Lihat Semua Pendaftaran →
            </button>
        </div>
    </div>

    {{-- System Stats --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-800">Statistik Sistem</h3>
            <p class="text-sm text-gray-500">Data per semester</p>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-blue-50 border border-blue-200 rounded-xl">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Mahasiswa Aktif</p>
                            <p class="text-2xl font-bold text-gray-800">1,247</p>
                        </div>
                    </div>
                    <span class="text-green-600 text-sm font-semibold">+12%</span>
                </div>

                <div class="flex items-center justify-between p-4 bg-green-50 border border-green-200 rounded-xl">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Kelas Dibuka</p>
                            <p class="text-2xl font-bold text-gray-800">342</p>
                        </div>
                    </div>
                    <span class="text-green-600 text-sm font-semibold">+8%</span>
                </div>

                <div class="flex items-center justify-between p-4 bg-orange-50 border border-orange-200 rounded-xl">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-orange-500 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">KRS Disetujui</p>
                            <p class="text-2xl font-bold text-gray-800">1,108</p>
                        </div>
                    </div>
                    <span class="text-orange-600 text-sm font-semibold">88.8%</span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Quick Links --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <a href="#" class="bg-white border-2 border-gray-200 hover:border-purple-400 rounded-xl p-4 hover:shadow-lg transition group">
        <div class="text-center">
            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <p class="font-semibold text-gray-800 text-sm">Aktivasi Akun</p>
            <p class="text-xs text-gray-500 mt-1">24 pending</p>
        </div>
    </a>

    <a href="#" class="bg-white border-2 border-gray-200 hover:border-purple-400 rounded-xl p-4 hover:shadow-lg transition group">
        <div class="text-center">
            <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
                </svg>
            </div>
            <p class="font-semibold text-gray-800 text-sm">Data Master</p>
            <p class="text-xs text-gray-500 mt-1">Kelola master data</p>
        </div>
    </a>

    <a href="#" class="bg-white border-2 border-gray-200 hover:border-purple-400 rounded-xl p-4 hover:shadow-lg transition group">
        <div class="text-center">
            <div class="w-12 h-12 bg-pink-100 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6 text-pink-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <p class="font-semibold text-gray-800 text-sm">Jadwal Kuliah</p>
            <p class="text-xs text-gray-500 mt-1">Atur jadwal</p>
        </div>
    </a>

    <a href="#" class="bg-white border-2 border-gray-200 hover:border-purple-400 rounded-xl p-4 hover:shadow-lg transition group">
        <div class="text-center">
            <div class="w-12 h-12 bg-yellow -100 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <p class="font-semibold text-gray-800 text-sm">Laporan</p>
            <p class="text-xs text-gray-500 mt-1">Lihat laporan</p>
        </div>
    </a>
</div>

{{-- Activity Log --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-bold text-gray-800">Aktivitas Terkini</h3>
                <p class="text-sm text-gray-500">Log aktivitas sistem</p>
            </div>
            <a href="#" class="text-sm text-purple-600 hover:text-purple-700 font-semibold">Lihat Semua</a>
        </div>
    </div>
    <div class="p-6">
        @php
            $activities = [
                ['user' => 'Admin Sistem', 'action' => 'mengaktifkan akun mahasiswa', 'target' => 'Budi Santoso (2305010091)', 'time' => '10 menit lalu', 'type' => 'success'],
                ['user' => 'Admin Akademik', 'action' => 'menambahkan mata kuliah baru', 'target' => 'Pemrograman Web Lanjut', 'time' => '25 menit lalu', 'type' => 'info'],
                ['user' => 'Admin Sistem', 'action' => 'mengubah data dosen', 'target' => 'Dr. Ahmad Yani', 'time' => '1 jam lalu', 'type' => 'warning'],
                ['user' => 'Admin Akademik', 'action' => 'menyetujui KRS mahasiswa', 'target' => '15 mahasiswa', 'time' => '2 jam lalu', 'type' => 'success'],
                ['user' => 'Admin Sistem', 'action' => 'menghapus jadwal kuliah', 'target' => 'Basis Data - Kelas A', 'time' => '3 jam lalu', 'type' => 'danger'],
            ];
        @endphp

        <div class="space-y-3">
            @foreach($activities as $activity)
            <div class="flex items-start gap-3 p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 mt-1
                    @if($activity['type'] == 'success') bg-green-100
                    @elseif($activity['type'] == 'info') bg-blue-100
                    @elseif($activity['type'] == 'warning') bg-yellow-100
                    @else bg-red-100
                    @endif">
                    <span class="text-xs font-bold
                        @if($activity['type'] == 'success') text-green-600
                        @elseif($activity['type'] == 'info') text-blue-600
                        @elseif($activity['type'] == 'warning') text-yellow-600
                        @else text-red-600
                        @endif">
                        {{ substr($activity['user'], 0, 1) }}
                    </span>
                </div>
                <div class="flex-1">
                    <p class="text-sm text-gray-800">
                        <span class="font-semibold">{{ $activity['user'] }}</span>
                        {{ $activity['action'] }}
                        <span class="font-semibold text-purple-600">{{ $activity['target'] }}</span>
                    </p>
                    <p class="text-xs text-gray-500 mt-1">{{ $activity['time'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection