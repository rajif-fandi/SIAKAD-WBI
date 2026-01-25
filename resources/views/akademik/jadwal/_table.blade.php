@forelse($jadwal as $j)
<tr class="hover:bg-gradient-to-r hover:from-emerald-50/50 hover:to-transparent transition-all group border-b border-gray-100">
    {{-- Hari & Jam --}}
    <td class="px-6 py-5">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-emerald-100 text-emerald-700 rounded-xl flex items-center justify-center font-bold text-xs group-hover:scale-110 transition-transform">
                {{ substr($j->hari, 0, 3) }}
            </div>
            <div>
                <p class="text-sm font-bold text-gray-900 capitalize">{{ $j->hari }}</p>
                <p class="text-xs text-gray-500 font-medium">{{ substr($j->jam_mulai, 0, 5) }} - {{ substr($j->jam_selesai, 0, 5) }}</p>
            </div>
        </div>
    </td>
    {{-- Mata Kuliah --}}
    <td class="px-6 py-5">
        <div>
            <p class="text-sm font-black text-gray-900 mb-0.5">{{ $j->kelas->matakuliah->nama_mk ?? '-' }}</p>
            <div class="flex items-center gap-2">
                <span class="text-[10px] font-bold font-mono text-gray-500 bg-gray-100 px-2 py-0.5 rounded-md border border-gray-200">
                    {{ $j->kelas->matakuliah->kode_mk ?? '-' }}
                </span>
                <span class="text-[10px] font-bold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-md border border-blue-100">
                    Kelas {{ $j->kelas->kode_kelas ?? '-' }}
                </span>
            </div>
        </div>
    </td>
    {{-- Dosen --}}
    <td class="px-6 py-5">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-[#1F653F] to-[#2F8054] flex items-center justify-center text-white text-[10px] font-bold shadow-sm">
                {{ strtoupper(substr($j->kelas->dosen->dosen->nama ?? 'D', 0, 1)) }}
            </div>
            <p class="text-xs font-bold text-gray-700">{{ $j->kelas->dosen->dosen->nama ?? '-' }}</p>
        </div>
    </td>
    {{-- Ruangan --}}
    <td class="px-6 py-5">
        <div class="flex flex-col gap-1">
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gradient-to-r from-purple-500 to-indigo-600 text-white rounded-lg text-xs font-bold shadow-md w-fit">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                {{ $j->ruangan->nama_ruangan ?? 'N/A' }}
            </span>
            @php
                $occ = $j->kelas->krs_details_count ?? 0;
                $cap = $j->ruangan->kapasitas ?? 1;
                $perc = round(($occ / $cap) * 100);
            @endphp
            <div class="flex items-center gap-2">
                <div class="flex-1 h-1.5 bg-gray-100 rounded-full overflow-hidden w-20">
                    <div class="h-full {{ $perc > 90 ? 'bg-red-500' : 'bg-emerald-500' }}" style="width: {{ min(100, $perc) }}%"></div>
                </div>
                <span class="text-[10px] font-black text-gray-500">{{ $occ }}/{{ $cap }}</span>
            </div>
        </div>
    </td>
    {{-- Status --}}
    <td class="px-6 py-5 text-center">
        <span class="inline-flex items-center gap-1 px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-[10px] font-black uppercase tracking-wider border border-emerald-200">
            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
            On Schedule
        </span>
    </td>
    {{-- Aksi --}}
    <td class="px-6 py-5">
        <div class="flex items-center justify-end gap-2">
            <button onclick='editJadwal(@json($j))' class="p-2 bg-emerald-50 hover:bg-gradient-to-br hover:from-[#1F653F] hover:to-[#2F8054] text-emerald-600 hover:text-white rounded-xl transition-all shadow-sm hover:shadow-md" title="Edit">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
            </button>
            <form action="{{ route('akademik.jadwal.delete', $j->jadwal_id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="p-2 bg-red-50 hover:bg-gradient-to-br hover:from-red-500 hover:to-red-600 text-red-600 hover:text-white rounded-xl transition-all shadow-sm hover:shadow-md" title="Hapus">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            </form>
        </div>
    </td>
</tr>
@empty
<tr>
    <td colspan="8" class="px-8 py-20 text-center">
        <div class="flex flex-col items-center gap-4 text-gray-400">
            <svg class="w-20 h-20 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <p class="font-black">Belum ada jadwal yang sesuai dengan filter</p>
        </div>
    </td>
</tr>
@endforelse
