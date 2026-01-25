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
                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"></path>
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-extrabold tracking-tight">Kelola Kelas</h1>
                <p class="text-emerald-100 text-base mt-1">Manajemen kelas perkuliahan per semester</p>
            </div>
        </div>
        <button onclick="openAddModal()" class="flex items-center gap-3 bg-white text-[#1F653F] px-8 py-4 rounded-2xl font-bold text-base hover:scale-105 hover:shadow-2xl transition-all shadow-xl active:scale-95 group">
            <div class="w-8 h-8 bg-[#1F653F] rounded-lg flex items-center justify-center group-hover:rotate-90 transition-transform duration-300">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                </svg>
            </div>
            Buat Kelas Baru
        </button>
    </div>
</div>

{{-- Filter & Search --}}
<div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-8">
    <div class="flex items-center gap-4 flex-wrap">
        <form action="{{ route('akademik.kelas.index') }}" method="GET" class="flex-1 min-w-[300px]">
            <div class="relative group">
                <div class="absolute left-4 top-1/2 transform -translate-y-1/2 w-10 h-10 bg-gradient-to-br from-[#1F653F]/10 to-transparent rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-[#1F653F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode atau nama mata kuliah..." class="w-full pl-16 pr-4 py-3.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] transition-all text-sm group-hover:border-[#2F8054]">
            </div>
        </form>
        
        <select name="semester_id" onchange="window.location.href='/akademik/kelas?semester_id='+this.value" class="border-2 border-gray-200 rounded-xl px-5 py-3.5 text-sm font-bold focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] bg-white transition-all hover:border-[#2F8054]">
            <option value="">Semua Semester</option>
            @foreach($semesters as $s)
                <option value="{{ $s->semester_ajaran_id }}" {{ request('semester_id') == $s->semester_ajaran_id ? 'selected' : '' }}>{{ $s->nama_semester }}</option>
            @endforeach
        </select>

        <select name="prodi_id" onchange="window.location.href='/akademik/kelas?prodi_id='+this.value" class="border-2 border-gray-200 rounded-xl px-5 py-3.5 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] bg-white transition-all hover:border-[#2F8054]">
            <option value="">Semua Prodi</option>
            @foreach($prodis as $p)
                <option value="{{ $p->prodi_id }}" {{ request('prodi_id') == $p->prodi_id ? 'selected' : '' }}>{{ $p->nama_prodi }}</option>
            @endforeach
        </select>

        <button class="px-6 py-3.5 bg-gradient-to-r from-[#1F653F] to-[#2F8054] hover:from-[#2F8054] hover:to-[#47AF76] text-white rounded-xl text-sm font-bold transition-all shadow-lg hover:shadow-xl active:scale-95 flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            Export Excel
        </button>
    </div>
</div>

{{-- Stats with Modern Design --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="group bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-[#1F653F]/30 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-[#1F653F]/10 to-transparent rounded-bl-full"></div>
        <div class="relative z-10">
            <div class="w-14 h-14 bg-gradient-to-br from-[#1F653F] to-[#2F8054] rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"></path>
                </svg>
            </div>
            <p class="text-sm text-gray-600 font-semibold mb-2">Total Kelas</p>
            <p class="text-4xl font-extrabold text-gray-900">{{ number_format($stats['total']) }}</p>
        </div>
    </div>

    <div class="group bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-emerald-200 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-emerald-500/10 to-transparent rounded-bl-full"></div>
        <div class="relative z-10">
            <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-green-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <p class="text-sm text-gray-600 font-semibold mb-2">Kelas Aktif</p>
            <p class="text-4xl font-extrabold text-gray-900 mb-1">{{ number_format($stats['active']) }}</p>
            <div class="flex items-center gap-2">
                <span class="text-xs px-2 py-1 bg-emerald-100 text-emerald-700 rounded-full font-semibold flex items-center gap-1">
                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                    {{ $stats['total'] > 0 ? round(($stats['active'] / $stats['total']) * 100, 1) : 0 }}% aktif
                </span>
            </div>
        </div>
    </div>

    <div class="group bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-blue-200 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-500/10 to-transparent rounded-bl-full"></div>
        <div class="relative z-10">
            <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                </svg>
            </div>
            <p class="text-sm text-gray-600 font-semibold mb-2">Total Mahasiswa</p>
            <p class="text-4xl font-extrabold text-gray-900">{{ number_format($stats['total_students']) }}</p>
        </div>
    </div>

    <div class="group bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-purple-200 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-purple-500/10 to-transparent rounded-bl-full"></div>
        <div class="relative z-10">
            <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
                </svg>
            </div>
            <p class="text-sm text-gray-600 font-semibold mb-2">Rata-rata/Kelas</p>
            <p class="text-4xl font-extrabold text-gray-900">{{ round($stats['avg_per_class'], 1) }}</p>
        </div>
    </div>
</div>

{{-- Kelas Grid --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($kelas as $k)
    <div class="bg-white rounded-3xl shadow-lg border-2 border-gray-200 hover:border-[#1F653F] hover:shadow-2xl transition-all duration-300 overflow-hidden group">
        {{-- Header --}}
        <div class="bg-gradient-to-r from-[#1F653F]/10 via-[#2F8054]/10 to-[#47AF76]/10 p-6 border-b-2 border-emerald-200">
            <div class="flex items-center justify-between mb-3">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <h3 class="text-2xl font-extrabold text-gray-900">{{ $k->kode_kelas }}</h3>
                    </div>
                    <p class="text-sm text-gray-600 font-mono font-semibold bg-gray-100 px-3 py-1 rounded-lg inline-block">{{ $k->matakuliah->kode_mk ?? '-' }}</p>
                </div>
                @if($k->status == 'Aktif')
                    <span class="inline-flex items-center gap-1.5 px-4 py-2 bg-gradient-to-r from-emerald-500 to-green-600 text-white rounded-xl text-xs font-bold shadow-lg">
                        <span class="w-2 h-2 bg-white rounded-full animate-pulse"></span>
                        Aktif
                    </span>
                @else
                    <span class="px-4 py-2 bg-gradient-to-r from-gray-400 to-gray-500 text-white rounded-xl text-xs font-bold shadow-md">{{ $k->status }}</span>
                @endif
            </div>
            <h4 class="font-extrabold text-gray-900 text-lg">{{ $k->matakuliah->nama_mk ?? '-' }}</h4>
        </div>

        {{-- Content --}}
        <div class="p-6">
            {{-- Dosen --}}
            <div class="flex items-center gap-3 mb-5 pb-5 border-b-2 border-gray-100">
                <div class="w-12 h-12 bg-gradient-to-br from-[#1F653F] to-[#2F8054] rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-semibold mb-0.5">Dosen Pengampu</p>
                    <p class="text-sm font-bold text-gray-900">{{ $k->dosen->dosen->nama ?? 'Belum Ditentukan' }}</p>
                </div>
            </div>

            {{-- Info Grid --}}
            <div class="grid grid-cols-2 gap-3 mb-5">
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-4 border-2 border-blue-200 hover:shadow-md transition-all">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                            </svg>
                        </div>
                        <p class="text-xs text-gray-600 font-semibold">Mahasiswa</p>
                    </div>
                    @php 
                        $occupied = $k->krs_details_count ?? 0;
                        $capacity = $k->kapasitas ?: 1;
                        $percent = min(100, ($occupied / $capacity) * 100);
                    @endphp
                    <p class="text-2xl font-extrabold text-blue-600">{{ $occupied }}/{{ $k->kapasitas }}</p>
                    <div class="w-full bg-blue-200 rounded-full h-2 mt-3">
                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-2 rounded-full shadow-sm" style="width: {{ $percent }}%"></div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-amber-50 to-orange-100 rounded-xl p-4 border-2 border-amber-200 hover:shadow-md transition-all md:col-span-2">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-8 h-8 bg-amber-500 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <p class="text-xs text-gray-600 font-semibold">Prodi</p>
                    </div>
                    <p class="text-sm font-extrabold text-amber-600">{{ $k->prodi->nama_prodi ?? '-' }}</p>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-2">
                <button onclick="viewKelas('{{ $k->kelas_id }}')" class="flex-1 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-4 py-3 rounded-xl text-sm font-bold transition-all shadow-lg hover:shadow-xl active:scale-95">
                    Detail
                </button>
                <button onclick='editKelas(@json($k))' class="flex-1 bg-gradient-to-r from-[#1F653F] to-[#2F8054] hover:from-[#2F8054] hover:to-[#47AF76] text-white px-4 py-3 rounded-xl text-sm font-bold transition-all shadow-lg hover:shadow-xl active:scale-95">
                    Edit
                </button>
                <form action="{{ route('akademik.kelas.delete', $k->kelas_id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kelas ini?')" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-4 py-3 rounded-xl transition-all shadow-lg hover:shadow-xl active:scale-95">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>


{{-- Modal Tambah/Edit --}}
<div id="kelasModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-3xl w-full max-h-[90vh] overflow-y-auto">
        {{-- Modal Header --}}
        <div class="bg-gradient-to-r from-[#1F653F] via-[#2F8054] to-[#47AF76] text-white p-6 rounded-t-2xl sticky top-0 z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h2 id="modalTitle" class="text-2xl font-bold mb-1">Buat Kelas Baru</h2>
                    <p class="text-emerald-100 text-sm">Lengkapi informasi kelas perkuliahan</p>
                </div>
                <button onclick="closeModal()" class="w-10 h-10 bg-white bg-opacity-20 hover:bg-opacity-30 rounded-full flex items-center justify-center transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Modal Body --}}
        <div class="p-6">
            <form id="kelasForm" method="POST" action="{{ route('akademik.kelas.store') }}">
                @csrf
                <div id="methodField"></div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kode Kelas <span class="text-red-500">*</span></label>
                        <input type="text" name="kode" required placeholder="RPL-3A" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Semester <span class="text-red-500">*</span></label>
                        <select name="semester_ajaran_id" required class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 bg-white">
                            <option value="">Pilih Semester</option>
                            @foreach($semesters as $s)
                                <option value="{{ $s->semester_ajaran_id }}">{{ $s->nama_semester }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Mata Kuliah <span class="text-red-500">*</span></label>
                        <select name="matakuliah_id" required class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 bg-white">
                            <option value="">Pilih Mata Kuliah</option>
                            @foreach($matakuliah as $m)
                                <option value="{{ $m->matakuliah_id }}">{{ $m->kode_mk }} - {{ $m->nama_mk }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Dosen Pengampu <span class="text-red-500">*</span></label>
                        <select name="dosen_id" required class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 bg-white">
                            <option value="">Pilih Dosen</option>
                            @foreach($dosens as $d)
                                <option value="{{ $d->dosen_id }}">{{ $d->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kapasitas Mahasiswa <span class="text-red-500">*</span></label>
                        <input type="number" name="kapasitas" required min="1" max="50" placeholder="40" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                        <select name="status" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white">
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                        <select name="status" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 bg-white">
                            <option selected>Aktif</option>
                            <option>Tidak Aktif</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Program Studi <span class="text-red-500">*</span></label>
                        <select name="prodi_id" required class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 bg-white">
                            <option value="">Pilih Program Studi</option>
                            @foreach($prodis as $p)
                                <option value="{{ $p->prodi_id }}">{{ $p->nama_prodi }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Keterangan</label>
                        <textarea name="keterangan" rows="3" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500"></textarea>
                    </div>
                </div>
            </form>
        </div>

        {{-- Modal Footer --}}
        <div class="bg-gray-50 px-6 py-4 rounded-b-2xl flex items-center justify-end gap-3 border-t">
            <button onclick="closeModal()" class="px-6 py-2.5 border-2 border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-100 transition">
                Batal
            </button>
            <button onclick="saveKelas()" class="px-6 py-2.5 bg-gradient-to-r from-[#1F653F] to-[#2F8054] hover:from-[#2F8054] hover:to-[#47AF76] text-white rounded-xl font-semibold transition shadow-md">
                Simpan
            </button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 3000,
            background: '#ffffff',
            borderRadius: '20px'
        });
    @endif

    @if($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ $errors->first() }}',
            confirmButtonColor: '#1F653F',
            background: '#ffffff',
            borderRadius: '20px'
        });
    @endif
</script>
<script>
function openAddModal() {
    document.getElementById('modalTitle').textContent = 'Buat Kelas Baru';
    const form = document.getElementById('kelasForm');
    form.reset();
    form.action = "{{ route('akademik.kelas.store') }}";
    document.getElementById('methodField').innerHTML = '';
    document.getElementById('kelasModal').classList.remove('hidden');
    document.getElementById('kelasModal').classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function editKelas(k) {
    document.getElementById('modalTitle').textContent = 'Edit Kelas';
    const form = document.getElementById('kelasForm');
    form.reset();
    form.action = `/akademik/kelas/${k.kelas_id}`;
    document.getElementById('methodField').innerHTML = '@method("PUT")';
    
    // Fill form - match select names
    form.kode.value = k.kode_kelas;
    form.matakuliah_id.value = k.matakuliah_id;
    form.dosen_id.value = k.dosen ? (k.dosen.dosen ? k.dosen.dosen.dosen_id : '') : '';
    form.semester_ajaran_id.value = k.semester_ajaran_id;
    form.prodi_id.value = k.prodi_id;
    form.kapasitas.value = k.kapasitas;
    form.status.value = k.status;
    form.status.value = k.status;

    document.getElementById('kelasModal').classList.remove('hidden');
    document.getElementById('kelasModal').classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('kelasModal').classList.add('hidden');
    document.getElementById('kelasModal').classList.remove('flex');
    document.body.style.overflow = 'auto';
}

function saveKelas() {
    document.getElementById('kelasForm').submit();
}

function deleteKelas(kode) {
    if(confirm('Yakin ingin menghapus kelas ' + kode + '?')) {
        alert('Kelas berhasil dihapus!');
    }
}
</script>
@endpush