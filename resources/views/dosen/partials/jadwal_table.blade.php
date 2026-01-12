@forelse($jadwals as $jadwal)
@php
    $dayMap = ['Mon' => 'Senin', 'Tue' => 'Selasa', 'Wed' => 'Rabu', 'Thu' => 'Kamis', 'Fri' => 'Jumat', 'Sat' => 'Sabtu', 'Sun' => 'Minggu'];
    $colors = [
        'Mon' => 'blue',
        'Tue' => 'purple',
        'Wed' => 'emerald',
        'Thu' => 'orange',
        'Fri' => 'rose',
        'Sat' => 'indigo',
        'Sun' => 'slate'
    ];
    $color = $colors[$jadwal->hari] ?? 'gray';
@endphp
<tr class="hover:bg-gray-50 transition border-b border-gray-100 last:border-0">
    <td class="px-6 py-4 whitespace-nowrap">
        <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold bg-{{ $color }}-50 text-{{ $color }}-700 border border-{{ $color }}-100 uppercase tracking-tighter">
            {{ $dayMap[$jadwal->hari] }}
        </span>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex items-center gap-2 text-sm text-gray-700">
            <div class="w-7 h-7 bg-gray-100 rounded flex items-center justify-center">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <span class="font-bold tracking-tight">{{ substr($jadwal->jam_mulai, 0, 5) }} - {{ substr($jadwal->jam_selesai, 0, 5) }}</span>
        </div>
    </td>
    <td class="px-6 py-4">
        <div class="max-w-xs">
            <p class="font-black text-gray-800 text-sm leading-tight uppercase tracking-tight">{{ $jadwal->kelas->matakuliah->nama_mk }}</p>
            <p class="text-[10px] text-gray-400 font-mono mt-0.5">{{ $jadwal->kelas->matakuliah->kode_mk }}</p>
        </div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex items-center gap-2">
            <div class="w-1.5 h-1.5 rounded-full bg-emerald-500"></div>
            <span class="text-sm text-gray-700 font-bold uppercase">{{ $jadwal->kelas->kode_kelas }}</span>
        </div>
    </td>
    <td class="px-6 py-4 text-center whitespace-nowrap">
        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[10px] font-black bg-indigo-50 text-indigo-700 border border-indigo-100 uppercase tracking-widest">
            {{ $jadwal->kelas->matakuliah->sks }} SKS
        </span>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex items-center gap-2 text-sm text-gray-600">
            <div class="p-1.5 bg-gray-50 rounded border border-gray-100">
                <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>
            <span class="font-bold text-gray-700">{{ $jadwal->ruangan }}</span>
        </div>
    </td>
    <td class="px-6 py-4 text-center whitespace-nowrap">
        @php
            $totalCount = $jadwal->kelas->krs_details_count ?? $jadwal->kelas->krsDetails->count();
            $joinedCount = $jadwal->kelas->krsDetails->where('status', 'terverifikasi')->count();
        @endphp
        <div class="flex flex-col items-center">
            <div class="flex items-center justify-center gap-1.5">
                <span class="text-sm font-black text-emerald-600 bg-emerald-50 px-2 py-1 rounded border border-emerald-100 min-w-[32px]">{{ $joinedCount }}</span>
                <span class="text-gray-400 text-xs font-bold">/</span>
                <span class="text-sm font-bold text-gray-500 bg-gray-50 px-2 py-1 rounded border border-gray-100 min-w-[32px]">{{ $totalCount }}</span>
            </div>
            <p class="text-[9px] font-black uppercase tracking-tighter text-gray-400 mt-1">Mahasiswa Joined</p>
        </div>
    </td>
    <td class="px-6 py-4 text-center whitespace-nowrap">
        <div class="flex items-center justify-center gap-2">
            <form action="{{ route('dosen.pertemuan.mulai', $jadwal->jadwal_id) }}" method="POST">
                @csrf
                <button type="submit" class="group p-2 bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white rounded-xl transition-all duration-300 shadow-sm hover:shadow-emerald-200" title="Isi Jurnal Mengajar (BAP)">
                    <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </button>
            </form>
            <a href="{{ route('dosen.jadwal.peserta', $jadwal->jadwal_id) }}" class="group p-2 bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white rounded-xl transition-all duration-300 shadow-sm hover:shadow-blue-200" title="Detail Peserta & Rekap">
                <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </a>
            <a href="{{ route('dosen.penilaian.kelas', $jadwal->kelas_id) }}" class="group p-2 bg-purple-50 text-purple-600 hover:bg-purple-600 hover:text-white rounded-xl transition-all duration-300 shadow-sm hover:shadow-purple-200" title="Input Nilai">
                <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 8l3-3m0 0l-3-3m3 3H9"></path>
                </svg>
            </a>
        </div>
    </td>
</tr>
@empty
<tr>
    <td colspan="8" class="px-6 py-20 text-center">
        <div class="flex flex-col items-center max-w-sm mx-auto">
            <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mb-6 border-2 border-dashed border-gray-200 animate-pulse">
                <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-black text-gray-900 uppercase tracking-tight">Data Tidak Ditemukan</h3>
            <p class="text-gray-500 text-sm mt-2 font-medium">Maaf, kami tidak menemukan jadwal yang sesuai dengan filter atau pencarian Anda.</p>
            <button onclick="window.location.reload()" class="mt-6 inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-2xl font-black text-xs uppercase tracking-widest transition-all hover:shadow-lg hover:shadow-emerald-200 active:scale-95">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                Reset Semua Filter
            </button>
        </div>
    </td>
</tr>
@endforelse
