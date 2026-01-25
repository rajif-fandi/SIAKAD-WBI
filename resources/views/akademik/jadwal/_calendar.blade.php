@php
    $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    $groupedJadwal = $jadwal->groupBy('hari');
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6">
    @foreach($days as $day)
    <div class="border-2 border-gray-100 rounded-2xl p-4 bg-gray-50/50 hover:bg-white transition-all hover:shadow-lg">
        <div class="flex items-center justify-between mb-4 pb-2 border-b border-gray-200">
            <h3 class="font-extrabold text-gray-900 text-lg uppercase tracking-wider">{{ $day }}</h3>
            <span class="px-2.5 py-1 bg-[#1F653F] text-white rounded-lg text-xs font-black">
                {{ count($groupedJadwal[$day] ?? []) }}
            </span>
        </div>
        
        <div class="space-y-4">
            @forelse($groupedJadwal[$day] ?? [] as $j)
            <div onclick='editJadwal(@json($j))' class="bg-white border-2 border-transparent hover:border-[#1F653F]/20 p-4 rounded-xl shadow-sm hover:shadow-md transition-all cursor-pointer group relative overflow-hidden">
                <div class="absolute top-0 left-0 w-1 h-full bg-[#1F653F]"></div>
                
                <div class="flex items-center gap-2 mb-2">
                    <span class="text-[10px] font-black text-[#1F653F] bg-[#1F653F]/10 px-2 py-0.5 rounded flex items-center gap-1">
                        <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                        </svg>
                        {{ substr($j->jam_mulai, 0, 5) }}
                    </span>
                    <span class="text-[10px] font-bold text-gray-500">{{ $j->ruangan->nama_ruangan ?? 'N/A' }}</span>
                </div>
                
                <p class="text-sm font-black text-gray-900 group-hover:text-[#1F653F] transition-colors leading-tight mb-1">
                    {{ $j->kelas->matakuliah->nama_mk ?? '-' }}
                </p>
                <div class="flex items-center justify-between mt-2">
                    <span class="text-[10px] font-bold text-blue-600 bg-blue-50 px-2 py-0.5 rounded">
                        {{ $j->kelas->kode_kelas ?? '-' }}
                    </span>
                    <div class="flex items-center gap-1 text-[10px] text-gray-500 font-bold">
                        <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        {{ $j->kelas->krs_details_count }}/{{ $j->ruangan->kapasitas }}
                    </div>
                </div>
            </div>
            @empty
            <div class="py-10 flex flex-col items-center justify-center opacity-30 text-gray-400 border-2 border-dashed border-gray-200 rounded-xl">
                <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-[10px] font-black uppercase tracking-widest text-center">Kosong</p>
            </div>
            @endforelse
        </div>
    </div>
    @endforeach
</div>
