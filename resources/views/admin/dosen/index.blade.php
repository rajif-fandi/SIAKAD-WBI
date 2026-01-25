@extends('layouts.app')

@section('content')

@include('partials.credential_alert')

{{-- Success Message --}}
<div id="success-message" class="mb-6 flex items-center gap-3 bg-gradient-to-r from-emerald-50 to-green-50 border-l-4 border-emerald-500 p-4 rounded-xl shadow-lg animate-fade-in hidden backdrop-blur-sm">
    <div class="w-10 h-10 bg-emerald-500 rounded-full flex items-center justify-center flex-shrink-0 shadow-md">
        <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
        </svg>
    </div>
    <div>
        <span class="text-sm font-bold text-emerald-900 block">Berhasil!</span>
        <span class="text-xs text-emerald-700">Data dosen berhasil disimpan!</span>
    </div>
</div>

{{-- Header Section with Enhanced Design --}}
<div class="relative bg-gradient-to-br from-[#1F653F] via-[#2F8054] to-[#47AF76] text-white p-8 rounded-3xl mb-8 shadow-2xl overflow-hidden">
    {{-- Decorative Elements --}}
    <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full -ml-24 -mb-24 blur-2xl"></div>
    
    <div class="relative z-10 flex items-center justify-between">
        <div>
            <div class="flex items-center gap-3 mb-3">
                <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                    </svg>
                </div>
                <h2 class="text-3xl font-extrabold tracking-tight">Kelola Data Dosen</h2>
            </div>
            <p class="text-emerald-100 text-base ml-15">Manajemen data lengkap dosen</p>
        </div>
        <button onclick="openAddModal()" class="flex items-center gap-3 bg-white text-[#1F653F] px-8 py-4 rounded-2xl font-bold text-base hover:scale-105 hover:shadow-2xl transition-all shadow-xl active:scale-95 group">
            <div class="w-8 h-8 bg-[#1F653F] rounded-lg flex items-center justify-center group-hover:rotate-90 transition-transform duration-300">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
            </div>
            Tambah Dosen
        </button>
    </div>
</div>

{{-- Stats Cards with Modern Design --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="group bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-emerald-200 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-[#1F653F]/10 to-transparent rounded-bl-full"></div>
        <div class="relative z-10">
            <div class="w-14 h-14 bg-gradient-to-br from-[#1F653F] to-[#2F8054] rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                </svg>
            </div>
            <p class="text-sm text-gray-600 font-semibold mb-2">Total Dosen</p>
            <p class="text-4xl font-extrabold text-gray-900 mb-1">{{ $stats['total'] }}</p>
            <div class="flex items-center gap-2">
                <span class="text-xs px-2 py-1 bg-emerald-100 text-emerald-700 rounded-full font-semibold">+5 bulan ini</span>
            </div>
        </div>
    </div>

    <div class="group bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-green-200 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-green-500/10 to-transparent rounded-bl-full"></div>
        <div class="relative z-10">
            <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-green-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <p class="text-sm text-gray-600 font-semibold mb-2">Dosen Aktif</p>
            <p class="text-4xl font-extrabold text-gray-900 mb-1">{{ $stats['aktif'] }}</p>
            <div class="flex items-center gap-2">
                <span class="text-xs px-2 py-1 bg-green-100 text-green-700 rounded-full font-semibold">94.3% aktif</span>
            </div>
        </div>
    </div>

    <div class="group bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-amber-200 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-amber-500/10 to-transparent rounded-bl-full"></div>
        <div class="relative z-10">
            <div class="w-14 h-14 bg-gradient-to-br from-amber-500 to-orange-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
                </svg>
            </div>
            <p class="text-sm text-gray-600 font-semibold mb-2">Dosen Tetap</p>
            <p class="text-4xl font-extrabold text-gray-900 mb-1">{{ $stats['tetap'] }}</p>
            <div class="flex items-center gap-2">
                <span class="text-xs px-2 py-1 bg-amber-100 text-amber-700 rounded-full font-semibold">74.7% tetap</span>
            </div>
        </div>
    </div>

    <div class="group bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-purple-200 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-purple-500/10 to-transparent rounded-bl-full"></div>
        <div class="relative z-10">
            <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"></path>
                </svg>
            </div>
            <p class="text-sm text-gray-600 font-semibold mb-2">Profesor</p>
            <p class="text-4xl font-extrabold text-gray-900 mb-1">{{ $stats['profesor'] }}</p>
            <div class="flex items-center gap-2">
                <span class="text-xs px-2 py-1 bg-purple-100 text-purple-700 rounded-full font-semibold">Tertinggi</span>
            </div>
        </div>
    </div>
</div>

{{-- Filter & Search with Modern Design --}}
<div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 mb-8">
    <div class="flex flex-wrap items-center gap-4">
        <div class="flex-1 min-w-[300px]">
            <div class="relative group">
                <div class="absolute left-4 top-1/2 transform -translate-y-1/2 w-10 h-10 bg-gradient-to-br from-[#1F653F]/10 to-transparent rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-[#1F653F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="text" placeholder="Cari nama, NIDN, atau email dosen..." class="w-full pl-16 pr-4 py-3.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] transition-all text-sm group-hover:border-[#2F8054]">
            </div>
        </div>
        <select class="px-5 py-3.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] transition-all bg-white text-sm font-medium text-gray-700 hover:border-[#2F8054]">
            <option>Semua Prodi</option>
            <option>Teknik Informatika</option>
            <option>Sistem Informasi</option>
            <option>Rekayasa Perangkat Lunak</option>
        </select>
        <select class="px-5 py-3.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] transition-all bg-white text-sm font-medium text-gray-700 hover:border-[#2F8054]">
            <option>Semua Status</option>
            <option>Aktif</option>
            <option>Cuti</option>
            <option>Nonaktif</option>
        </select>
        <select class="px-5 py-3.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] transition-all bg-white text-sm font-medium text-gray-700 hover:border-[#2F8054]">
            <option>Semua Jabatan</option>
            <option>Profesor</option>
            <option>Lektor Kepala</option>
            <option>Lektor</option>
            <option>Asisten Ahli</option>
        </select>
        <button class="px-6 py-3.5 bg-gradient-to-r from-[#1F653F] to-[#2F8054] hover:from-[#2F8054] hover:to-[#47AF76] text-white font-semibold rounded-xl transition-all flex items-center gap-2 shadow-lg hover:shadow-xl active:scale-95">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            Export
        </button>
    </div>
</div>

{{-- Table with Enhanced Design --}}
<div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gradient-to-r from-[#1F653F] via-[#2F8054] to-[#47AF76] text-white">
                    <th class="px-6 py-5 text-left">
                        <input type="checkbox" class="w-5 h-5 rounded-lg border-white/30 text-[#1F653F] focus:ring-2 focus:ring-white/50">
                    </th>
                    <th class="px-6 py-5 text-left text-sm font-bold uppercase tracking-wider">NIDN</th>
                    <th class="px-6 py-5 text-left text-sm font-bold uppercase tracking-wider">Nama Lengkap</th>
                    <th class="px-6 py-5 text-left text-sm font-bold uppercase tracking-wider">Program Studi</th>
                    <th class="px-6 py-5 text-center text-sm font-bold uppercase tracking-wider">Jabatan</th>
                    <th class="px-6 py-5 text-center text-sm font-bold uppercase tracking-wider">Status</th>
                    <th class="px-6 py-5 text-center text-sm font-bold uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($dosens as $dsn)
                <tr class="hover:bg-gradient-to-r hover:from-emerald-50/50 hover:to-transparent transition-all group">
                    <td class="px-6 py-5">
                        <input type="checkbox" class="w-5 h-5 rounded-lg border-gray-300 text-[#1F653F] focus:ring-[#1F653F]">
                    </td>
                    <td class="px-6 py-5">
                        <span class="text-sm font-bold font-mono text-gray-900 bg-gray-100 px-3 py-1.5 rounded-lg">{{ $dsn->nip }}</span>
                    </td>
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-[#1F653F] to-[#2F8054] rounded-xl flex items-center justify-center flex-shrink-0 shadow-md group-hover:scale-110 transition-transform">
                                <span class="text-white font-bold text-base">{{ substr($dsn->nama, 0, 1) }}</span>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 text-base">{{ $dsn->nama }}</p>
                                <p class="text-xs text-gray-500 mt-0.5 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                    </svg>
                                    {{ $dsn->user->email }}
                                </p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-5">
                        <span class="text-sm text-gray-700 font-medium">{{ $dsn->prodi->nama_prodi ?? '-' }}</span>
                    </td>
                    <td class="px-6 py-5 text-center">
                        @php
                            $jabatanColors = [
                                'Profesor' => 'from-purple-500 to-indigo-600 text-white shadow-purple-200',
                                'Lektor Kepala' => 'from-blue-500 to-indigo-600 text-white shadow-blue-200',
                                'Lektor' => 'from-cyan-500 to-blue-600 text-white shadow-cyan-200',
                                'Asisten Ahli' => 'from-emerald-500 to-green-600 text-white shadow-emerald-200'
                            ];
                            $colorClass = $jabatanColors[$dsn->jabatan] ?? 'from-gray-500 to-gray-600 text-white';
                        @endphp
                        <span class="inline-block bg-gradient-to-r {{ $colorClass }} px-4 py-1.5 rounded-lg text-xs font-bold shadow-md">
                            {{ $dsn->jabatan ?? 'Dosen' }}
                        </span>
                    </td>
                    <td class="px-6 py-5 text-center">
                        @php
                            $statusColors = [
                                'Aktif' => 'from-emerald-500 to-green-600',
                                'Cuti' => 'from-amber-500 to-orange-600',
                                'Non-Aktif' => 'from-red-500 to-red-600',
                            ];
                            $statColor = $statusColors[$dsn->status_dosen] ?? 'from-gray-500 to-gray-600';
                        @endphp
                        <span class="inline-flex items-center gap-1.5 bg-gradient-to-r {{ $statColor }} text-white px-4 py-1.5 rounded-lg text-xs font-bold shadow-md">
                            <span class="w-2 h-2 bg-white rounded-full {{ $dsn->status_dosen == 'Aktif' ? 'animate-pulse' : '' }}"></span>
                            {{ $dsn->status_dosen ?? 'Aktif' }}
                        </span>
                    </td>
                    <td class="px-6 py-5">
                        <div class="flex items-center justify-center gap-2">
                            <button onclick="openDetailModal('{{ $dsn->dosen_id }}')" class="p-2.5 bg-blue-50 hover:bg-gradient-to-br hover:from-blue-500 hover:to-blue-600 text-blue-600 hover:text-white rounded-xl transition-all shadow-sm hover:shadow-md group/btn" title="Detail">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                            <button onclick="openEditModal({{ json_encode($dsn) }})" class="p-2.5 bg-emerald-50 hover:bg-gradient-to-br hover:from-[#1F653F] hover:to-[#2F8054] text-emerald-600 hover:text-white rounded-xl transition-all shadow-sm hover:shadow-md" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <button onclick="confirmDelete('{{ $dsn->dosen_id }}', '{{ $dsn->nama }}')" class="p-2.5 bg-red-50 hover:bg-gradient-to-br hover:from-red-500 hover:to-red-600 text-red-600 hover:text-white rounded-xl transition-all shadow-sm hover:shadow-md" title="Hapus">
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
            Menampilkan <span class="font-bold text-gray-900">1-6</span> dari <span class="font-bold text-gray-900">87</span> dosen
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

{{-- Add/Edit Modal --}}
<div id="form-modal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="fixed inset-0 bg-black/70 backdrop-blur-md transition-opacity" onclick="closeFormModal()"></div>
        
        <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-6xl max-h-[90vh] overflow-hidden transform transition-all">
            <div class="bg-gradient-to-r from-[#1F653F] via-[#2F8054] to-[#47AF76] p-8 text-white sticky top-0 z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-extrabold" id="modal-title">Tambah Dosen Baru</h3>
                        <p class="text-emerald-100 text-sm mt-1">Lengkapi biodata dosen dengan teliti dan akurat</p>
                    </div>
                    <button onclick="closeFormModal()" class="w-10 h-10 flex items-center justify-center bg-white/20 hover:bg-white/30 rounded-xl transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Tab Navigation --}}
            <div class="bg-white border-b-2 border-gray-200 sticky top-[104px] z-10">
                <div class="flex">
                    <button onclick="showModalTab('pribadi')" id="modal-tab-pribadi" class="flex-1 px-6 py-4 text-sm font-bold text-white bg-gradient-to-r from-[#1F653F] to-[#2F8054] transition-all relative">
                        <span class="relative z-10">Data Pribadi</span>
                    </button>
                    <button onclick="showModalTab('akademik')" id="modal-tab-akademik" class="flex-1 px-6 py-4 text-sm font-bold text-gray-600 hover:bg-gray-50 transition-all">
                        Data Akademik
                    </button>
                    <button onclick="showModalTab('kepegawaian')" id="modal-tab-kepegawaian" class="flex-1 px-6 py-4 text-sm font-bold text-gray-600 hover:bg-gray-50 transition-all">
                        Kepegawaian
                    </button>
                    <button onclick="showModalTab('pendidikan')" id="modal-tab-pendidikan" class="flex-1 px-6 py-4 text-sm font-bold text-gray-600 hover:bg-gray-50 transition-all">
                        Pendidikan
                    </button>
                </div>
            </div>
            
            <form id="dosen-form" action="{{ route('admin.dosen.store') }}" method="POST" class="p-8 overflow-y-auto" style="max-height: calc(90vh - 250px);">
                @csrf
                
                {{-- Tab 1: Data Pribadi --}}
                <div id="modal-content-pribadi" class="modal-tab-content">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Password field only shown/required based on context via JS if needed, but per request it's default --}}
                        <div id="password-wrapper" class="md:col-span-2 hidden">
                            <label class="block text-sm font-bold text-gray-800 mb-2 flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-[#1F653F] rounded-full"></span>
                                Password Baru <span class="text-xs font-normal text-gray-500">(Opsional)</span>
                            </label>
                            <input type="password" name="password" class="w-full border-2 border-gray-300 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] transition-all">
                            <p id="password-hint" class="text-xs text-blue-600 mt-1.5 font-medium italic">Biarkan kosong untuk menggunakan password default/lama.</p>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-2 flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-[#1F653F] rounded-full"></span>
                                NIDN <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nidn" required maxlength="10" class="w-full border-2 border-gray-300 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-2 flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-[#1F653F] rounded-full"></span>
                                NIP
                            </label>
                            <input type="text" name="nip" maxlength="18" class="w-full border-2 border-gray-300 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] transition-all">
                            <p class="text-xs text-gray-500 mt-1.5">18 digit nomor induk pegawai</p>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-800 mb-2 flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-[#1F653F] rounded-full"></span>
                                Nama Lengkap (dengan Gelar) <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama" required class="w-full border-2 border-gray-300 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] transition-all">
                            <p class="text-xs text-gray-500 mt-1.5">Contoh: Dr. Rizki Ramadhansyah, S.T., M.Kom</p>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-2 flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-[#1F653F] rounded-full"></span>
                                NIK
                            </label>
                            <input type="text" name="nik" maxlength="16" class="w-full border-2 border-gray-300 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-2 flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-[#1F653F] rounded-full"></span>
                                Jenis Kelamin <span class="text-red-500">*</span>
                            </label>
                            <select name="jenis_kelamin" required class="w-full border-2 border-gray-300 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] bg-white transition-all">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-2 flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-[#1F653F] rounded-full"></span>
                                Tempat Lahir
                            </label>
                            <input type="text" name="tempat_lahir" class="w-full border-2 border-gray-300 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-2 flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-[#1F653F] rounded-full"></span>
                                Tanggal Lahir
                            </label>
                            <input type="date" name="tanggal_lahir" class="w-full border-2 border-gray-300 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-2 flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-[#1F653F] rounded-full"></span>
                                No. Telepon <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" name="no_telp" required class="w-full border-2 border-gray-300 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-2 flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-[#1F653F] rounded-full"></span>
                                Akun Login (Automated)
                            </label>
                            <input type="text" id="email_preview" readonly class="w-full border-2 border-gray-300 rounded-xl px-4 py-3.5 text-sm focus:outline-none bg-gray-50 text-gray-500 transition-all font-mono" placeholder="nama.lengkap@wbi.ac.id">
                            <p class="text-xs text-gray-500 mt-1.5">Email login otomatis: namadepan.namabelakang@wbi.ac.id</p>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-800 mb-2 flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-[#1F653F] rounded-full"></span>
                                Alamat Lengkap
                            </label>
                            <textarea name="alamat" rows="3" class="w-full border-2 border-gray-300 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] transition-all resize-none"></textarea>
                        </div>
                    </div>
                </div>

                {{-- Tab 2: Data Akademik --}}
                <div id="modal-content-akademik" class="modal-tab-content hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-2 flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-[#1F653F] rounded-full"></span>
                                Program Studi <span class="text-red-500">*</span>
                            </label>
                            <select name="prodi_id" required class="w-full border-2 border-gray-300 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] bg-white transition-all">
                                <option value="">Pilih Program Studi</option>
                                @foreach($prodis as $prodi)
                                    <option value="{{ $prodi->prodi_id }}">{{ $prodi->nama_prodi }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-2 flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-[#1F653F] rounded-full"></span>
                                Jabatan Fungsional
                            </label>
                            <select name="jabatan" class="w-full border-2 border-gray-300 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] bg-white transition-all">
                                <option value="">Pilih Jabatan</option>
                                <option>Asisten Ahli</option>
                                <option>Lektor</option>
                                <option>Lektor Kepala</option>
                                <option>Profesor</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-2 flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-[#1F653F] rounded-full"></span>
                                Bidang Keahlian
                            </label>
                            <input type="text" name="bidang_keahlian" class="w-full border-2 border-gray-300 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-2 flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-[#1F653F] rounded-full"></span>
                                ID Sinta
                            </label>
                            <input type="text" name="sinta_id" class="w-full border-2 border-gray-300 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] transition-all">
                        </div>
                    </div>
                </div>

                {{-- Tab 3: Data Kepegawaian --}}
                <div id="modal-content-kepegawaian" class="modal-tab-content hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-2 flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-[#1F653F] rounded-full"></span>
                                Status Kepegawaian
                            </label>
                            <select name="status_kepegawaian" class="w-full border-2 border-gray-300 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] bg-white transition-all">
                                <option>Dosen Tetap</option>
                                <option>Dosen Tidak Tetap</option>
                                <option>Dosen Luar Biasa</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-2 flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-[#1F653F] rounded-full"></span>
                                Status Dosen
                            </label>
                            <select name="status_dosen" class="w-full border-2 border-gray-300 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] bg-white transition-all">
                                <option>Aktif</option>
                                <option>Cuti</option>
                                <option>Non-Aktif</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-2 flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-[#1F653F] rounded-full"></span>
                                Tanggal Mulai Bekerja
                            </label>
                            <input type="date" name="tanggal_mulai" class="w-full border-2 border-gray-300 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-2 flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-[#1F653F] rounded-full"></span>
                                No. Sertifikat Pendidik
                            </label>
                            <input type="text" name="no_sertifikat" class="w-full border-2 border-gray-300 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] transition-all">
                        </div>
                    </div>
                </div>

                {{-- Tab 4: Pendidikan --}}
                <div id="modal-content-pendidikan" class="modal-tab-content hidden">
                    <div class="space-y-8">
                        {{-- S1 --}}
                        <div class="bg-gradient-to-r from-gray-50 to-white p-6 rounded-2xl border-2 border-gray-200">
                            <h4 class="font-bold text-gray-800 mb-5 pb-3 border-b-2 border-[#1F653F] flex items-center gap-2">
                                <span class="w-2 h-2 bg-[#1F653F] rounded-full"></span>
                                Pendidikan S1
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Universitas</label>
                                    <input type="text" name="s1_univ" class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] transition-all">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Program Studi</label>
                                    <input type="text" name="s1_prodi" class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] transition-all">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tahun Lulus</label>
                                    <input type="number" name="s1_tahun" min="1900" max="2099" class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] transition-all">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Gelar</label>
                                    <input type="text" name="s1_gelar" placeholder="S.T., S.Kom, dll" class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] transition-all">
                                </div>
                            </div>
                        </div>

                        {{-- S2 --}}
                        <div class="bg-gradient-to-r from-gray-50 to-white p-6 rounded-2xl border-2 border-gray-200">
                            <h4 class="font-bold text-gray-800 mb-5 pb-3 border-b-2 border-[#1F653F] flex items-center gap-2">
                                <span class="w-2 h-2 bg-[#1F653F] rounded-full"></span>
                                Pendidikan S2
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Universitas</label>
                                    <input type="text" name="s2_univ" class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] transition-all">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Program Studi</label>
                                    <input type="text" name="s2_prodi" class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] transition-all">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tahun Lulus</label>
                                    <input type="number" name="s2_tahun" min="1900" max="2099" class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] transition-all">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Gelar</label>
                                    <input type="text" name="s2_gelar" placeholder="M.T., M.Kom, M.Sc, dll" class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] transition-all">
                                </div>
                            </div>
                        </div>

                        {{-- S3 --}}
                        <div class="bg-gradient-to-r from-gray-50 to-white p-6 rounded-2xl border-2 border-gray-200">
                            <h4 class="font-bold text-gray-800 mb-5 pb-3 border-b-2 border-[#1F653F] flex items-center gap-2">
                                <span class="w-2 h-2 bg-[#1F653F] rounded-full"></span>
                                Pendidikan S3 (Jika Ada)
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Universitas</label>
                                    <input type="text" name="s3_univ" class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] transition-all">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Program Studi</label>
                                    <input type="text" name="s3_prodi" class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] transition-all">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tahun Lulus</label>
                                    <input type="number" name="s3_tahun" min="1900" max="2099" class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] transition-all">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Gelar</label>
                                    <input type="text" name="s3_gelar" placeholder="Dr., Ph.D, dll" class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] transition-all">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-8 flex gap-4 justify-end border-t-2 pt-6">
                    <button type="button" onclick="closeFormModal()" class="px-8 py-3.5 border-2 border-gray-300 text-gray-700 rounded-xl font-bold hover:bg-gray-50 hover:border-gray-400 transition-all">
                        Batal
                    </button>
                    <button type="submit" class="px-8 py-3.5 bg-gradient-to-r from-[#1F653F] to-[#2F8054] hover:from-[#2F8054] hover:to-[#47AF76] text-white rounded-xl font-bold transition-all shadow-lg hover:shadow-xl active:scale-95">
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Delete Confirmation Modal --}}
<div id="delete-modal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="fixed inset-0 bg-black/70 backdrop-blur-md transition-opacity" onclick="closeDeleteModal()"></div>
        
        <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-hidden transform transition-all">
            <div class="p-8">
                <div class="w-20 h-20 bg-gradient-to-br from-red-100 to-red-200 rounded-2xl flex items-center justify-center mx-auto mb-5 shadow-lg">
                    <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-extrabold text-center text-gray-900 mb-3">Hapus Dosen?</h3>
                <p class="text-center text-gray-600 mb-8 leading-relaxed">
                    Apakah Anda yakin ingin menghapus dosen <span id="delete-name" class="font-bold text-gray-900"></span>? Data yang sudah dihapus tidak dapat dikembalikan.
                </p>
                <div class="flex gap-4">
                    <button type="button" onclick="closeDeleteModal()" class="flex-1 px-6 py-3.5 border-2 border-gray-300 text-gray-700 rounded-xl font-bold hover:bg-gray-50 hover:border-gray-400 transition-all">
                        Batal
                    </button>
                    <button type="button" onclick="deleteData()" class="flex-1 px-6 py-3.5 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white rounded-xl font-bold transition-all shadow-lg hover:shadow-xl active:scale-95">
                        Ya, Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Footer --}}
<div class="mt-8 text-center text-sm text-gray-500 pb-6">
    <p>© 2025 Bagian Teknologi Informasi Wiyata Bhakti Indonesia</p>
</div>


@push('scripts')
<script>
let deleteNidn = null;

function showModalTab(tabName) {
    // 1. Hide all tab contents
    document.querySelectorAll('.modal-tab-content').forEach(el => {
        el.classList.add('hidden');
    });

    // 2. Show selected tab content
    document.getElementById(`modal-content-${tabName}`).classList.remove('hidden');

    // 3. Reset all tab buttons to inactive state
    const tabs = ['pribadi', 'akademik', 'kepegawaian', 'pendidikan'];
    tabs.forEach(t => {
        const btn = document.getElementById(`modal-tab-${t}`);
        if(btn) {
            btn.className = 'flex-1 px-6 py-4 text-sm font-bold text-gray-600 hover:bg-gray-50 transition-all cursor-pointer';
            // Remove any specific active children/spans if needed, but simple class swap is easier
            // Re-adding the span structure might be needed if the active one has special markup
        }
    });

    // 4. Set active tab button style
    const activeBtn = document.getElementById(`modal-tab-${tabName}`);
    if(activeBtn) {
        activeBtn.className = 'flex-1 px-6 py-4 text-sm font-bold text-white bg-gradient-to-r from-[#1F653F] to-[#2F8054] transition-all relative shadow-md';
    }
}

function openAddModal() {
    document.getElementById('modal-title').textContent = 'Tambah Dosen Baru';
    const form = document.getElementById('dosen-form');
    form.reset();
    form.action = "{{ route('admin.dosen.store') }}";
    form.method = "POST";
    // Remove if any hidden method input exists
    const methodInput = form.querySelector('input[name="_method"]');
    if (methodInput) methodInput.remove();
    
    // Hide password field on creation since it uses default
    document.getElementById('password-wrapper').classList.add('hidden');
    document.getElementById('email_preview').value = '';

    document.getElementById('form-modal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    showModalTab('pribadi');
}

function openEditModal(dosen) {
    document.getElementById('modal-title').textContent = 'Edit Data Dosen';
    const form = document.getElementById('dosen-form');
    form.reset();
    form.action = `/admin/dosen/${dosen.dosen_id}`;
    
    // Add hidden method input for PUT
    let methodInput = form.querySelector('input[name="_method"]');
    if (!methodInput) {
        methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'PUT';
        form.appendChild(methodInput);
    } else {
        methodInput.value = 'PUT';
    }

    // Fill form fields
    form.querySelector('[name="nidn"]').value = dosen.nip;
    form.querySelector('[name="nama"]').value = dosen.nama;
    form.querySelector('[name="prodi_id"]').value = dosen.prodi_id;
    form.querySelector('[name="jabatan"]').value = dosen.jabatan || '';
    form.querySelector('[name="tanggal_lahir"]').value = dosen.tanggal_lahir || '';
    form.querySelector('[name="no_telp"]').value = dosen.no_hp || '';
    form.querySelector('[name="alamat"]').value = dosen.alamat_detail || '';
    
    // Extra fields
    if(form.querySelector('[name="nik"]')) form.querySelector('[name="nik"]').value = dosen.nik || '';
    if(form.querySelector('[name="jenis_kelamin"]')) form.querySelector('[name="jenis_kelamin"]').value = dosen.jenis_kelamin || '';
    if(form.querySelector('[name="tempat_lahir"]')) form.querySelector('[name="tempat_lahir"]').value = dosen.tempat_lahir || '';
    if(form.querySelector('[name="bidang_keahlian"]')) form.querySelector('[name="bidang_keahlian"]').value = dosen.bidang_keahlian || '';
    if(form.querySelector('[name="sinta_id"]')) form.querySelector('[name="sinta_id"]').value = dosen.sinta_id || '';
    if(form.querySelector('[name="status_kepegawaian"]')) form.querySelector('[name="status_kepegawaian"]').value = dosen.status_kepegawaian || '';
    if(form.querySelector('[name="status_dosen"]')) form.querySelector('[name="status_dosen"]').value = dosen.status_dosen || '';
    if(form.querySelector('[name="tanggal_mulai"]')) form.querySelector('[name="tanggal_mulai"]').value = dosen.tanggal_mulai || '';
    if(form.querySelector('[name="no_sertifikat"]')) form.querySelector('[name="no_sertifikat"]').value = dosen.no_sertifikat || '';
    
    // Education
    if(form.querySelector('[name="s1_univ"]')) form.querySelector('[name="s1_univ"]').value = dosen.s1_univ || '';
    if(form.querySelector('[name="s1_prodi"]')) form.querySelector('[name="s1_prodi"]').value = dosen.s1_prodi || '';
    if(form.querySelector('[name="s1_tahun"]')) form.querySelector('[name="s1_tahun"]').value = dosen.s1_tahun || '';
    if(form.querySelector('[name="s1_gelar"]')) form.querySelector('[name="s1_gelar"]').value = dosen.s1_gelar || '';
    
    if(form.querySelector('[name="s2_univ"]')) form.querySelector('[name="s2_univ"]').value = dosen.s2_univ || '';
    if(form.querySelector('[name="s2_prodi"]')) form.querySelector('[name="s2_prodi"]').value = dosen.s2_prodi || '';
    if(form.querySelector('[name="s2_tahun"]')) form.querySelector('[name="s2_tahun"]').value = dosen.s2_tahun || '';
    if(form.querySelector('[name="s2_gelar"]')) form.querySelector('[name="s2_gelar"]').value = dosen.s2_gelar || '';
    
    if(form.querySelector('[name="s3_univ"]')) form.querySelector('[name="s3_univ"]').value = dosen.s3_univ || '';
    if(form.querySelector('[name="s3_prodi"]')) form.querySelector('[name="s3_prodi"]').value = dosen.s3_prodi || '';
    if(form.querySelector('[name="s3_tahun"]')) form.querySelector('[name="s3_tahun"]').value = dosen.s3_tahun || '';
    if(form.querySelector('[name="s3_gelar"]')) form.querySelector('[name="s3_gelar"]').value = dosen.s3_gelar || '';
    
    // Show password field on edit
    document.getElementById('password-wrapper').classList.remove('hidden');
    
    // Set email preview
    const emailPreview = document.getElementById('email_preview');
    if (emailPreview) emailPreview.value = dosen.user?.email || '';
    document.getElementById('email_preview_hint').textContent = 'Email yang terdaftar untuk dosen ini.';


    // Update hints
    document.getElementById('password-hint').textContent = 'Biarkan kosong jika tidak ingin mengubah password';
    form.querySelector('[name="password"]').required = false;

    document.getElementById('form-modal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    showModalTab('pribadi');
}

function closeFormModal() {
    document.getElementById('form-modal').classList.add('hidden');
    document.body.style.overflow = 'auto';
    // Re-enable fields if they were disabled
    const form = document.getElementById('dosen-form');
    form.querySelector('[name="password"]').required = true;
}

function confirmDelete(id, nama) {
    deleteId = id;
    document.getElementById('delete-name').textContent = nama;
    document.getElementById('delete-modal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function deleteData() {
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = `/admin/dosen/${deleteId}`;
    
    const csrf = document.createElement('input');
    csrf.type = 'hidden';
    csrf.name = '_token';
    csrf.value = "{{ csrf_token() }}";
    
    const method = document.createElement('input');
    method.type = 'hidden';
    method.name = '_method';
    method.value = 'DELETE';
    
    form.appendChild(csrf);
    form.appendChild(method);
    document.body.appendChild(form);
    form.submit();
}

function handleFormSubmit(event) {
    // Let the standard form submission handle it for now to use controller redirect
}
</script>
<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fade-in 0.3s ease-out forwards;
    }
</style>
@endpush

@endsection