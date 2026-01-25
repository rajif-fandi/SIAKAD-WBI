@extends('layouts.app')

@section('content')

{{-- Header Section with Enhanced Design --}}
<div class="relative bg-gradient-to-br from-[#1F653F] via-[#2F8054] to-[#47AF76] text-white p-8 rounded-3xl mb-8 shadow-2xl overflow-hidden">
    {{-- Decorative Elements --}}
    <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full -ml-24 -mb-24 blur-2xl"></div>
    
    <div class="relative z-10 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center shadow-xl">
                <svg class="w-9 h-9 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-extrabold tracking-tight">Kelola Jadwal Kuliah</h1>
                <p class="text-emerald-100 text-base mt-1">Manajemen jadwal perkuliahan per semester</p>
            </div>
        </div>
        <button onclick="openAddModal()" class="flex items-center gap-3 bg-white text-[#1F653F] px-8 py-4 rounded-2xl font-bold text-base hover:scale-105 hover:shadow-2xl transition-all shadow-xl active:scale-95 group">
            <div class="w-8 h-8 bg-[#1F653F] rounded-lg flex items-center justify-center group-hover:rotate-90 transition-transform duration-300">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                </svg>
            </div>
            Tambah Jadwal
        </button>
    </div>
</div>

{{-- Filter & Actions --}}
<div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-8">
    <div class="flex items-center justify-between gap-4 flex-wrap">
        <div class="flex items-center gap-3 flex-wrap">
            <select class="border-2 border-gray-300 rounded-xl px-5 py-3.5 text-sm font-bold focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] bg-white transition-all hover:border-[#2F8054]">
                <option selected>2025/2026 Ganjil</option>
                <option>2024/2025 Genap</option>
                <option>2024/2025 Ganjil</option>
            </select>

            <select class="border-2 border-gray-300 rounded-xl px-5 py-3.5 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] bg-white transition-all hover:border-[#2F8054]">
                <option value="">Semua Prodi</option>
                <option>Rekayasa Perangkat Lunak</option>
                <option>Teknik Informatika</option>
                <option>Sistem Informasi</option>
            </select>

            <select class="border-2 border-gray-300 rounded-xl px-5 py-3.5 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] bg-white transition-all hover:border-[#2F8054]">
                <option value="">Semua Hari</option>
                <option>Senin</option>
                <option>Selasa</option>
                <option>Rabu</option>
                <option>Kamis</option>
                <option>Jumat</option>
                <option>Sabtu</option>
            </select>

            <div class="relative group">
                <div class="absolute left-4 top-1/2 transform -translate-y-1/2 w-10 h-10 bg-gradient-to-br from-[#1F653F]/10 to-transparent rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-[#1F653F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="text" placeholder="Cari jadwal..." class="pl-16 pr-4 py-3.5 border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] transition-all text-sm group-hover:border-[#2F8054]">
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button class="px-6 py-3.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-xl text-sm font-bold transition-all shadow-lg hover:shadow-xl active:scale-95 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                </svg>
                Import Excel
            </button>
            <button class="px-6 py-3.5 bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-700 hover:to-green-700 text-white rounded-xl text-sm font-bold transition-all shadow-lg hover:shadow-xl active:scale-95 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                </svg>
                Export PDF
            </button>
        </div>
    </div>
</div>

{{-- Stats with Modern Design --}}
<div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-8">
    <div class="group bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-[#1F653F]/30 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-[#1F653F]/10 to-transparent rounded-bl-full"></div>
        <div class="relative z-10">
            <div class="w-14 h-14 bg-gradient-to-br from-[#1F653F] to-[#2F8054] rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <p class="text-sm text-gray-600 font-semibold mb-2">Total Jadwal</p>
            <p class="text-4xl font-extrabold text-gray-900">342</p>
        </div>
    </div>

    <div class="group bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-blue-200 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-500/10 to-transparent rounded-bl-full"></div>
        <div class="relative z-10">
            <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                <span class="text-white font-extrabold text-lg">SEN</span>
            </div>
            <p class="text-sm text-gray-600 font-semibold mb-2">Senin</p>
            <p class="text-4xl font-extrabold text-gray-900">68</p>
        </div>
    </div>

    <div class="group bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-emerald-200 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-emerald-500/10 to-transparent rounded-bl-full"></div>
        <div class="relative z-10">
            <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-green-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                <span class="text-white font-extrabold text-lg">SEL</span>
            </div>
            <p class="text-sm text-gray-600 font-semibold mb-2">Selasa</p>
            <p class="text-4xl font-extrabold text-gray-900">72</p>
        </div>
    </div>

    <div class="group bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-purple-200 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-purple-500/10 to-transparent rounded-bl-full"></div>
        <div class="relative z-10">
            <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                <span class="text-white font-extrabold text-lg">RAB</span>
            </div>
            <p class="text-sm text-gray-600 font-semibold mb-2">Rabu</p>
            <p class="text-4xl font-extrabold text-gray-900">65</p>
        </div>
    </div>

    <div class="group bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-red-200 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-red-500/10 to-transparent rounded-bl-full"></div>
        <div class="relative z-10">
            <div class="w-14 h-14 bg-gradient-to-br from-red-500 to-rose-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <p class="text-sm text-gray-600 font-semibold mb-2">Konflik</p>
            <p class="text-4xl font-extrabold text-gray-900">3</p>
        </div>
    </div>
</div>

{{-- Calendar View Toggle --}}
<div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-5 mb-8">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-3">
            <button onclick="showView('table')" id="btn-table" class="px-6 py-3 bg-gradient-to-r from-[#1F653F] to-[#2F8054] text-white rounded-xl text-sm font-bold transition-all shadow-lg flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                </svg>
                Tampilan Tabel
            </button>
            <button onclick="showView('calendar')" id="btn-calendar" class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl text-sm font-bold transition-all flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                </svg>
                Tampilan Kalender
            </button>
        </div>
        <p class="text-sm text-gray-600 font-medium">Menampilkan <strong class="text-gray-900">342</strong> jadwal</p>
    </div>
</div>

{{-- Table View --}}
<div id="view-table" class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gradient-to-r from-[#1F653F] via-[#2F8054] to-[#47AF76] text-white">
                    <th class="px-6 py-5 text-left text-sm font-bold uppercase tracking-wider">Hari</th>
                    <th class="px-6 py-5 text-left text-sm font-bold uppercase tracking-wider">Waktu</th>
                    <th class="px-6 py-5 text-left text-sm font-bold uppercase tracking-wider">Mata Kuliah</th>
                    <th class="px-6 py-5 text-left text-sm font-bold uppercase tracking-wider">Kelas</th>
                    <th class="px-6 py-5 text-left text-sm font-bold uppercase tracking-wider">Dosen</th>
                    <th class="px-6 py-5 text-left text-sm font-bold uppercase tracking-wider">Ruangan</th>
                    <th class="px-6 py-5 text-center text-sm font-bold uppercase tracking-wider">Status</th>
                    <th class="px-6 py-5 text-center text-sm font-bold uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @php
                    $jadwal = [
                        ['hari' => 'Senin', 'waktu' => '08:00 - 10:00', 'matkul' => 'Pemrograman Web Lanjut', 'kelas' => 'RPL 3A', 'dosen' => 'Dr. Rizki Ramadhansyah', 'ruangan' => 'Lab Komputer 1', 'status' => 'Aktif'],
                        ['hari' => 'Senin', 'waktu' => '10:00 - 12:00', 'matkul' => 'Basis Data', 'kelas' => 'RPL 2B', 'dosen' => 'Dr. Ahmad Fauzi', 'ruangan' => 'Ruang 4.2', 'status' => 'Aktif'],
                        ['hari' => 'Selasa', 'waktu' => '08:00 - 10:00', 'matkul' => 'Agile Development', 'kelas' => 'RPL 4A', 'dosen' => 'Dr. Rizki Ramadhansyah', 'ruangan' => 'Ruang 4.1', 'status' => 'Aktif'],
                        ['hari' => 'Selasa', 'waktu' => '08:00 - 10:00', 'matkul' => 'Matematika Diskrit', 'kelas' => 'TI 1A', 'dosen' => 'Ir. Siti Rahma', 'ruangan' => 'Ruang 4.1', 'status' => 'Konflik'],
                        ['hari' => 'Rabu', 'waktu' => '13:00 - 15:00', 'matkul' => 'Algoritma dan Struktur Data', 'kelas' => 'RPL 2A', 'dosen' => 'Dr. Budi Santoso', 'ruangan' => 'Lab Komputer 2', 'status' => 'Aktif'],
                    ];
                @endphp

                @foreach($jadwal as $jdw)
                <tr class="hover:bg-gradient-to-r hover:from-emerald-50/50 hover:to-transparent transition-all group">
                    <td class="px-6 py-5">
                        <span class="inline-block bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-4 py-1.5 rounded-lg text-xs font-bold shadow-md">{{ $jdw['hari'] }}</span>
                    </td>
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="text-sm font-bold text-gray-800">{{ $jdw['waktu'] }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-5">
                        <p class="text-sm font-bold text-gray-900">{{ $jdw['matkul'] }}</p>
                    </td>
                    <td class="px-6 py-5">
                        <span class="inline-block bg-gradient-to-r from-purple-500 to-indigo-600 text-white px-4 py-1.5 rounded-lg text-xs font-bold shadow-md">{{ $jdw['kelas'] }}</span>
                    </td>
                    <td class="px-6 py-5">
                        <p class="text-sm text-gray-700 font-medium">{{ $jdw['dosen'] }}</p>
                    </td>
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="text-sm text-gray-700 font-medium">{{ $jdw['ruangan'] }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-5 text-center">
                        @if($jdw['status'] == 'Aktif')
                            <span class="inline-flex items-center gap-1.5 bg-gradient-to-r from-emerald-500 to-green-600 text-white px-4 py-1.5 rounded-lg text-xs font-bold shadow-md">
                                <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span>
                                Aktif
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 bg-gradient-to-r from-red-500 to-rose-600 text-white px-4 py-1.5 rounded-lg text-xs font-bold shadow-md">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                Konflik
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-5">
                        <div class="flex items-center justify-center gap-2">
                            <button class="p-2.5 bg-blue-50 hover:bg-gradient-to-br hover:from-blue-500 hover:to-blue-600 text-blue-600 hover:text-white rounded-xl transition-all shadow-sm hover:shadow-md" title="Detail">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                            <button onclick="openEditModal()" class="p-2.5 bg-emerald-50 hover:bg-gradient-to-br hover:from-[#1F653F] hover:to-[#2F8054] text-emerald-600 hover:text-white rounded-xl transition-all shadow-sm hover:shadow-md" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <button onclick="deleteJadwal()" class="p-2.5 bg-red-50 hover:bg-gradient-to-br hover:from-red-500 hover:to-red-600 text-red-600 hover:text-white rounded-xl transition-all shadow-sm hover:shadow-md" title="Hapus">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="bg-gradient-to-r from-gray-50 to-white px-6 py-5 border-t border-gray-200 flex items-center justify-between">
        <div class="text-sm text-gray-600 font-medium">
            Menampilkan <span class="font-bold text-gray-900">1-5</span> dari <span class="font-bold text-gray-900">342</span> jadwal
        </div>
        <div class="flex items-center gap-2">
            <button class="px-4 py-2 border-2 border-gray-300 rounded-xl text-sm font-semibold hover:bg-gray-100 hover:border-gray-400 transition-all">
                Previous
            </button>
            <button class="px-4 py-2 bg-gradient-to-r from-[#1F653F] to-[#2F8054] text-white rounded-xl text-sm font-bold shadow-md">1</button>
            <button class="px-4 py-2 border-2 border-gray-300 rounded-xl text-sm font-semibold hover:bg-gray-100 hover:border-gray-400 transition-all">2</button>
            <button class="px-4 py-2 border-2 border-gray-300 rounded-xl text-sm font-semibold hover:bg-gray-100 hover:border-gray-400 transition-all">3</button>
            <button class="px-4 py-2 border-2 border-gray-300 rounded-xl text-sm font-semibold hover:bg-gray-100 hover:border-gray-400 transition-all">
                Next
            </button>
        </div>
    </div>
</div>

{{-- Calendar View --}}
<div id="view-calendar" class="hidden bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
    <div class="grid grid-cols-6 gap-6">
        @php
            $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            $timeSlots = ['08:00', '10:00', '13:00', '15:00'];
        @endphp

        @foreach($days as $day)
        <div class="border-2 border-gray-200 rounded-2xl p-5 hover:border-[#1F653F]/30 transition-all">
            <h3 class="font-extrabold text-gray-900 mb-4 pb-3 border-b-2 border-gray-200 text-lg">{{ $day }}</h3>
            <div class="space-y-3">
                @for($i = 0; $i < rand(2, 4); $i++)
                <div class="bg-gradient-to-br from-[#1F653F]/10 to-[#2F8054]/10 border-l-4 border-[#1F653F] p-4 rounded-xl hover:shadow-lg transition-all cursor-pointer group">
                    <p class="text-xs font-bold text-[#1F653F] mb-2 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $timeSlots[array_rand($timeSlots)] }}
                    </p>
                    <p class="text-sm font-bold text-gray-900 mb-1 group-hover:text-[#1F653F] transition-colors">Mata Kuliah {{ $i + 1 }}</p>
                    <p class="text-xs text-gray-600 font-medium">RPL 3A • Lab 1</p>
                </div>
                @endfor
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- Modal Add/Edit --}}
<div id="jadwalModal" class="fixed inset-0 bg-black/70 backdrop-blur-md z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl max-w-3xl w-full max-h-[90vh] overflow-hidden">
        <div class="bg-gradient-to-r from-[#1F653F] via-[#2F8054] to-[#47AF76] text-white p-8 sticky top-0 z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-extrabold mb-1">Tambah Jadwal Kuliah</h2>
                    <p class="text-emerald-100 text-sm">Lengkapi informasi jadwal dengan teliti</p>
                </div>
                <button onclick="closeModal()" class="w-10 h-10 bg-white/20 hover:bg-white/30 rounded-xl flex items-center justify-center transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <div class="p-8 overflow-y-auto" style="max-height: calc(90vh - 200px);">
            <form id="jadwalForm">
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-2 flex items-center gap-2">
                            <span class="w-1.5 h-1.5 bg-[#1F653F] rounded-full"></span>
                            Mata Kuliah <span class="text-red-500">*</span>
                        </label>
                        <select name="matkul" required class="w-full border-2 border-gray-300 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1F653F] bg-white transition-all">
                            <option value="">Pilih Mata Kuliah</option>
                            <option>IFI-322507 - Pemrograman Web Lanjut</option>
                            <option>IFI-322203 - Analisis dan Desain PL</option>
                            <option>IFI-332308 - Perancangan Antarmuka</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-2 flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-[#1F653F] rounded-full"></span>
                                Kelas <span class="text-red-500">*</span>
                            </label>
                            <select name="kelas" required class="w-full border-2 border-gray-300 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1F653F] bg-white transition-all">
                                <option value="">Pilih Kelas</option>
                                <option>RPL 3A</option>
                                <option>RPL 3B</option>
                                <option>TI 2A</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-2 flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-[#1F653F] rounded-full"></span>
                                Dosen <span class="text-red-500">*</span>
                            </label>
                            <select name="dosen" required class="w-full border-2 border-gray-300 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1F653F] bg-white transition-all">
                                <option value="">Pilih Dosen</option>
                                <option>Dr. Rizki Ramadhansyah</option>
                                <option>Dr. Ahmad Fauzi</option>
                                <option>Ir. Siti Rahma</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-2 flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-[#1F653F] rounded-full"></span>
                                Hari <span class="text-red-500">*</span>
                            </label>
                            <select name="hari" required class="w-full border-2 border-gray-300 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1F653F] bg-white transition-all">
                                <option value="">Pilih Hari</option>
                                <option>Senin</option>
                                <option>Selasa</option>
                                <option>Rabu</option>
                                <option>Kamis</option>
                                <option>Jumat</option>
                                <option>Sabtu</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-2 flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-[#1F653F] rounded-full"></span>
                                Jam Mulai <span class="text-red-500">*</span>
                            </label>
                            <input type="time" name="jam_mulai" required class="w-full border-2 border-gray-300 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1F653F] transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-2 flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-[#1F653F] rounded-full"></span>
                                Jam Selesai <span class="text-red-500">*</span>
                            </label>
                            <input type="time" name="jam_selesai" required class="w-full border-2 border-gray-300 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1F653F] transition-all">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-2 flex items-center gap-2">
                            <span class="w-1.5 h-1.5 bg-[#1F653F] rounded-full"></span>
                            Ruangan <span class="text-red-500">*</span>
                        </label>
                        <select name="ruangan" required class="w-full border-2 border-gray-300 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1F653F] bg-white transition-all">
                            <option value="">Pilih Ruangan</option>
                            <option>Lab Komputer 1</option>
                            <option>Lab Komputer 2</option>
                            <option>Ruang 4.1</option>
                            <option>Ruang 4.2</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>

        <div class="bg-gray-50 px-8 py-5 rounded-b-3xl flex items-center justify-between border-t-2">
            <button type="button" onclick="checkKonflik()" class="px-6 py-3 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white rounded-xl text-sm font-bold transition-all shadow-lg active:scale-95">
                Cek Konflik
            </button>
            <div class="flex gap-4">
                <button onclick="closeModal()" class="px-8 py-3.5 border-2 border-gray-300 text-gray-700 rounded-xl font-bold hover:bg-gray-100 hover:border-gray-400 transition-all">
                    Batal
                </button>
                <button onclick="saveJadwal()" class="px-8 py-3.5 bg-gradient-to-r from-[#1F653F] to-[#2F8054] hover:from-[#2F8054] hover:to-[#47AF76] text-white rounded-xl font-bold transition-all shadow-lg hover:shadow-xl active:scale-95">
                    Simpan
                </button>
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')
<script>
function showView(view) {
    if(view === 'table') {
        document.getElementById('view-table').classList.remove('hidden');
        document.getElementById('view-calendar').classList.add('hidden');
        document.getElementById('btn-table').classList.add('bg-gradient-to-r', 'from-[#1F653F]', 'to-[#2F8054]', 'text-white', 'shadow-lg');
        document.getElementById('btn-table').classList.remove('bg-gray-100', 'text-gray-700');
        document.getElementById('btn-calendar').classList.remove('bg-gradient-to-r', 'from-[#1F653F]', 'to-[#2F8054]', 'text-white', 'shadow-lg');
        document.getElementById('btn-calendar').classList.add('bg-gray-100', 'text-gray-700');
    } else {
        document.getElementById('view-table').classList.add('hidden');
        document.getElementById('view-calendar').classList.remove('hidden');
        document.getElementById('btn-calendar').classList.add('bg-gradient-to-r', 'from-[#1F653F]', 'to-[#2F8054]', 'text-white', 'shadow-lg');
        document.getElementById('btn-calendar').classList.remove('bg-gray-100', 'text-gray-700');
        document.getElementById('btn-table').classList.remove('bg-gradient-to-r', 'from-[#1F653F]', 'to-[#2F8054]', 'text-white', 'shadow-lg');
        document.getElementById('btn-table').classList.add('bg-gray-100', 'text-gray-700');
    }
}

function openAddModal() {
    document.getElementById('jadwalModal').classList.remove('hidden');
    document.getElementById('jadwalModal').classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function openEditModal() {
    document.getElementById('jadwalModal').classList.remove('hidden');
    document.getElementById('jadwalModal').classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('jadwalModal').classList.add('hidden');
    document.getElementById('jadwalModal').classList.remove('flex');
    document.body.style.overflow = 'auto';
}

function checkKonflik() {
    alert('Mengecek konflik jadwal...');
}

function saveJadwal() {
    const form = document.getElementById('jadwalForm');
    if(!form.checkValidity()) {
        alert('Mohon lengkapi semua field yang wajib diisi (*)');
        return;
    }
    alert('Jadwal berhasil disimpan!');
    closeModal();
}

function deleteJadwal() {
    if(confirm('Yakin ingin menghapus jadwal ini?')) {
        alert('Jadwal berhasil dihapus!');
    }
}
</script>

<style>
@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.5;
    }
}

.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}
</style>
@endpush