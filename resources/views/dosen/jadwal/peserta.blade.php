@extends('layouts.app')

@section('content')
<div class="">
    {{-- Header Section --}}
    <div class="relative mb-8 overflow-hidden rounded-[2rem] bg-gradient-to-br from-[#4f46e5] via-[#4338ca] to-[#3730a3] p-10 text-white shadow-2xl">
        <div class="relative flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-[10px] font-black uppercase tracking-[0.2em] mb-4">
                    Rekap Peserta & Detail Kelas
                </div>
                <h2 class="text-4xl font-black mb-1 tracking-tight uppercase">{{ $jadwal->kelas->matakuliah->nama_mk }}</h2>
                <div class="flex items-center gap-4 text-indigo-100/80 text-sm font-medium">
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        Ruang {{ $jadwal->ruangan }}
                    </span>
                    <span class="w-1 h-1 bg-white/30 rounded-full"></span>
                    <span class="flex items-center gap-1.5 uppercase">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ $jadwal->hari }}, {{ substr($jadwal->jam_mulai, 0, 5) }} - {{ substr($jadwal->jam_selesai, 0, 5) }}
                    </span>
                    <span class="w-1 h-1 bg-white/30 rounded-full"></span>
                    <span class="px-2 py-0.5 bg-white/20 rounded-md text-[10px] font-black tracking-widest">{{ $jadwal->kelas->kode_kelas }}</span>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('dosen.penilaian.kelas', $jadwal->kelas_id) }}" class="group bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-3 rounded-2xl text-xs font-black uppercase tracking-widest transition-all duration-300 flex items-center justify-center gap-2 shadow-lg shadow-emerald-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                    Buka Portal Nilai
                </a>
                <a href="{{ route('dosen.pertemuan.index', ['jadwal_id' => $jadwal->jadwal_id]) }}" class="group bg-white/10 hover:bg-white hover:text-indigo-900 backdrop-blur-md px-6 py-3 rounded-2xl text-xs font-black uppercase tracking-widest transition-all duration-300 flex items-center justify-center gap-2 border border-white/10 shadow-lg">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.168 0.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332 0.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332 0.477-4.5 1.253"></path>
                    </svg>
                    Riwayat BAP
                </a>
                <a href="{{ route('dosen.jadwal') }}" class="group bg-white/10 hover:bg-white hover:text-indigo-900 backdrop-blur-md px-6 py-3 rounded-2xl text-xs font-black uppercase tracking-widest transition-all duration-300 flex items-center justify-center gap-2 border border-white/10 shadow-lg">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-8 rounded-[2rem] shadow-xl border border-gray-100 flex items-center gap-6">
            <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 shadow-inner">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </div>
            <div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Total Peserta</p>
                <div class="flex items-baseline gap-2">
                    <h4 class="text-3xl font-black text-gray-900">{{ $jadwal->getEnrolledStudentsCount() ?? $jadwal->kelas->krsDetails->count() }}</h4>
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-tighter">Mahasiswa</span>
                </div>
            </div>
        </div>
        
        <div class="bg-white p-8 rounded-[2rem] shadow-xl border border-gray-100 flex items-center gap-6">
            <div class="w-16 h-16 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 shadow-inner">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
            </div>
            <div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Pertemuan Berlangsung</p>
                <div class="flex items-baseline gap-2">
                    <h4 class="text-3xl font-black text-gray-900">{{ $jadwal->pertemuans->count() }}</h4>
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-tighter">Sesi (BAP)</span>
                </div>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[2rem] shadow-xl border border-gray-100 flex items-center gap-6">
            <div class="w-16 h-16 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 shadow-inner">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Status Kelas</p>
                <h4 class="text-xl font-black text-emerald-600 uppercase tracking-tight">Aktif Perkuliahan</h4>
            </div>
        </div>
    </div>

    {{-- Students Table --}}
    <div class="bg-white rounded-[2.5rem] shadow-2xl border border-gray-100 overflow-hidden mb-12">
        <div class="px-10 py-8 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between">
            <div>
                <h3 class="text-xl font-black text-gray-800 uppercase tracking-tight">Daftar Mahaswiswa Terdaftar</h3>
                <p class="text-xs text-gray-400 font-medium">Berdasarkan data KRS Mahasiswa yang telah divalidasi</p>
            </div>
            <div class="flex gap-2">
                <button class="px-4 py-2 bg-white border border-gray-200 rounded-xl text-[10px] font-black uppercase tracking-widest text-gray-500 hover:bg-gray-50 transition shadow-sm">
                    Print Absensi
                </button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-10 py-6 text-left text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">#</th>
                        <th class="px-6 py-6 text-left text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Mahasiswa</th>
                        <th class="px-6 py-6 text-left text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">NPM / NIM</th>
                        <th class="px-6 py-6 text-center text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Total Kehadiran</th>
                        <th class="px-10 py-6 text-center text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Status KRS</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($jadwal->kelas->krsDetails as $index => $detail)
                    @php
                        $mhs = $detail->krs->mahasiswa;
                        $totalPertemuan = $jadwal->pertemuans->count();
                        $totalHadir = \App\Models\Presensi::where('mahasiswa_id', $mhs->mahasiswa_id)
                                        ->whereIn('pertemuan_id', $jadwal->pertemuans->pluck('pertemuan_id'))
                                        ->where('status', 'hadir')
                                        ->count();
                        $presentase = $totalPertemuan > 0 ? ($totalHadir / $totalPertemuan) * 100 : 0;
                    @endphp
                    <tr class="hover:bg-gray-50/80 transition group">
                        <td class="px-10 py-5 whitespace-nowrap text-sm font-black text-gray-300 group-hover:text-indigo-600 transition-colors">
                            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-600 font-bold text-xs shadow-inner">
                                    {{ substr($mhs->nama, 0, 1) }}
                                </div>
                                <span class="font-black text-gray-800 text-sm tracking-tight">{{ $mhs->nama }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap">
                            <span class="text-xs font-mono text-gray-500 bg-gray-100 px-2 py-1 rounded-md">{{ $mhs->npm }}</span>
                        </td>
                        <td class="px-6 py-5 text-center">
                            <div class="flex flex-col items-center">
                                <span class="text-sm font-black text-gray-900">{{ $totalHadir }} / {{ $totalPertemuan }}</span>
                                <div class="w-24 h-1.5 bg-gray-100 rounded-full mt-1.5 overflow-hidden">
                                    <div class="h-full bg-indigo-500 rounded-full" style="width: {{ $presentase }}%"></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-10 py-5 text-center">
                            @if($detail->status === 'terverifikasi')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest bg-emerald-50 text-emerald-700 border border-emerald-100 shadow-sm">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    Bergabung
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest bg-gray-50 text-gray-500 border border-gray-100 shadow-sm italic">
                                    Belum Bergabung
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-10 py-20 text-center">
                            <div class="flex flex-col items-center opacity-40">
                                <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                <p class="text-lg font-black uppercase text-gray-400 tracking-widest">Belum Ada Mahasiswa Terdaftar</p>
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
