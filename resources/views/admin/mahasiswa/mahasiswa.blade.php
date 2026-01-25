@extends('layouts.app')

@section('content')

@include('partials.credential_alert')

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
                <h2 class="text-3xl font-extrabold tracking-tight">Kelola Data Mahasiswa</h2>
            </div>
            <p class="text-emerald-100 text-base ml-15">Manajemen data mahasiswa</p>
        </div>
        <a href="{{ route('admin.mahasiswa.form') }}" class="flex items-center gap-3 bg-white text-[#1F653F] px-8 py-4 rounded-2xl font-bold text-base hover:scale-105 hover:shadow-2xl transition-all shadow-xl active:scale-95 group">
            <div class="w-8 h-8 bg-[#1F653F] rounded-lg flex items-center justify-center group-hover:rotate-90 transition-transform duration-300">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
            </div>
            Tambah Mahasiswa
        </a>
    </div>
</div>


{{-- Filter & Search --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 mb-6">
    <form action="{{ route('admin.mahasiswa.mahasiswa') }}" method="GET" class="flex items-center gap-3 flex-wrap">
        <div class="relative flex-1 min-w-[300px]">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari mahasiswa (Nama/NIM)..." class="w-full border-2 border-gray-300 rounded-lg pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
        
        <select name="prodi" class="border-2 border-gray-300 rounded-lg px-4 py-2.5 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
            <option value="">Semua Prodi</option>
            @foreach($prodis as $prodi)
                <option value="{{ $prodi->nama_prodi }}" {{ request('prodi') == $prodi->nama_prodi ? 'selected' : '' }}>{{ $prodi->nama_prodi }}</option>
            @endforeach
        </select>

        <select name="status" class="border-2 border-gray-300 rounded-lg px-4 py-2.5 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
            <option value="">Semua Status</option>
            @foreach(['Aktif', 'Cuti', 'Non-Aktif', 'Lulus', 'Keluar', 'DO'] as $st)
                <option value="{{ $st }}" {{ request('status') == $st ? 'selected' : '' }}>{{ $st }}</option>
            @endforeach
        </select>

        <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-semibold transition shadow-md">
            Filter
        </button>
        {{-- Export button can remain but inactive/separate for now or kept as UI --}}
        {{-- <button type="button" class="px-4 py-2.5 bg-[#1F653F] text-white rounded-lg text-sm font-semibold transition">
            Export Excel
        </button> --}}
    </form>
</div>

{{-- Stats --}}
<div class="grid grid-cols-4 gap-5 mb-6">
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white p-5 rounded-xl shadow-lg">
        <p class="text-sm opacity-90 mb-1">Total</p>
        <p class="text-4xl font-bold">{{ $stats['total'] }}</p>
    </div>
    <div class="bg-gradient-to-br from-green-500 to-green-600 text-white p-5 rounded-xl shadow-lg">
        <p class="text-sm opacity-90 mb-1">Aktif</p>
        <p class="text-4xl font-bold">{{ $stats['aktif'] }}</p>
    </div>
    <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 text-white p-5 rounded-xl shadow-lg">
        <p class="text-sm opacity-90 mb-1">Cuti</p>
        <p class="text-4xl font-bold">{{ $stats['cuti'] }}</p>
    </div>
    <div class="bg-gradient-to-br from-red-500 to-red-600 text-white p-5 rounded-xl shadow-lg">
        <p class="text-sm opacity-90 mb-1">Non-Aktif</p>
        <p class="text-4xl font-bold">{{ $stats['non_aktif'] }}</p>
    </div>
</div>

{{-- Table --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gradient-to-r from-[#1F653F] via-[#2F8054] to-[#47AF76] text-white">
                    <th class="px-6 py-4 text-left text-sm font-semibold">NIM</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold">Nama</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold">Prodi</th>
                    <th class="px-6 py-4 text-center text-sm font-semibold">Semester</th>
                    <th class="px-6 py-4 text-center text-sm font-semibold">IPK</th>
                    <th class="px-6 py-4 text-center text-sm font-semibold">Status</th>
                    <th class="px-6 py-4 text-center text-sm font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($mahasiswas as $mhs)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-sm font-semibold text-gray-800">{{ $mhs->npm }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <span class="text-blue-600 font-bold text-sm">{{ substr($mhs->nama, 0, 1) }}</span>
                            </div>
                            <span class="text-sm font-semibold text-gray-800">{{ $mhs->nama }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-semibold">{{ $mhs->prodi->nama_prodi ?? '-' }}</span>
                    </td>
                    <td class="px-6 py-4 text-center text-sm font-semibold text-gray-800">{{ $mhs->semester_sekarang }}</td>
                    <td class="px-6 py-4 text-center text-sm font-bold text-green-600">-</td>
                    <td class="px-6 py-4 text-center">
                        @php
                            $statusColor = match($mhs->status) {
                                'Aktif' => 'bg-green-100 text-green-700',
                                'Cuti' => 'bg-yellow-100 text-yellow-700',
                                'Non-Aktif' => 'bg-red-100 text-red-700',
                                'Lulus' => 'bg-blue-100 text-blue-700',
                                'Keluar' => 'bg-gray-100 text-gray-700',
                                'DO' => 'bg-red-100 text-red-700',
                                default => 'bg-gray-100 text-gray-700',
                            };
                        @endphp
                        <span class="px-3 py-1 {{ $statusColor }} rounded-full text-xs font-semibold">{{ $mhs->status }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <button class="p-2 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-lg transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                            <a href="{{ route('admin.mahasiswa.edit', $mhs->mahasiswa_id) }}" class="p-2 bg-orange-100 hover:bg-orange-200 text-orange-600 rounded-lg transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                            <form action="{{ route('admin.mahasiswa.delete', $mhs->mahasiswa_id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus mahasiswa ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 bg-red-100 hover:bg-red-200 text-red-600 rounded-lg transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('scripts')
<script>

function openEditModal(nim) {
    alert('Edit mahasiswa dengan NIM: ' + nim);
}

function deleteMahasiswa(nim) {
    if(confirm('Yakin ingin menghapus mahasiswa dengan NIM ' + nim + '?')) {
        alert('Mahasiswa berhasil dihapus!');
    }
}
</script>
@endpush