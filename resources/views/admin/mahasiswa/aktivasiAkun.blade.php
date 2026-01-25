@extends('layouts.app')

@section('content')

@include('partials.credential_alert')

{{-- Info Alert --}}
<div class="bg-gradient-to-r from-blue-50 to-blue-100 border-2 border-blue-200 rounded-2xl p-5 mb-6">
    <div class="flex items-start gap-4">
        <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
        </div>
        <div class="flex-1">
            <h3 class="font-bold text-gray-800 mb-2">Informasi Aktivasi Akun</h3>
            <ul class="space-y-1 text-sm text-gray-700">
                <li class="flex items-start gap-2">
                    <span class="text-blue-600">•</span>
                    <span>Generate akun untuk mahasiswa yang sudah memiliki biodata lengkap tapi belum memiliki akun login.</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-blue-600">•</span>
                    <span>Username otomatis menggunakan NIM mahasiswa.</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-blue-600">•</span>
                    <span>Password default akan di-generate otomatis dan ditampilkan setelah aktivasi.</span>
                </li>
            </ul>
        </div>
    </div>
</div>

{{-- Filter Section --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 mb-6">
    <form action="{{ route('admin.mahasiswa.aktivasiAkun') }}" method="GET" class="flex items-center gap-3 flex-wrap">
        <div class="relative flex-1 min-w-[300px]">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari mahasiswa (NIM/Nama)..." class="w-full border-2 border-gray-300 rounded-lg pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500">
            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
        
        <select name="prodi" class="border-2 border-gray-300 rounded-lg px-4 py-2.5 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-purple-500 bg-white">
            <option value="">Semua Prodi</option>
            @foreach($prodis as $p)
                <option value="{{ $p->nama_prodi }}" {{ request('prodi') == $p->nama_prodi ? 'selected' : '' }}>{{ $p->nama_prodi }}</option>
            @endforeach
        </select>

        <button type="submit" class="px-4 py-2.5 bg-purple-500 hover:bg-purple-600 text-white rounded-lg text-sm font-semibold transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
            Filter
        </button>
    </form>
</div>

{{-- Summary Stats --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-6">
    <div class="bg-gradient-to-br from-orange-500 to-orange-600 text-white p-5 rounded-xl shadow-lg">
        <div class="flex items-center justify-between mb-2">
            <p class="text-sm opacity-90">Belum Punya Akun</p>
            <svg class="w-6 h-6 opacity-75" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
        </div>
        <p class="text-4xl font-bold">{{ $stats['pending'] }}</p>
    </div>

    <div class="bg-gradient-to-br from-green-500 to-green-600 text-white p-5 rounded-xl shadow-lg">
        <div class="flex items-center justify-between mb-2">
            <p class="text-sm opacity-90">Akun Aktif</p>
            <svg class="w-6 h-6 opacity-75" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
        </div>
        <p class="text-4xl font-bold">{{ $stats['active'] }}</p>
    </div>

    <div class="bg-gradient-to-br from-red-500 to-red-600 text-white p-5 rounded-xl shadow-lg">
        <div class="flex items-center justify-between mb-2">
            <p class="text-sm opacity-90">Akun Non-Aktif</p>
            <svg class="w-6 h-6 opacity-75" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M13.477 14.89A6 6 0 015.11 6.524l8.367 8.368zm1.414-1.414L6.524 5.11a6 6 0 018.367 8.367zM18 10a8 8 0 11-16 0 8 8 0 0116 0z" clip-rule="evenodd"></path>
            </svg>
        </div>
        <p class="text-4xl font-bold">{{ $stats['inactive'] }}</p>
    </div>

    <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white p-5 rounded-xl shadow-lg">
        <div class="flex items-center justify-between mb-2">
            <p class="text-sm opacity-90">Total Mahasiswa</p>
            <svg class="w-6 h-6 opacity-75" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
            </svg>
        </div>
        <p class="text-4xl font-bold">{{ $stats['total'] }}</p>
    </div>
</div>

{{-- Mahasiswa List (Belum Punya Akun) --}}
<div class="space-y-5">
    @forelse($mahasiswas as $mhs)
    <div class="bg-white rounded-2xl shadow-sm border-2 border-orange-200 hover:shadow-lg transition overflow-hidden">
        {{-- Header --}}
        <div class="bg-gradient-to-r from-orange-50 to-orange-100 p-5 border-b-2 border-orange-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center text-white font-bold text-2xl shadow-lg">
                        {{ strtoupper(substr($mhs->nama, 0, 1)) }}
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">{{ $mhs->nama }}</h3>
                        <div class="flex items-center gap-3 mt-1">
                            <p class="text-sm text-gray-600">NIM: {{ $mhs->npm }}</p>
                            <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-semibold">
                                {{ $mhs->prodi->nama_prodi ?? '-' }}
                            </span>
                            <span class="text-sm text-gray-500">Angkatan {{ $mhs->angkatan }}</span>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <span class="px-4 py-2 bg-orange-500 text-white rounded-full text-sm font-semibold inline-flex items-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                        Belum Punya Akun
                    </span>
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="p-6">
            {{-- Info Mahasiswa --}}
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                    <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                    </svg>
                    <div>
                        <p class="text-xs text-gray-500">Email</p>
                        <p class="text-sm font-semibold text-gray-800">{{ $mhs->email_pribadi ?? '-' }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                    <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                    </svg>
                    <div>
                        <p class="text-xs text-gray-500">No. Telepon</p>
                        <p class="text-sm font-semibold text-gray-800">{{ $mhs->no_hp ?? '-' }}</p>
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-3">
                <form action="{{ route('admin.mahasiswa.generate') }}" method="POST" class="flex-1" onsubmit="return confirm('Generate akun untuk {{ $mhs->nama }}?');">
                    @csrf
                    <input type="hidden" name="nim" value="{{ $mhs->npm }}">
                    <button type="submit" class="w-full bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white px-6 py-3 rounded-xl font-semibold transition shadow-lg flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 8a6 6 0 01-7.743 5.743L10 14l-1 1-1 1H6v2H2v-4l4.257-4.257A6 6 0 1118 8zm-6-4a1 1 0 100 2 2 2 0 012 2 1 1 0 102 0 4 4 0 00-4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Generate Akun Sekarang</span>
                    </button>
                </form>

                <a href="{{ route('admin.mahasiswa.edit', $mhs->mahasiswa_id) }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-xl font-semibold transition border-2 border-gray-300 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    Detail Biodata
                </a>
            </div>
        </div>
    </div>
    @empty
    <div class="text-center py-10 bg-gray-50 rounded-xl border-dashed border-2 border-gray-300">
        <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <p class="text-gray-500 font-medium">Tidak ada mahasiswa yang perlu aktivasi akun (semua sudah punya akun).</p>
    </div>
    @endforelse
</div>

{{-- Pagination --}}
<div class="mt-6">
    {{ $mahasiswas->withQueryString()->links() }}
</div>

@endsection