@extends('layouts.app')

@section('content')

{{-- Header Section --}}
<div class="relative bg-gradient-to-br from-indigo-700 via-blue-600 to-blue-500 text-white p-10 rounded-3xl mb-10 shadow-2xl overflow-hidden">
    <div class="relative z-10">
        <div class="flex items-center gap-4 mb-4">
            <a href="{{ route('akademik.kurikulum.index') }}" class="p-2.5 bg-white/20 hover:bg-white/30 rounded-xl transition-all backdrop-blur-md group">
                <svg class="w-6 h-6 text-white group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <h1 class="text-4xl font-black">{{ $kurikulum->nama_kurikulum }}</h1>
                <p class="text-blue-100 flex items-center gap-2 mt-1">
                    <span class="font-bold">{{ $kurikulum->prodi->nama_prodi }}</span>
                    <span>•</span>
                    <span class="font-bold">Tahun Berlaku: {{ $kurikulum->tahun_berlaku }}</span>
                </p>
            </div>
        </div>
    </div>
    
    {{-- Floating Actions --}}
    <div class="absolute top-10 right-10 z-10 flex gap-4">
        <button onclick="openAddMatkulModal()" class="px-8 py-4 bg-white text-blue-600 rounded-2xl font-black shadow-xl hover:shadow-2xl hover:scale-105 active:scale-95 transition-all flex items-center gap-3">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Mata Kuliah
        </button>
    </div>

    {{-- Abstract background patterns --}}
    <div class="absolute -top-20 -right-20 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-indigo-400/20 rounded-full blur-2xl"></div>
</div>

{{-- Content Grid --}}
<div class="grid grid-cols-1 gap-10">
    @php
        $semesters = [1, 2, 3, 4, 5, 6, 7, 8];
    @endphp

    @foreach($semesters as $sem)
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden transform transition-all hover:shadow-2xl">
            <div class="bg-gradient-to-r from-gray-50 to-white px-8 py-6 border-b border-gray-100 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center text-white font-black text-xl shadow-lg ring-4 ring-blue-50">
                        {{ $sem }}
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-gray-900">Semester {{ $sem }}</h3>
                        <p class="text-sm text-gray-500 font-bold">{{ $sem % 2 == 0 ? 'GENAP' : 'GANJIL' }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-6">
                    <div class="text-right">
                        <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Total SKS</p>
                        <p class="text-2xl font-black text-blue-600">{{ $kurikulum->matakuliah->where('pivot.semester_ke', $sem)->sum('sks') }}</p>
                    </div>
                </div>
            </div>

            <div class="p-8">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left border-b-2 border-gray-50">
                                <th class="px-4 py-4 text-xs font-black text-gray-400 uppercase tracking-widest">Kode</th>
                                <th class="px-4 py-4 text-xs font-black text-gray-400 uppercase tracking-widest">Mata Kuliah</th>
                                <th class="px-4 py-4 text-center text-xs font-black text-gray-400 uppercase tracking-widest">SKS</th>
                                <th class="px-4 py-4 text-center text-xs font-black text-gray-400 uppercase tracking-widest">Jenis</th>
                                <th class="px-4 py-4 text-center text-xs font-black text-gray-400 uppercase tracking-widest">Status</th>
                                <th class="px-4 py-4 text-right text-xs font-black text-gray-400 uppercase tracking-widest">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($kurikulum->matakuliah->where('pivot.semester_ke', $sem) as $mk)
                                <tr class="group hover:bg-blue-50/30 transition-all">
                                    <td class="px-4 py-5 font-mono text-sm font-bold text-gray-900">{{ $mk->kode_mk }}</td>
                                    <td class="px-4 py-5">
                                        <p class="font-bold text-gray-900">{{ $mk->nama_mk }}</p>
                                    </td>
                                    <td class="px-4 py-5 text-center font-black text-blue-600">{{ $mk->sks }}</td>
                                    <td class="px-4 py-5 text-center">
                                        <span class="text-[10px] font-black px-3 py-1 bg-gray-100 text-gray-600 rounded-lg">{{ $mk->jenis }}</span>
                                    </td>
                                    <td class="px-4 py-5 text-center">
                                        @if($mk->pivot->wajib)
                                            <span class="text-[10px] font-black px-3 py-1 bg-emerald-100 text-emerald-700 rounded-lg">WAJIB</span>
                                        @else
                                            <span class="text-[10px] font-black px-3 py-1 bg-amber-100 text-amber-700 rounded-lg">PILIHAN</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-5 text-right">
                                        <form action="{{ route('akademik.kurikulum.detach', [$kurikulum->kurikulum_id, $mk->matakuliah_id]) }}" method="POST" onsubmit="return confirm('Hapus mata kuliah dari kurikulum?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2.5 text-red-500 hover:bg-red-50 rounded-xl transition-all shadow-sm hover:shadow-md">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-10 text-center text-gray-400 font-bold italic">
                                        Belum ada mata kuliah yang ditambahkan ke semester ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
</div>

{{-- Modal Tambah Mata Kuliah --}}
<div id="addMatkulModal" class="fixed inset-0 z-[60] hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" onclick="closeAddMatkulModal()"></div>
    <div class="relative bg-white w-full max-w-2xl rounded-3xl shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-300">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-8 text-white flex justify-between items-center">
            <div>
                <h3 class="text-2xl font-black">Tambah Mata Kuliah</h3>
                <p class="text-blue-100 text-sm mt-1">Tambahkan MK ke dalam struktur kurikulum</p>
            </div>
            <button onclick="closeAddMatkulModal()" class="p-2 hover:bg-white/20 rounded-xl transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>

        <form action="{{ route('akademik.kurikulum.attach', $kurikulum->kurikulum_id) }}" method="POST" class="p-8 space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-black text-gray-700 mb-2">Pilih Mata Kuliah <span class="text-red-500">*</span></label>
                <select name="matkul_id" required class="w-full border-2 border-gray-200 rounded-xl px-4 py-4 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white transition-all">
                    <option value="">-- Pilih Mata Kuliah --</option>
                    @foreach($allMatakuliah as $amk)
                        <option value="{{ $amk->matakuliah_id }}">{{ $amk->kode_mk }} - {{ $amk->nama_mk }} ({{ $amk->sks }} SKS)</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-black text-gray-700 mb-2">Semester <span class="text-red-500">*</span></label>
                    <select name="semester" required class="w-full border-2 border-gray-200 rounded-xl px-4 py-4 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white transition-all">
                        @foreach($semesters as $s)
                            <option value="{{ $s }}">Semester {{ $s }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-black text-gray-700 mb-2">Tipe Semester <span class="text-red-500">*</span></label>
                    <select name="tipe" required class="w-full border-2 border-gray-200 rounded-xl px-4 py-4 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white transition-all">
                        <option value="ganjil">Ganjil</option>
                        <option value="genap">Genap</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-black text-gray-700 mb-2">Status <span class="text-red-500">*</span></label>
                <div class="flex gap-4">
                    <label class="flex-1 border-2 border-gray-200 rounded-xl p-4 cursor-pointer hover:border-blue-500 transition-all">
                        <input type="radio" name="wajib" value="1" checked class="hidden peer">
                        <div class="text-center font-black text-gray-500 peer-checked:text-blue-600">WAJIB</div>
                    </label>
                    <label class="flex-1 border-2 border-gray-200 rounded-xl p-4 cursor-pointer hover:border-blue-500 transition-all">
                        <input type="radio" name="wajib" value="0" class="hidden peer">
                        <div class="text-center font-black text-gray-500 peer-checked:text-amber-600">PILIHAN</div>
                    </label>
                </div>
            </div>

            <div class="flex gap-4 pt-4">
                <button type="button" onclick="closeAddMatkulModal()" class="flex-1 px-8 py-4 border-2 border-gray-300 rounded-2xl font-black text-gray-700 hover:bg-gray-50 transition-all">
                    Batal
                </button>
                <button type="submit" class="flex-1 px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-2xl font-black shadow-lg hover:shadow-xl transition-all">
                    Simpan MK
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
function openAddMatkulModal() {
    document.getElementById('addMatkulModal').classList.remove('hidden');
    document.getElementById('addMatkulModal').classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeAddMatkulModal() {
    document.getElementById('addMatkulModal').classList.add('hidden');
    document.getElementById('addMatkulModal').classList.remove('flex');
    document.body.style.overflow = 'auto';
}
</script>
@endpush
