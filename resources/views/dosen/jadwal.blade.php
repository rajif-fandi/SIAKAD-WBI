@extends('layouts.app')

@section('content')

<div class="">
    {{-- Header Section --}}
    <div class="relative mb-8 overflow-hidden rounded-[2rem] bg-gradient-to-br from-[#2E7D55] via-[#1F653F] to-[#124429] p-10 text-white shadow-2xl">
        <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-white opacity-5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-emerald-400 opacity-10 rounded-full blur-2xl"></div>
        
        <div class="relative flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex flex-wrap items-center gap-2 mb-4">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-[10px] font-black uppercase tracking-[0.2em]">
                        <span class="relative flex h-2 w-2">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                        </span>
                        Akademik Portal
                    </div>
                    <div class="inline-flex items-center px-3 py-1 rounded-full {{ $activeSemester->semester == 'ganjil' ? 'bg-orange-500/20 text-orange-200 border-orange-500/30' : 'bg-blue-500/20 text-blue-200 border-blue-500/30' }} backdrop-blur-md border text-[10px] font-black uppercase tracking-[0.2em]">
                        Semester {{ $activeSemester->semester }}
                    </div>
                </div>
                <h2 class="text-4xl font-black mb-2 tracking-tight">Jadwal Mengajar</h2>
                <div class="flex flex-wrap items-center gap-2 text-emerald-100/80 text-sm font-medium">
                    <p>Dashboard pengelolaan jadwal kuliah - {{ $activeSemester->nama_semester ?? '-' }}</p>
                    <span class="hidden md:block w-1.5 h-1.5 bg-white/30 rounded-full"></span>
                    <div class="flex items-center gap-1">
                        @foreach($daftarMatkul as $dm)
                            <span class="px-2 py-0.5 bg-white/10 rounded text-[9px] font-bold uppercase">{{ $dm->nama_mk }}</span>
                        @endforeach
                    </div>
                </div>
            <div class="flex flex-wrap justify-center gap-3">
                <a href="{{ route('dosen.jadwal.pdf') }}" class="group bg-white/10 hover:bg-white hover:text-emerald-900 backdrop-blur-md px-6 py-3 rounded-2xl text-xs font-black uppercase tracking-widest transition-all duration-300 flex items-center gap-2 border border-white/10 shadow-lg">
                    <svg class="w-4 h-4 transition-transform group-hover:-translate-y-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Export PDF
                </a>
                <button onclick="toggleCalendar()" class="group bg-emerald-500 hover:bg-emerald-400 text-white px-6 py-3 rounded-2xl text-xs font-black uppercase tracking-widest transition-all duration-300 flex items-center gap-2 shadow-xl shadow-emerald-950/20 border border-emerald-400/30">
                    <svg class="w-4 h-4 transition-transform group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Weekly View
                </button>
            </div>
        </div>
    </div>

    {{-- Quick Stats --}}
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
        @php
            $stats = [
                ['label' => 'Mata Kuliah', 'value' => $totalMatkul, 'icon' => 'M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z', 'color' => 'blue'],
                ['label' => 'Total Mahasiswa', 'value' => $totalMahasiswa, 'icon' => 'M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z', 'color' => 'emerald'],
                ['label' => 'Total SKS', 'value' => $totalSks, 'icon' => 'M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z', 'color' => 'indigo'],
                ['label' => 'Pertemuan/Minggu', 'value' => $totalPertemuan, 'icon' => 'M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z', 'color' => 'orange'],
                ['label' => 'Ruang Kelas', 'value' => $totalRuangan, 'icon' => 'M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z', 'color' => 'rose'],
            ];
        @endphp

        @foreach($stats as $stat)
        <div class="group bg-white p-6 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl hover:shadow-{{ $stat['color'] }}-100 transition-all duration-300 hover:-translate-y-1">
            <div class="flex flex-col gap-4">
                <div class="w-12 h-12 bg-{{ $stat['color'] }}-50 rounded-2xl flex items-center justify-center transition-transform group-hover:scale-110 group-hover:rotate-3">
                    <svg class="w-6 h-6 text-{{ $stat['color'] }}-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="{{ $stat['icon'] }}"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] text-gray-400 font-black uppercase tracking-[0.15em] mb-1">{{ $stat['label'] }}</p>
                    <p class="text-3xl font-black text-gray-900 tracking-tighter">{{ $stat['value'] }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Filter & Search --}}
    <div class="bg-white p-5 rounded-[2rem] shadow-sm border border-gray-100 mb-8 backdrop-blur-xl bg-white/80">
        <div class="flex flex-col lg:flex-row items-center gap-5">
            <div class="flex-1 w-full lg:w-auto">
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400 transition-colors group-focus-within:text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" id="instantSearch" placeholder="Cari mata kuliah, kode, atau ruangan..." class="w-full pl-12 pr-4 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-emerald-500 font-bold text-gray-700 transition-all placeholder:text-gray-400 placeholder:font-medium">
                </div>
            </div>
            <div class="flex items-center gap-3 w-full lg:w-auto">
                <select id="dayFilter" class="px-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-emerald-500 font-bold text-gray-700 transition-all cursor-pointer min-w-[160px]">
                    <option value="">Semua Hari</option>
                    <option value="Mon">Senin</option>
                    <option value="Tue">Selasa</option>
                    <option value="Wed">Rabu</option>
                    <option value="Thu">Kamis</option>
                    <option value="Fri">Jumat</option>
                    <option value="Sat">Sabtu</option>
                </select>
                <div id="loader" class="hidden">
                    <svg class="animate-spin h-5 w-5 text-emerald-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Schedule Table --}}
    <div class="bg-white rounded-[2.5rem] shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden group/table">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50/80 border-b border-gray-100 italic1">
                        <th class="px-6 py-6 text-left text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Hari</th>
                        <th class="px-6 py-6 text-left text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Waktu</th>
                        <th class="px-6 py-6 text-left text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Mata Kuliah</th>
                        <th class="px-6 py-6 text-left text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Kelas</th>
                        <th class="px-6 py-6 text-center text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">SKS</th>
                        <th class="px-6 py-6 text-left text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Ruangan</th>
                        <th class="px-6 py-6 text-center text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Populasi</th>
                        <th class="px-6 py-6 text-center text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Aksi Cepat</th>
                    </tr>
                </thead>
                <tbody id="jadwalTableBody" class="divide-y divide-gray-50 italic1">
                    @include('dosen.partials.jadwal_table', ['jadwals' => $jadwals])
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Calendar Overlay --}}
<div id="calendarModal" class="fixed inset-0 z-[60] hidden overflow-y-auto px-4 py-10 sm:px-0">
    <div class="fixed inset-0 bg-emerald-950/60 backdrop-blur-xl transition-opacity" onclick="toggleCalendar()"></div>
    <div class="relative mx-auto max-w-7xl rounded-[3rem] bg-white shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-300">
        <div class="flex items-center justify-between p-8 border-b border-gray-100">
            <div>
                <h3 class="text-2xl font-black text-gray-900 tracking-tight">Weekly Production Schedule</h3>
                <p class="text-gray-500 text-sm font-medium">Visualisasi beban mengajar per minggu</p>
            </div>
            <button onclick="toggleCalendar()" class="p-3 bg-gray-50 hover:bg-gray-100 rounded-2xl transition-colors">
                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="p-8">
            <div class="grid grid-cols-7 gap-4 min-w-[1000px]">
                @foreach(['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $day)
                @php
                    $dayJadwals = $jadwals->where('hari', $day);
                    $dayName = ['Mon' => 'Senin', 'Tue' => 'Selasa', 'Wed' => 'Rabu', 'Thu' => 'Kamis', 'Fri' => 'Jumat', 'Sat' => 'Sabtu', 'Sun' => 'Minggu'][$day];
                @endphp
                <div class="space-y-4">
                    <div class="bg-gray-50 rounded-2xl p-4 text-center">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">{{ $day }}</p>
                        <p class="text-sm font-black text-gray-800">{{ $dayName }}</p>
                    </div>
                    <div class="space-y-3">
                        @forelse($dayJadwals as $j)
                        <div class="p-4 rounded-[1.5rem] bg-emerald-50 border border-emerald-100 group cursor-default hover:bg-emerald-600 transition-all duration-300">
                            <p class="text-[10px] font-black text-emerald-600 uppercase tracking-tight group-hover:text-emerald-100 transition-colors mb-1">{{ substr($j->jam_mulai, 0, 5) }}</p>
                            <p class="text-xs font-black text-gray-800 leading-tight group-hover:text-white transition-colors">{{ $j->kelas->matakuliah->nama_mk }}</p>
                            <div class="flex items-center gap-1 mt-2">
                                <span class="text-[9px] font-bold text-emerald-700 bg-white/50 px-1.5 py-0.5 rounded uppercase group-hover:bg-emerald-500 group-hover:text-white transition-all">{{ $j->kelas->kode_kelas }}</span>
                                <span class="text-[9px] font-bold text-gray-400 group-hover:text-emerald-200 transition-colors">{{ $j->ruangan }}</span>
                            </div>
                        </div>
                        @empty
                        <div class="p-8 rounded-[1.5rem] border-2 border-dashed border-gray-50 flex flex-col items-center justify-center grayscale opacity-30">
                            <div class="w-1 h-1 rounded-full bg-gray-200"></div>
                        </div>
                        @endforelse
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
    const searchInput = document.getElementById('instantSearch');
    const dayFilter = document.getElementById('dayFilter');
    const tableBody = document.getElementById('jadwalTableBody');
    const loader = document.getElementById('loader');
    const calendarModal = document.getElementById('calendarModal');

    let searchTimeout;

    function handleFilter() {
        loader.classList.remove('hidden');
        const search = searchInput.value;
        const day = dayFilter.value;

        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            fetch(`{{ route('dosen.jadwal') }}?search=${search}&hari=${day}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                tableBody.innerHTML = html;
                loader.classList.add('hidden');
            })
            .catch(error => {
                console.error('Error fetching filtered data:', error);
                loader.classList.add('hidden');
            });
        }, 300);
    }

    searchInput.addEventListener('input', handleFilter);
    dayFilter.addEventListener('change', handleFilter);

    function toggleCalendar() {
        calendarModal.classList.toggle('hidden');
        if (!calendarModal.classList.contains('hidden')) {
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = '';
        }
    }
</script>

@endsection