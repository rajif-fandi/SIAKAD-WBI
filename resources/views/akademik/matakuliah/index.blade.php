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
                <h1 class="text-3xl font-extrabold tracking-tight">Kelola Mata Kuliah</h1>
                <p class="text-emerald-100 text-base mt-1">Manajemen data mata kuliah program studi</p>
            </div>
        </div>
        <button onclick="openAddModal()" class="flex items-center gap-3 bg-white text-[#1F653F] px-8 py-4 rounded-2xl font-bold text-base hover:scale-105 hover:shadow-2xl transition-all shadow-xl active:scale-95 group">
            <div class="w-8 h-8 bg-[#1F653F] rounded-lg flex items-center justify-center group-hover:rotate-90 transition-transform duration-300">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                </svg>
            </div>
            Tambah Mata Kuliah
        </button>
    </div>
</div>

{{-- Filter & Search --}}
<div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-8">
    <div class="flex items-center gap-4 flex-wrap">
        <div class="flex-1 min-w-[300px]">
            <div class="relative group">
                <div class="absolute left-4 top-1/2 transform -translate-y-1/2 w-10 h-10 bg-gradient-to-br from-[#1F653F]/10 to-transparent rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-[#1F653F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="text" placeholder="Cari kode atau nama mata kuliah..." class="w-full pl-16 pr-4 py-3.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] transition-all text-sm group-hover:border-[#2F8054]">
            </div>
        </div>
        
        <select name="prodi_id" onchange="this.form.submit()" class="border-2 border-gray-200 rounded-xl px-5 py-3.5 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] bg-white transition-all hover:border-[#2F8054]">
            <option value="">Semua Prodi</option>
            @foreach($prodis as $p)
                <option value="{{ $p->prodi_id }}" {{ request('prodi_id') == $p->prodi_id ? 'selected' : '' }}>{{ $p->nama_prodi }}</option>
            @endforeach
        </select>

        <select class="border-2 border-gray-200 rounded-xl px-5 py-3.5 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] bg-white transition-all hover:border-[#2F8054]">
            <option value="">Semua Semester</option>
            @for($i = 1; $i <= 8; $i++)
                <option>Semester {{ $i }}</option>
            @endfor
        </select>

        <select class="border-2 border-gray-200 rounded-xl px-5 py-3.5 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] bg-white transition-all hover:border-[#2F8054]">
            <option value="">Semua Jenis</option>
            <option>Teori</option>
            <option>Praktikum</option>
            <option>Gabungan</option>
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
            <p class="text-sm text-gray-600 font-semibold mb-2">Total Mata Kuliah</p>
            <p class="text-4xl font-extrabold text-gray-900 mb-1">{{ $stats['total'] }}</p>
            <div class="flex items-center gap-2">
                <span class="text-xs px-2 py-1 bg-emerald-100 text-emerald-700 rounded-full font-semibold">Semua Prodi</span>
            </div>
        </div>
    </div>

    <div class="group bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-blue-200 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-500/10 to-transparent rounded-bl-full"></div>
        <div class="relative z-10">
            <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <p class="text-sm text-gray-600 font-semibold mb-2">Mata Kuliah Wajib</p>
            <p class="text-4xl font-extrabold text-gray-900 mb-1">{{ $stats['wajib'] }}</p>
            <div class="flex items-center gap-2">
                <span class="text-xs px-2 py-1 bg-blue-100 text-blue-700 rounded-full font-semibold">Wajib</span>
            </div>
        </div>
    </div>

    <div class="group bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-amber-200 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-amber-500/10 to-transparent rounded-bl-full"></div>
        <div class="relative z-10">
            <div class="w-14 h-14 bg-gradient-to-br from-amber-500 to-orange-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <p class="text-sm text-gray-600 font-semibold mb-2">Mata Kuliah Pilihan</p>
            <p class="text-4xl font-extrabold text-gray-900 mb-1">{{ $stats['pilihan'] }}</p>
            <div class="flex items-center gap-2">
                <span class="text-xs px-2 py-1 bg-amber-100 text-amber-700 rounded-full font-semibold">Pilihan</span>
            </div>
        </div>
    </div>

    <div class="group bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-purple-200 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-purple-500/10 to-transparent rounded-bl-full"></div>
        <div class="relative z-10">
            <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <p class="text-sm text-gray-600 font-semibold mb-2">Total SKS</p>
            <p class="text-4xl font-extrabold text-gray-900 mb-1">{{ $stats['total_sks'] }}</p>
            <div class="flex items-center gap-2">
                <span class="text-xs px-2 py-1 bg-purple-100 text-purple-700 rounded-full font-semibold">Akumulasi</span>
            </div>
        </div>
    </div>
</div>

{{-- Table --}}
<div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gradient-to-r from-[#1F653F] via-[#2F8054] to-[#47AF76] text-white">
                    <th class="px-6 py-5 text-left text-sm font-bold uppercase tracking-wider">Kode MK</th>
                    <th class="px-6 py-5 text-left text-sm font-bold uppercase tracking-wider">Nama Mata Kuliah</th>
                    <th class="px-6 py-5 text-center text-sm font-bold uppercase tracking-wider">SKS</th>
                    <th class="px-6 py-5 text-center text-sm font-bold uppercase tracking-wider">Semester</th>
                    <th class="px-6 py-5 text-left text-sm font-bold uppercase tracking-wider">Prodi</th>
                    <th class="px-6 py-5 text-center text-sm font-bold uppercase tracking-wider">Jenis</th>
                    <th class="px-6 py-5 text-center text-sm font-bold uppercase tracking-wider">Status</th>
                    <th class="px-6 py-5 text-center text-sm font-bold uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($matakuliah as $mk)
                <tr class="hover:bg-gradient-to-r hover:from-emerald-50/50 hover:to-transparent transition-all group">
                    <td class="px-6 py-5">
                        <span class="text-sm font-bold font-mono text-gray-900 bg-gray-100 px-3 py-1.5 rounded-lg">{{ $mk->kode_mk }}</span>
                    </td>
                    <td class="px-6 py-5">
                        <p class="text-sm font-bold text-gray-900">{{ $mk->nama_mk }}</p>
                    </td>
                    <td class="px-6 py-5 text-center">
                        <span class="inline-block bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-4 py-1.5 rounded-lg text-xs font-bold shadow-md">{{ $mk->sks }} SKS</span>
                    </td>
                    <td class="px-6 py-5 text-center">
                        <span class="text-sm font-bold text-gray-800">{{ $mk->semester_paket }}</span>
                    </td>
                    <td class="px-6 py-5">
                        <span class="inline-block bg-gradient-to-r from-purple-500 to-indigo-600 text-white px-4 py-1.5 rounded-lg text-xs font-bold shadow-md">{{ $mk->prodi->nama_prodi ?? '-' }}</span>
                    </td>
                    <td class="px-6 py-5 text-center">
                        @php
                            $jenisColor = [
                                'Gabungan' => 'cyan-500 to-blue-600',
                                'Teori' => 'emerald-500 to-green-600',
                                'Praktikum' => 'amber-500 to-orange-600'
                            ][$mk->jenis] ?? 'gray-500 to-gray-600';
                        @endphp
                        <span class="inline-block bg-gradient-to-r from-{{ $jenisColor }} text-white px-4 py-1.5 rounded-lg text-xs font-bold shadow-md">{{ $mk->jenis }}</span>
                    </td>
                    <td class="px-6 py-5 text-center">
                        @if($mk->status == 'Wajib')
                            <span class="inline-flex items-center gap-1.5 bg-gradient-to-r from-red-500 to-rose-600 text-white px-4 py-1.5 rounded-lg text-xs font-bold shadow-md">
                                <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                                Wajib
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 bg-gradient-to-r from-amber-500 to-orange-600 text-white px-4 py-1.5 rounded-lg text-xs font-bold shadow-md">
                                <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                                Pilihan
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
                            <button onclick='openEditModal(@json($mk))' class="p-2.5 bg-emerald-50 hover:bg-gradient-to-br hover:from-[#1F653F] hover:to-[#2F8054] text-emerald-600 hover:text-white rounded-xl transition-all shadow-sm hover:shadow-md" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <form action="{{ route('akademik.matakuliah.delete', $mk->matakuliah_id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus mata kuliah ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2.5 bg-red-50 hover:bg-gradient-to-br hover:from-red-500 hover:to-red-600 text-red-600 hover:text-white rounded-xl transition-all shadow-sm hover:shadow-md" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
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

    {{-- Pagination --}}
    <div class="bg-gradient-to-r from-gray-50 to-white px-6 py-5 border-t border-gray-200">
        {{ $matakuliah->links() }}
    </div>
</div>

{{-- Modal Tambah/Edit --}}
<div id="matkulModal" class="fixed inset-0 bg-black/70 backdrop-blur-md z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl max-w-3xl w-full max-h-[90vh] overflow-hidden">
        {{-- Modal Header --}}
        <div class="bg-gradient-to-r from-[#1F653F] via-[#2F8054] to-[#47AF76] text-white p-8 sticky top-0 z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h2 id="modalTitle" class="text-2xl font-extrabold mb-1">Tambah Mata Kuliah</h2>
                    <p class="text-emerald-100 text-sm">Lengkapi informasi mata kuliah dengan teliti</p>
                </div>
                <button onclick="closeModal()" class="w-10 h-10 bg-white/20 hover:bg-white/30 rounded-xl flex items-center justify-center transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Modal Body --}}
        <div class="p-8 overflow-y-auto" style="max-height: calc(90vh - 200px);">
            <form id="matkulForm" method="POST" action="{{ route('akademik.matakuliah.store') }}">
                @csrf
                <div id="methodField"></div>
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-2 flex items-center gap-2">
                            <span class="w-1.5 h-1.5 bg-[#1F653F] rounded-full"></span>
                            Kode Mata Kuliah <span class="text-red-500">*</span></label>
                        <input type="text" name="kode" required class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <p class="text-xs text-gray-500 mt-1">Contoh: IFI-322507</p>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Mata Kuliah <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" required class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">SKS <span class="text-red-500">*</span></label>
                            <select name="sks" required class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                                <option value="">Pilih SKS</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Semester <span class="text-red-500">*</span></label>
                            <select name="semester" required class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                                <option value="">Pilih Semester</option>
                                @for($i = 1; $i <= 8; $i++)
                                    <option>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Program Studi <span class="text-red-500">*</span></label>
                        <select name="prodi_id" required class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                            <option value="">Pilih Program Studi</option>
                            @foreach($prodis as $p)
                                <option value="{{ $p->prodi_id }}">{{ $p->nama_prodi }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Mata Kuliah</label>
                            <select name="jenis" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                                <option>Teori</option>
                                <option>Praktikum</option>
                                <option>Gabungan</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                            <select name="status" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                                <option>Wajib</option>
                                <option>Pilihan</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                        <textarea name="deskripsi" rows="3" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Prasyarat (Jika Ada)</label>
                        <input type="text" name="prasyarat" placeholder="Contoh: IFI-211201, IFI-211305" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <p class="text-xs text-gray-500 mt-1">Pisahkan dengan koma jika lebih dari 1</p>
                    </div>
                </div>
            </form>
        </div>

        {{-- Modal Footer --}}
        <div class="bg-gray-50 px-6 py-4 rounded-b-2xl flex items-center justify-end gap-3 border-t">
            <button onclick="closeModal()" class="px-6 py-2.5 border-2 border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-100 transition">
                Batal
            </button>
            <button onclick="saveMatkul()" class="px-6 py-2.5 bg-gradient-to-r from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 text-white rounded-xl font-semibold transition shadow-md">
                Simpan
            </button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function openAddModal() {
    document.getElementById('modalTitle').textContent = 'Tambah Mata Kuliah';
    document.getElementById('matkulForm').reset();
    document.getElementById('matkulForm').action = "{{ route('akademik.matakuliah.store') }}";
    document.getElementById('methodField').innerHTML = '';
    document.getElementById('matkulModal').classList.remove('hidden');
    document.getElementById('matkulModal').classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function openEditModal(mk) {
    document.getElementById('modalTitle').textContent = 'Edit Mata Kuliah';
    const form = document.getElementById('matkulForm');
    form.reset();
    form.action = `/akademik/matakuliah/${mk.matakuliah_id}`;
    document.getElementById('methodField').innerHTML = '@method("PUT")';
    
    form.kode.value = mk.kode_mk;
    form.nama.value = mk.nama_mk;
    form.sks.value = mk.sks;
    form.semester.value = mk.semester_paket;
    form.prodi_id.value = mk.prodi_id;
    form.jenis.value = mk.jenis;
    form.status.value = mk.status;
    form.deskripsi.value = mk.deskripsi;

    document.getElementById('matkulModal').classList.remove('hidden');
    document.getElementById('matkulModal').classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('matkulModal').classList.add('hidden');
    document.getElementById('matkulModal').classList.remove('flex');
    document.body.style.overflow = 'auto';
}

function saveMatkul() {
    document.getElementById('matkulForm').submit();
}

function deleteMatkul(kode) {
    if(confirm('Yakin ingin menghapus mata kuliah ' + kode + '?')) {
        alert('Mata kuliah berhasil dihapus!');
    }
}
</script>
@endpush