@extends('layouts.app')

@section('content')

<div class="relative bg-gradient-to-br from-[#1F653F] via-[#2F8054] to-[#47AF76] text-white p-8 rounded-3xl mb-8 shadow-2xl overflow-hidden">
    <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full -ml-24 -mb-24 blur-2xl"></div>
    
    <div class="relative z-10 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-black uppercase tracking-tight mb-2">Daftar Mahasiswa</h1>
            <p class="text-emerald-100 font-medium">Informasi peserta akademik</p>
        </div>
        <div class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center border border-white/30 shadow-xl">
             <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
        </div>
    </div>
</div>

<div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50/50 border-b border-gray-100">
                    <th class="px-6 py-5 text-left text-xs font-black text-gray-400 uppercase tracking-[0.2em]">Mahasiswa</th>
                    <th class="px-6 py-5 text-left text-xs font-black text-gray-400 uppercase tracking-[0.2em]">NPM / NIM</th>
                    <th class="px-6 py-5 text-left text-xs font-black text-gray-400 uppercase tracking-[0.2em]">Program Studi</th>
                    <th class="px-6 py-5 text-left text-xs font-black text-gray-400 uppercase tracking-[0.2em]">Angkatan</th>
                    <th class="px-6 py-5 text-left text-xs font-black text-gray-400 uppercase tracking-[0.2em]">Semester</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($mahasiswas as $m)
                <tr class="hover:bg-gray-50/50 transition-all group">
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-600 to-indigo-700 flex items-center justify-center text-white font-black text-sm shadow-md group-hover:scale-110 transition-transform">
                                {{ strtoupper(substr($m->nama, 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-sm font-black text-gray-900 leading-tight group-hover:text-blue-600 transition-colors">{{ $m->nama }}</p>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-0.5">{{ $m->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-5">
                        <span class="text-xs font-black text-gray-700 font-mono tracking-wider bg-gray-100 px-3 py-1.5 rounded-lg border border-gray-200">{{ $m->npm }}</span>
                    </td>
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-2">
                             <div class="w-1.5 h-1.5 rounded-full bg-blue-600"></div>
                             <span class="text-sm font-bold text-gray-700">{{ $m->prodi->nama_prodi ?? '-' }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-5">
                        <span class="text-sm font-bold text-gray-600">{{ $m->angkatan }}</span>
                    </td>
                    <td class="px-6 py-5">
                        <span class="inline-flex items-center px-3 py-1 bg-amber-50 text-amber-700 text-[10px] font-black uppercase tracking-widest rounded-full border border-amber-100">
                             Semester {{ $m->semester_sekarang }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
