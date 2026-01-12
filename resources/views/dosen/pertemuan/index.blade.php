@extends('layouts.app')

@section('content')
<div class="">
    <div class="relative mb-8 overflow-hidden rounded-[2rem] bg-gradient-to-br from-[#1e3a8a] via-[#1e40af] to-[#1d4ed8] p-10 text-white shadow-2xl">
        <div class="relative flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
                <h2 class="text-4xl font-black mb-2 tracking-tight">Riwayat Pertemuan</h2>
                <p class="text-blue-100/80 text-sm font-medium">Pantau dan kelola kehadiran mahasiswa setiap pertemuan</p>
            </div>
            <a href="{{ route('dosen.jadwal') }}" class="group bg-white/10 hover:bg-white hover:text-blue-900 backdrop-blur-md px-6 py-3 rounded-2xl text-xs font-black uppercase tracking-widest transition-all duration-300 flex items-center gap-2 border border-white/10 shadow-lg">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Jadwal
            </a>
        </div>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-xl border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="px-6 py-6 text-left text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Pertemuan Ke</th>
                        <th class="px-6 py-6 text-left text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Tanggal</th>
                        <th class="px-6 py-6 text-left text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Mata Kuliah</th>
                        <th class="px-6 py-6 text-center text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Presensi</th>
                        <th class="px-6 py-6 text-center text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 italic1">
                    @forelse($pertemuans as $pertemuan)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold bg-blue-50 text-blue-700 border border-blue-100 uppercase">
                                Pertemuan {{ $pertemuan->pertemuan_ke }}
                            </span>
                        </td>
                        <td class="px-6 py-4 font-bold text-gray-700">
                            {{ \Carbon\Carbon::parse($pertemuan->tanggal)->translatedFormat('d F Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="max-w-md">
                                <p class="font-black text-gray-800 text-sm leading-tight uppercase">{{ $pertemuan->jadwal->kelas->matakuliah->nama_mk }}</p>
                                <p class="text-[10px] text-gray-400 font-mono mb-2">{{ $pertemuan->jadwal->kelas->kode_kelas }}</p>
                                @if($pertemuan->materi_pembahasan)
                                    <div class="flex items-start gap-2 bg-gray-50 p-3 rounded-xl border border-gray-100">
                                        <svg class="w-3.5 h-3.5 text-emerald-500 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                                        </svg>
                                        <p class="text-[11px] text-gray-600 font-medium line-clamp-2 italic leading-relaxed">"{{ $pertemuan->materi_pembahasan }}"</p>
                                    </div>
                                @else
                                    <span class="text-[10px] font-bold text-gray-300 italic">Materi belum diisi</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @php
                                $hadir = $pertemuan->presensis->where('status', 'Hadir')->count();
                                $total = $pertemuan->presensis->count();
                            @endphp
                            <div class="flex flex-col items-center">
                                <span class="text-sm font-black text-gray-900">{{ $hadir }} / {{ $total }}</span>
                                <div class="w-24 h-1.5 bg-gray-100 rounded-full mt-1.5 overflow-hidden">
                                    <div class="h-full bg-emerald-500 rounded-full" style="width: {{ $total > 0 ? ($hadir/$total)*100 : 0 }}%"></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('dosen.pertemuan.presensi', $pertemuan->pertemuan_id) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white rounded-xl font-bold text-xs uppercase transition-all shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Update BAP / Presensi
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-20 text-center">
                            <div class="flex flex-col items-center opacity-40">
                                <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-lg font-black uppercase text-gray-400 tracking-widest">Belum Ada Pertemuan</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
