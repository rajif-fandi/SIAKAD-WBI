@extends('layouts.app')

@section('content')

{{-- Header Section --}}
<div class="bg-gradient-to-br from-[#1F653F] to-[#2F8054] rounded-3xl p-8 mb-8 shadow-2xl relative overflow-hidden text-white">
    <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h2 class="text-3xl font-black mb-2">Manajemen Ruangan Fisik</h2>
            <p class="text-emerald-100 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                Kelola data ruangan, gedung, dan kapasitas tempat duduk
            </p>
        </div>
        <button onclick="openAddModal()" class="px-8 py-4 bg-white text-[#1F653F] rounded-2xl font-black shadow-xl hover:shadow-2xl hover:scale-105 active:scale-95 transition-all flex items-center gap-3">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" /></svg>
            Tambah Ruangan
        </button>
    </div>
    <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32 blur-3xl"></div>
</div>

{{-- Search Section --}}
<div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-6 mb-8">
    <form action="{{ route('akademik.ruangan.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-center">
        <div class="flex-1 w-full relative group">
            <div class="absolute left-5 top-1/2 transform -translate-y-1/2 text-gray-400 group-focus-within:text-[#1F653F] transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
            </div>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau kode ruangan..." class="w-full pl-14 pr-6 py-4 border-2 border-gray-100 rounded-2xl focus:border-[#1F653F] focus:ring-4 focus:ring-[#1F653F]/10 outline-none transition-all font-medium">
        </div>
        <button type="submit" class="w-full md:w-auto px-10 py-4 bg-gray-900 text-white rounded-2xl font-bold hover:bg-gray-800 transition-all shadow-lg active:scale-95">
            Cari Data
        </button>
    </form>
</div>

{{-- Data Table --}}
<div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50/50 border-b border-gray-100">
                    <th class="px-8 py-6 text-xs font-black text-gray-400 uppercase tracking-widest">No</th>
                    <th class="px-8 py-6 text-xs font-black text-gray-400 uppercase tracking-widest">Kode</th>
                    <th class="px-8 py-6 text-xs font-black text-gray-400 uppercase tracking-widest">Nama Ruangan</th>
                    <th class="px-8 py-6 text-xs font-black text-gray-400 uppercase tracking-widest text-center">Kapasitas</th>
                    <th class="px-8 py-6 text-xs font-black text-gray-400 uppercase tracking-widest">Lokasi</th>
                    <th class="px-8 py-6 text-xs font-black text-gray-400 uppercase tracking-widest">Status</th>
                    <th class="px-8 py-6 text-xs font-black text-gray-400 uppercase tracking-widest text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($ruangans as $r)
                <tr class="group hover:bg-emerald-50/30 transition-all">
                    <td class="px-8 py-6">
                        <span class="text-sm font-bold text-gray-400 tracking-tighter">{{ $loop->iteration + ($ruangans->currentPage() - 1) * $ruangans->perPage() }}</span>
                    </td>
                    <td class="px-8 py-6 font-mono font-black text-sm text-[#1F653F]">
                        {{ $r->kode_ruangan }}
                    </td>
                    <td class="px-8 py-6">
                        <p class="font-black text-gray-900">{{ $r->nama_ruangan }}</p>
                    </td>
                    <td class="px-8 py-6 text-center">
                        <div class="inline-flex items-center gap-2 px-3 py-1 bg-blue-50 border border-blue-100 rounded-lg text-blue-600 font-black">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" /></svg>
                            {{ $r->kapasitas }} Kursi
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <p class="text-sm font-bold text-gray-600">{{ $r->lokasi ?? '-' }}</p>
                    </td>
                    <td class="px-8 py-6">
                        @if($r->status === 'Tersedia')
                            <span class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-[10px] font-black tracking-widest uppercase border border-emerald-200">Tersedia</span>
                        @elseif($r->status === 'Perbaikan')
                            <span class="px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-[10px] font-black tracking-widest uppercase border border-amber-200">Perbaikan</span>
                        @else
                            <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-[10px] font-black tracking-widest uppercase border border-red-200">Non-Aktif</span>
                        @endif
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex items-center justify-end gap-3">
                            <button onclick='openEditModal(@json($r))' class="p-2.5 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                            </button>
                            <form action="{{ route('akademik.ruangan.delete', $r->ruangan_id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ruangan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2.5 bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition-all shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-8 py-20 text-center">
                        <div class="flex flex-col items-center gap-4 text-gray-400">
                            <svg class="w-20 h-20 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                            <p class="font-black">Belum ada data Ruangan</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    {{-- Pagination --}}
    <div class="px-8 py-6 bg-gray-50 border-t border-gray-100">
        {{ $ruangans->links() }}
    </div>
</div>

{{-- CRUD Modals --}}
<div id="ruanganModal" class="fixed inset-0 z-[60] hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" onclick="closeModal()"></div>
    <div class="relative bg-white w-full max-w-xl rounded-[2.5rem] shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-300">
        <div class="bg-gradient-to-r from-[#1F653F] to-[#2F8054] p-8 text-white flex justify-between items-center">
            <div>
                <h3 id="modalTitle" class="text-2xl font-black">Tambah Ruangan</h3>
                <p id="modalSubtitle" class="text-emerald-100 text-sm mt-1">Lengkapi data ruangan fisik di bawah ini</p>
            </div>
            <button onclick="closeModal()" class="p-2 hover:bg-white/20 rounded-xl transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>

        <form id="ruanganForm" method="POST" action="{{ route('akademik.ruangan.store') }}" class="p-8 space-y-6">
            @csrf
            <div id="methodField"></div>
            
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-black text-gray-700 mb-2">Kode Ruangan <span class="text-red-500">*</span></label>
                    <input type="text" name="kode" required placeholder="E.g., LAB01, 3.2" class="w-full border-2 border-gray-100 rounded-2xl px-5 py-4 text-sm focus:border-[#1F653F] focus:ring-4 focus:ring-[#1F653F]/10 outline-none transition-all font-bold">
                </div>
                <div>
                    <label class="block text-sm font-black text-gray-700 mb-2">Kapasitas Kursi <span class="text-red-500">*</span></label>
                    <input type="number" name="kapasitas" required min="1" placeholder="E.g., 40" class="w-full border-2 border-gray-100 rounded-2xl px-5 py-4 text-sm focus:border-[#1F653F] focus:ring-4 focus:ring-[#1F653F]/10 outline-none transition-all font-bold">
                </div>
            </div>

            <div>
                <label class="block text-sm font-black text-gray-700 mb-2">Nama Ruangan <span class="text-red-500">*</span></label>
                <input type="text" name="nama" required placeholder="E.g., Lab Komputer 1" class="w-full border-2 border-gray-100 rounded-2xl px-5 py-4 text-sm focus:border-[#1F653F] focus:ring-4 focus:ring-[#1F653F]/10 outline-none transition-all font-bold">
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-black text-gray-700 mb-2">Gedung / Lokasi</label>
                    <input type="text" name="lokasi" placeholder="E.g., Gd. Utama Lt. 3" class="w-full border-2 border-gray-100 rounded-2xl px-5 py-4 text-sm focus:border-[#1F653F] focus:ring-4 focus:ring-[#1F653F]/10 outline-none transition-all font-bold">
                </div>
                <div>
                    <label class="block text-sm font-black text-gray-700 mb-2">Status <span class="text-red-500">*</span></label>
                    <select name="status" required class="w-full border-2 border-gray-100 rounded-2xl px-5 py-4 text-sm focus:border-[#1F653F] focus:ring-4 focus:ring-[#1F653F]/10 outline-none transition-all font-bold bg-white">
                        <option value="Tersedia">Tersedia</option>
                        <option value="Perbaikan">Perbaikan</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                    </select>
                </div>
            </div>

            <div class="flex gap-4 pt-4">
                <button type="button" onclick="closeModal()" class="flex-1 px-8 py-4 border-2 border-gray-200 rounded-2xl font-black text-gray-500 hover:bg-gray-50 transition-all">
                    Batal
                </button>
                <button type="submit" class="flex-1 px-8 py-4 bg-gradient-to-r from-[#1F653F] to-[#2F8054] text-white rounded-2xl font-black shadow-lg hover:shadow-xl transition-all active:scale-95">
                    Simpan Ruangan
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
function openAddModal() {
    document.getElementById('modalTitle').textContent = 'Tambah Ruangan';
    const form = document.getElementById('ruanganForm');
    form.reset();
    form.action = "{{ route('akademik.ruangan.store') }}";
    document.getElementById('methodField').innerHTML = '';
    
    document.getElementById('ruanganModal').classList.remove('hidden');
    document.getElementById('ruanganModal').classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function openEditModal(r) {
    document.getElementById('modalTitle').textContent = 'Edit Ruangan';
    const form = document.getElementById('ruanganForm');
    form.reset();
    form.action = `/akademik/ruangan/${r.ruangan_id}`;
    document.getElementById('methodField').innerHTML = '<input type="hidden" name="_method" value="PUT">';
    
    form.kode.value = r.kode_ruangan;
    form.nama.value = r.nama_ruangan;
    form.kapasitas.value = r.kapasitas;
    form.lokasi.value = r.lokasi;
    form.status.value = r.status;

    document.getElementById('ruanganModal').classList.remove('hidden');
    document.getElementById('ruanganModal').classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('ruanganModal').classList.add('hidden');
    document.getElementById('ruanganModal').classList.remove('flex');
    document.body.style.overflow = 'auto';
}

@if(session('success'))
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: '{{ session('success') }}',
    showConfirmButton: false,
    timer: 3000
});
@endif
</script>
@endpush
