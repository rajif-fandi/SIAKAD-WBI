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
                    <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-extrabold tracking-tight">Kelola Kurikulum</h1>
                <p class="text-emerald-100 text-base mt-1">Manajemen struktur kurikulum program studi</p>
            </div>
        </div>
        <button onclick="openAddModal()" class="flex items-center gap-3 bg-white text-[#1F653F] px-8 py-4 rounded-2xl font-bold text-base hover:scale-105 hover:shadow-2xl transition-all shadow-xl active:scale-95 group">
            <div class="w-8 h-8 bg-[#1F653F] rounded-lg flex items-center justify-center group-hover:rotate-90 transition-transform duration-300">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                </svg>
            </div>
            Tambah Kurikulum
        </button>
    </div>
</div>

{{-- Filter Section --}}
<div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-8">
    <div class="flex items-center gap-4">
        <select id="prodiFilter" onchange="window.location.href='/akademik/kurikulum?prodi_id='+this.value" class="flex-1 border-2 border-gray-300 rounded-xl px-5 py-3.5 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] bg-white transition-all hover:border-[#2F8054]">
            <option value="">Semua Program Studi</option>
            @foreach($prodis as $p)
                <option value="{{ $p->prodi_id }}" {{ request('prodi_id') == $p->prodi_id ? 'selected' : '' }}>{{ $p->nama_prodi }}</option>
            @endforeach
        </select>

        <select class="border-2 border-gray-300 rounded-xl px-5 py-3.5 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] bg-white transition-all hover:border-[#2F8054]">
            <option value="">Semua Status</option>
            <option>Aktif</option>
            <option>Arsip</option>
        </select>

        <div class="flex items-center gap-3">
            <button class="px-6 py-3.5 bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-700 hover:to-green-700 text-white rounded-xl text-sm font-bold transition-all shadow-lg hover:shadow-xl active:scale-95 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                </svg>
                Export PDF
            </button>
            <button class="px-6 py-3.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-xl text-sm font-bold transition-all shadow-lg hover:shadow-xl active:scale-95 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Export Excel
            </button>
        </div>
    </div>
</div>

{{-- Summary Stats with Modern Design --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="group bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-[#1F653F]/30 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-[#1F653F]/10 to-transparent rounded-bl-full"></div>
        <div class="relative z-10">
            <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
                </svg>
            </div>
            <p class="text-sm text-gray-600 font-semibold mb-2">Total Kurikulum</p>
            <p class="text-4xl font-extrabold text-gray-900 mb-1">{{ $stats['total'] }}</p>
            <div class="flex items-center gap-2">
                <span class="text-xs px-2 py-1 bg-blue-100 text-blue-700 rounded-full font-semibold">{{ count($prodis) }} Program Studi</span>
            </div>
        </div>
    </div>

    <div class="group bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-emerald-200 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-emerald-500/10 to-transparent rounded-bl-full"></div>
        <div class="relative z-10">
            <div class="w-14 h-14 bg-gradient-to-br from-[#1F653F] to-[#2F8054] rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <p class="text-sm text-gray-600 font-semibold mb-2">Kurikulum Aktif</p>
            <p class="text-4xl font-extrabold text-gray-900 mb-1">{{ $stats['aktif'] }}</p>
            <div class="flex items-center gap-2">
                <span class="text-xs px-2 py-1 bg-emerald-100 text-emerald-700 rounded-full font-semibold flex items-center gap-1">
                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                    Aktif
                </span>
            </div>
        </div>
    </div>

    <div class="group bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-purple-200 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-purple-500/10 to-transparent rounded-bl-full"></div>
        <div class="relative z-10">
            <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"></path>
                </svg>
            </div>
            <p class="text-sm text-gray-600 font-semibold mb-2">Penempatan MK</p>
            <p class="text-4xl font-extrabold text-gray-900 mb-1">{{ $stats['mk_count'] }}</p>
            <div class="flex items-center gap-2">
                <span class="text-xs px-2 py-1 bg-purple-100 text-purple-700 rounded-full font-semibold">Semua Kurikulum</span>
            </div>
        </div>
    </div>

    <div class="group bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-amber-200 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-amber-500/10 to-transparent rounded-bl-full"></div>
        <div class="relative z-10">
            <div class="w-14 h-14 bg-gradient-to-br from-amber-500 to-orange-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <p class="text-sm text-gray-600 font-semibold mb-2">Total Tahun</p>
            <p class="text-4xl font-extrabold text-gray-900 mb-1">--</p>
            <div class="flex items-center gap-2">
                <span class="text-xs px-2 py-1 bg-amber-100 text-amber-700 rounded-full font-semibold">Per Kurikulum</span>
            </div>
        </div>
    </div>
</div>

{{-- Kurikulum Cards --}}
<div class="space-y-8">
    @foreach($kurikulums as $kurikulum)
    @php
        $isActive = $kurikulum->status == 'Aktif';
        $colorClass = $isActive ? 'emerald' : 'gray';
    @endphp
    <div class="bg-white rounded-3xl shadow-xl border-2 {{ $isActive ? 'border-emerald-300' : 'border-gray-300' }} overflow-hidden hover:shadow-2xl transition-all duration-300">
        {{-- Header --}}
        <div class="{{ $isActive ? 'bg-gradient-to-r from-[#1F653F]/10 via-[#2F8054]/10 to-[#47AF76]/10 border-b-2 border-emerald-200' : 'bg-gradient-to-r from-gray-50 to-gray-100 border-b-2 border-gray-200' }} p-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-5">
                    <div class="w-20 h-20 {{ $isActive ? 'bg-gradient-to-br from-[#1F653F] to-[#2F8054]' : 'bg-gradient-to-br from-gray-500 to-gray-600' }} rounded-2xl flex items-center justify-center text-white font-extrabold text-2xl shadow-xl">
                        {{ $kurikulum->tahun_berlaku }}
                    </div>
                    <div>
                        <h3 class="text-2xl font-extrabold text-gray-900">{{ $kurikulum->nama_kurikulum }}</h3>
                        <div class="flex items-center gap-2 mt-2">
                            <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                            <p class="text-sm text-gray-600 font-medium">Berlaku: {{ $kurikulum->tahun_berlaku }}</p>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    @if($isActive)
                        <span class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-emerald-500 to-green-600 text-white rounded-xl text-sm font-bold shadow-lg">
                            <span class="w-2 h-2 bg-white rounded-full animate-pulse"></span>
                            Aktif
                        </span>
                    @else
                        <span class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-gray-400 to-gray-500 text-white rounded-xl text-sm font-bold shadow-md">
                            <span class="w-2 h-2 bg-white rounded-full"></span>
                            Arsip
                        </span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Summary Info --}}
        <div class="p-6 border-b-2 border-gray-100">
            <div class="grid grid-cols-4 gap-4">
                <div class="text-center p-5 bg-gradient-to-br from-blue-50 to-blue-100 border-2 border-blue-200 rounded-2xl hover:shadow-lg transition-all group">
                    <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center mx-auto mb-2 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
                        </svg>
                    </div>
                    <p class="text-xs text-gray-600 font-semibold mb-1">Total SKS</p>
                    <p class="text-3xl font-extrabold text-blue-600">{{ $kurikulum->matakuliah->sum('sks') }}</p>
                </div>
                {{-- Note: If you have a relation for matakuliah count, replace the hardcoded values below --}}
                <div class="text-center p-5 bg-gradient-to-br from-purple-50 to-purple-100 border-2 border-purple-200 rounded-2xl hover:shadow-lg transition-all group">
                    <div class="w-10 h-10 bg-purple-500 rounded-xl flex items-center justify-center mx-auto mb-2 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"></path>
                        </svg>
                    </div>
                    <p class="text-xs text-gray-600 font-semibold mb-1">Total MK</p>
                    <p class="text-3xl font-extrabold text-purple-600">{{ $kurikulum->matakuliah->count() }}</p>
                </div>
                <div class="text-center p-5 bg-gradient-to-br from-emerald-50 to-green-100 border-2 border-emerald-200 rounded-2xl hover:shadow-lg transition-all group">
                    <div class="w-10 h-10 bg-emerald-500 rounded-xl flex items-center justify-center mx-auto mb-2 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <p class="text-xs text-gray-600 font-semibold mb-1">MK Wajib</p>
                    <p class="text-3xl font-extrabold text-emerald-600">{{ $kurikulum->matakuliah->where('status', 'Wajib')->count() }}</p>
                </div>
                <div class="text-center p-5 bg-gradient-to-br from-amber-50 to-orange-100 border-2 border-amber-200 rounded-2xl hover:shadow-lg transition-all group">
                    <div class="w-10 h-10 bg-amber-500 rounded-xl flex items-center justify-center mx-auto mb-2 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <p class="text-xs text-gray-600 font-semibold mb-1">MK Pilihan</p>
                    <p class="text-3xl font-extrabold text-amber-600">{{ $kurikulum->matakuliah->where('status', 'Pilihan')->count() }}</p>
                </div>
            </div>
        </div>

        {{-- Struktur Kurikulum --}}
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <h4 class="font-extrabold text-gray-900 text-xl flex items-center gap-2">
                    <span class="w-1.5 h-1.5 bg-[#1F653F] rounded-full"></span>
                    Struktur Kurikulum (8 Semester)
                </h4>
                <button onclick="toggleDetail({{ $kurikulum->kurikulum_id }})" class="px-4 py-2 bg-gradient-to-r from-[#1F653F] to-[#2F8054] hover:from-[#2F8054] hover:to-[#47AF76] text-white rounded-xl font-bold text-sm flex items-center gap-2 shadow-lg hover:shadow-xl transition-all active:scale-95">
                    <span id="toggle-text-{{ $kurikulum->kurikulum_id }}">Lihat Detail</span>
                    <svg id="toggle-icon-{{ $kurikulum->kurikulum_id }}" class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
            </div>

            {{-- Preview Grid (Semester Overview) --}}
            <div class="grid grid-cols-4 gap-4 mb-6">
                @for($sem = 1; $sem <= 8; $sem++)
                <div class="{{ $isActive ? 'bg-gradient-to-br from-[#1F653F]/10 to-[#2F8054]/10 border-2 border-emerald-300' : 'bg-gradient-to-br from-gray-50 to-gray-100 border-2 border-gray-300' }} rounded-xl p-4 hover:shadow-lg transition-all group cursor-pointer">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-8 h-8 {{ $isActive ? 'bg-[#1F653F]' : 'bg-gray-500' }} rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                            <span class="text-white font-bold text-sm">{{ $sem }}</span>
                        </div>
                        <p class="text-xs text-gray-600 font-semibold">Semester {{ $sem }}</p>
                    </div>
                    <p class="text-2xl font-extrabold {{ $isActive ? 'text-[#1F653F]' : 'text-gray-700' }}">-- <span class="text-sm font-semibold">SKS</span></p>
                    <p class="text-xs text-gray-500 mt-1 font-medium">-- Mata Kuliah</p>
                </div>
                @endfor
            </div>

            {{-- Detail Table (Hidden by default) --}}
            <div id="detail-{{ $kurikulum->kurikulum_id }}" class="hidden mt-6">
                <div class="p-8 text-center text-gray-500 italic bg-gray-50 rounded-2xl border-2 border-dashed border-gray-300">
                    Fitur detail per semester akan dikembangkan lebih lanjut.
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-3 mt-8 pt-6 border-t-2 border-gray-200">
                <button class="flex-1 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-5 py-3 rounded-xl font-bold transition-all shadow-lg hover:shadow-xl flex items-center justify-center gap-2 active:scale-95">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    Lihat Detail
                </button>
                <a href="{{ route('akademik.kurikulum.show', $kurikulum->kurikulum_id) }}" class="flex-1 bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 text-white px-5 py-3 rounded-xl font-bold transition-all shadow-lg hover:shadow-xl flex items-center justify-center gap-2 active:scale-95">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    Kelola MK
                </a>
                <button onclick='editKurikulum(@json($kurikulum))' class="bg-gray-100 hover:bg-gray-200 text-gray-700 p-3 rounded-xl font-bold transition-all shadow-sm flex items-center justify-center active:scale-95">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </button>
                <button class="flex-1 bg-gradient-to-r from-purple-500 to-indigo-600 hover:from-purple-600 hover:to-indigo-700 text-white px-5 py-3 rounded-xl font-bold transition-all shadow-lg hover:shadow-xl flex items-center justify-center gap-2 active:scale-95">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                    Duplikat
                </button>
                @if(!$isActive)
                <form action="{{ route('akademik.kurikulum.delete', $kurikulum->kurikulum_id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kurikulum ini?')" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-5 py-3 rounded-xl font-bold transition-all shadow-lg hover:shadow-xl flex items-center gap-2 active:scale-95">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Hapus
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- Modal Tambah/Edit --}}
<div id="kurikulumModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-3xl w-full max-h-[90vh] overflow-y-auto">
        {{-- Modal Header --}}
        <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 text-white p-6 rounded-t-2xl sticky top-0 z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h2 id="modalTitle" class="text-2xl font-bold mb-1">Tambah Kurikulum Baru</h2>
                    <p class="text-emerald-100 text-sm">Lengkapi informasi kurikulum</p>
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
            <form id="kurikulumForm" method="POST" action="{{ route('akademik.kurikulum.store') }}">
                @csrf
                <div id="methodField"></div>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Kurikulum <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" required placeholder="Contoh: Kurikulum RPL 2024" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Program Studi <span class="text-red-500">*</span></label>
                            <select name="prodi_id" required class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white">
                                <option value="">Pilih Program Studi</option>
                                @foreach($prodis as $p)
                                    <option value="{{ $p->prodi_id }}">{{ $p->nama_prodi }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Tahun Kurikulum <span class="text-red-500">*</span></label>
                            <select name="tahun" required class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white">
                                <option value="">Pilih Tahun</option>
                                <option>2025</option>
                                <option>2024</option>
                                <option>2023</option>
                                <option>2022</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Total SKS <span class="text-red-500">*</span></label>
                            <input type="number" readonly value="Auto calculated" class="w-full border-2 border-gray-200 bg-gray-50 rounded-lg px-4 py-3 text-sm focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah Semester <span class="text-red-500">*</span></label>
                            <select name="semester" required class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white">
                                <option value="">Pilih Semester</option>
                                <option>6</option>
                                <option selected>8</option>
                                <option>10</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                        <textarea name="deskripsi" rows="3" placeholder="Jelaskan karakteristik kurikulum ini..." class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                        <select name="status" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white">
                            <option selected>Aktif</option>
                            <option>Tidak Aktif</option>
                        </select>
                    </div>

                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                            <div class="text-sm text-blue-800">
                                <p class="font-semibold mb-1">Informasi:</p>
                                <p>Setelah kurikulum dibuat, Anda dapat menambahkan mata kuliah ke dalam kurikulum melalui menu detail kurikulum.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        {{-- Modal Footer --}}
        <div class="bg-gray-50 px-6 py-4 rounded-b-2xl flex items-center justify-end gap-3 border-t">
            <button onclick="closeModal()" class="px-6 py-2.5 border-2 border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-100 transition">
                Batal
            </button>
            <button onclick="saveKurikulum()" class="px-6 py-2.5 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white rounded-xl font-semibold transition shadow-md">
                Simpan
            </button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function openAddModal() {
    document.getElementById('modalTitle').textContent = 'Tambah Kurikulum Baru';
    const form = document.getElementById('kurikulumForm');
    form.reset();
    form.action = "{{ route('akademik.kurikulum.store') }}";
    document.getElementById('methodField').innerHTML = '';
    document.getElementById('kurikulumModal').classList.remove('hidden');
    document.getElementById('kurikulumModal').classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function editKurikulum(kur) {
    document.getElementById('modalTitle').textContent = 'Edit Kurikulum';
    const form = document.getElementById('kurikulumForm');
    form.reset();
    form.action = `/akademik/kurikulum/${kur.kurikulum_id}`;
    document.getElementById('methodField').innerHTML = '@method("PUT")';
    
    form.nama.value = kur.nama_kurikulum;
    form.prodi_id.value = kur.prodi_id;
    form.tahun.value = kur.tahun_berlaku;
    form.status.value = kur.status;
    form.deskripsi.value = kur.deskripsi || '';

    document.getElementById('kurikulumModal').classList.remove('hidden');
    document.getElementById('kurikulumModal').classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function saveKurikulum() {
    document.getElementById('kurikulumForm').submit();
}

function toggleStatus(id) {
    if(confirm('Ubah status kurikulum ini?')) {
        alert('Status kurikulum berhasil diubah!');
    }
}

function deleteKurikulum(id) {
    if(confirm('Yakin ingin menghapus kurikulum ini?\n\nPeringatan: Semua mata kuliah dalam kurikulum ini akan terpengaruh!')) {
        alert('Kurikulum berhasil dihapus!');
    }
}
</script>
@endpush