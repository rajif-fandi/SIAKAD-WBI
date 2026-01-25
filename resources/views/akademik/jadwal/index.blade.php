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
            <select id="filter-semester" class="filter-trigger border-2 border-gray-300 rounded-xl px-5 py-3.5 text-sm font-bold focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] bg-white transition-all hover:border-[#2F8054]">
                <option value="">Semua Semester</option>
                @foreach($semesters as $s)
                    <option value="{{ $s->semester_ajaran_id }}" {{ $s->is_active ? 'selected' : '' }}>{{ $s->nama_semester }}</option>
                @endforeach
            </select>

            <select id="filter-prodi" class="filter-trigger border-2 border-gray-300 rounded-xl px-5 py-3.5 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] bg-white transition-all hover:border-[#2F8054]">
                <option value="">Semua Prodi</option>
                @foreach($prodis as $p)
                    <option value="{{ $p->prodi_id }}">{{ $p->nama_prodi }}</option>
                @endforeach
            </select>

            <select id="filter-hari" class="filter-trigger border-2 border-gray-300 rounded-xl px-5 py-3.5 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] bg-white transition-all hover:border-[#2F8054]">
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
                <input type="text" id="search-input" placeholder="Cari jadwal..." class="pl-16 pr-4 py-3.5 border-2 border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1F653F] focus:border-[#1F653F] transition-all text-sm group-hover:border-[#2F8054]">
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
            <p id="stat-total" class="text-4xl font-extrabold text-gray-900">{{ $stats['total'] }}</p>
        </div>
    </div>

    <div class="group bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-blue-200 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-500/10 to-transparent rounded-bl-full"></div>
        <div class="relative z-10">
            <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                <span class="text-white font-extrabold text-lg">SEN</span>
            </div>
            <p class="text-sm text-gray-600 font-semibold mb-2">Senin</p>
            <p id="stat-senin" class="text-4xl font-extrabold text-gray-900">{{ $stats['senin'] }}</p>
        </div>
    </div>

    <div class="group bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-emerald-200 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-emerald-500/10 to-transparent rounded-bl-full"></div>
        <div class="relative z-10">
            <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-green-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                <span class="text-white font-extrabold text-lg">SEL</span>
            </div>
            <p class="text-sm text-gray-600 font-semibold mb-2">Selasa</p>
            <p id="stat-selasa" class="text-4xl font-extrabold text-gray-900">{{ $stats['selasa'] }}</p>
        </div>
    </div>

    <div class="group bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-purple-200 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-purple-500/10 to-transparent rounded-bl-full"></div>
        <div class="relative z-10">
            <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                <span class="text-white font-extrabold text-lg">RAB</span>
            </div>
            <p class="text-sm text-gray-600 font-semibold mb-2">Rabu</p>
            <p id="stat-rabu" class="text-4xl font-extrabold text-gray-900">{{ $stats['rabu'] }}</p>
        </div>
    </div>

    <div class="group bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-red-200 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-red-500/10 to-transparent rounded-bl-full"></div>
        <div class="relative z-10">
            <div class="w-14 h-14 bg-gradient-to-br from-red-500 to-rose-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                <span class="text-white font-extrabold text-lg">KAM</span>
            </div>
            <p class="text-sm text-gray-600 font-semibold mb-2">Kamis</p>
            <p id="stat-kamis" class="text-4xl font-extrabold text-gray-900">{{ $stats['kamis'] }}</p>
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
        <p class="text-sm text-gray-600 font-medium">Menampilkan <strong class="text-gray-900">{{ $jadwal->count() }}</strong> jadwal</p>
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
            <tbody id="jadwal-list-body" class="divide-y divide-gray-100">
                @include('akademik.jadwal._table')
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="bg-gradient-to-r from-gray-50 to-white px-6 py-5 border-t border-gray-200 flex items-center justify-between">
        <div class="text-sm text-gray-600 font-medium">
            Menampilkan <span id="count-current" class="font-bold text-gray-900">{{ $jadwal->count() }}</span> jadwal
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
    @include('akademik.jadwal._calendar')
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
            <form id="jadwalForm" method="POST" action="{{ route('akademik.jadwal.store') }}">
                @csrf
                <div id="methodField"></div>
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-2 flex items-center gap-2">
                            <span class="w-1.5 h-1.5 bg-[#1F653F] rounded-full"></span>
                            Kelas <span class="text-red-500">*</span>
                        </label>
                        <select name="kelas_id" required class="w-full border-2 border-gray-300 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1F653F] bg-white transition-all">
                            <option value="">Pilih Seksi Mata Kuliah</option>
                            @foreach($kelas_list as $k)
                                <option value="{{ $k->kelas_id }}">
                                    {{ $k->kode_kelas }} (Mhs: {{ $k->krs_details_count }}) - {{ $k->matakuliah->nama_mk }}
                                </option>
                            @endforeach
                        </select>
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
                            Ruangan Fisik <span class="text-red-500">*</span>
                        </label>
                        <select name="ruangan_id" required class="w-full border-2 border-gray-300 rounded-xl px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1F653F] bg-white transition-all">
                            <option value="">Pilih Ruangan (Gedung - Nama - Kapasitas)</option>
                            @foreach($ruangans as $r)
                                <option value="{{ $r->ruangan_id }}" {{ $r->status !== 'Tersedia' ? 'disabled' : '' }}>
                                    {{ $r->lokasi }} - {{ $r->nama_ruangan }} (Cap: {{ $r->kapasitas }}) 
                                    {!! $r->status !== 'Tersedia' ? ' - ['.$r->status.']' : '' !!}
                                </option>
                            @endforeach
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
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 3000
        });
    @endif

    @if($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ $errors->first() }}',
            confirmButtonColor: '#1F653F'
        });
    @endif
</script>
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
    const form = document.getElementById('jadwalForm');
    form.reset();
    form.action = "{{ route('akademik.jadwal.store') }}";
    document.getElementById('methodField').innerHTML = '';
}

function editJadwal(j) {
    document.getElementById('jadwalModal').classList.remove('hidden');
    document.getElementById('jadwalModal').classList.add('flex');
    document.body.style.overflow = 'hidden';
    const form = document.getElementById('jadwalForm');
    form.reset();
    form.action = `/akademik/jadwal/${j.jadwal_id}`;
    document.getElementById('methodField').innerHTML = '@method("PUT")';
    
    form.kelas_id.value = j.kelas_id;
    form.hari.value = j.hari;
    form.jam_mulai.value = j.jam_mulai.substring(0,5);
    form.jam_selesai.value = j.jam_selesai.substring(0,5);
    form.ruangan_id.value = j.ruangan_id;
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
    document.getElementById('jadwalForm').submit();
}

function deleteJadwal() {
    if(confirm('Yakin ingin menghapus jadwal ini?')) {
        alert('Jadwal berhasil dihapus!');
    }
}

// Real-time Filtering
let filterTimeout;
document.querySelectorAll('.filter-trigger, #search-input').forEach(el => {
    el.addEventListener('input', () => {
        clearTimeout(filterTimeout);
        filterTimeout = setTimeout(fetchFilteredJadwal, 300);
    });
});

function fetchFilteredJadwal() {
    const params = new URLSearchParams({
        semester_id: document.getElementById('filter-semester').value,
        prodi_id: document.getElementById('filter-prodi').value,
        hari: document.getElementById('filter-hari').value,
        search: document.getElementById('search-input').value
    });

    const listBody = document.getElementById('jadwal-list-body');
    listBody.style.opacity = '0.5';

    fetch("{{ route('akademik.jadwal.index') }}?" + params.toString(), {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(res => {
        listBody.innerHTML = res.html;
        listBody.style.opacity = '1';
        
        // Update Calendar
        const calendarContainer = document.getElementById('view-calendar');
        if(res.calendar) {
            calendarContainer.innerHTML = res.calendar;
        }
        
        // Update Stats
        if(res.stats) {
            document.getElementById('stat-total').innerText = res.stats.total;
            document.getElementById('stat-senin').innerText = res.stats.senin;
            document.getElementById('stat-selasa').innerText = res.stats.selasa;
            document.getElementById('stat-rabu').innerText = res.stats.rabu;
            document.getElementById('stat-kamis').innerText = res.stats.kamis;
        }

        // Update count - count rows that don't have colspan (empty state row has colspan)
        const rowCount = listBody.querySelectorAll('tr:not([colspan])').length;
        // Simple count of all rows if no empty state is present
        const actualCount = listBody.querySelectorAll('tr:not(:first-child:last-child)').length || (listBody.querySelector('td[colspan]') ? 0 : listBody.querySelectorAll('tr').length);
        
        document.getElementById('count-current').innerText = actualCount;
    })
    .catch(err => {
        listBody.style.opacity = '1';
        console.error(err);
    });
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