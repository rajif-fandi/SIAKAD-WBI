@extends('layouts.app')

@section('content')

<div class="relative bg-gradient-to-br from-[#1F653F] via-[#2F8054] to-[#47AF76] text-white p-8 rounded-3xl mb-8 shadow-2xl overflow-hidden">
    <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full -ml-24 -mb-24 blur-2xl"></div>
    
    <div class="relative z-10 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-black uppercase tracking-tight mb-2">Daftar Dosen</h1>
            <p class="text-emerald-100 font-medium">Informasi pengampu akademik</p>
        </div>
        <div class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center border border-white/30 shadow-xl">
             <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
        </div>
    </div>
</div>

<div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50/50 border-b border-gray-100">
                    <th class="px-6 py-5 text-left text-xs font-black text-gray-400 uppercase tracking-[0.2em]">Dosen</th>
                    <th class="px-6 py-5 text-left text-xs font-black text-gray-400 uppercase tracking-[0.2em]">NIDN / NIP</th>
                    <th class="px-6 py-5 text-left text-xs font-black text-gray-400 uppercase tracking-[0.2em]">Program Studi</th>
                    <th class="px-6 py-5 text-left text-xs font-black text-gray-400 uppercase tracking-[0.2em]">Status</th>
                    <th class="px-6 py-5 text-left text-xs font-black text-gray-400 uppercase tracking-[0.2em]">Jabatan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($dosens as $d)
                <tr class="hover:bg-gray-50/50 transition-all group">
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#1F653F] to-[#2F8054] flex items-center justify-center text-white font-black text-sm shadow-md group-hover:scale-110 transition-transform">
                                {{ strtoupper(substr($d->nama, 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-sm font-black text-gray-900 leading-tight group-hover:text-[#1F653F] transition-colors">{{ $d->nama }}</p>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-0.5">{{ $d->status_kepegawaian }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-5">
                        <span class="text-xs font-black text-gray-700 font-mono tracking-wider bg-gray-100 px-3 py-1.5 rounded-lg border border-gray-200">{{ $d->nip }}</span>
                    </td>
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-2">
                             <div class="w-1.5 h-1.5 rounded-full bg-[#1F653F]"></div>
                             <span class="text-sm font-bold text-gray-700">{{ $d->prodi->nama_prodi ?? '-' }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-5">
                        <span class="inline-flex items-center px-3 py-1 bg-green-50 text-[#1F653F] text-[10px] font-black uppercase tracking-widest rounded-full border border-green-100">
                             {{ $d->status_dosen ?? 'Aktif' }}
                        </span>
                    </td>
                    <td class="px-6 py-5">
                        <span class="text-sm font-bold text-gray-600">{{ $d->jabatan ?? '-' }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
