@extends('layouts.app')

@section('title', 'Detail KRS')

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Detail KRS</h1>
        <p class="text-gray-500">Tahun Ajaran {{ $krs->semesterAjaran->tahun_ajaran }} - Semester {{ ucfirst($krs->semesterAjaran->semester) }}</p>
    </div>
    <a href="{{ route('KRS.index') }}" class="flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-bold transition text-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    {{-- Main Content --}}
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left font-inter">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100">
                            <th class="py-4 px-6 text-[10px] font-bold text-gray-400 uppercase tracking-wider">No</th>
                            <th class="py-4 px-6 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Mata Kuliah</th>
                            <th class="py-4 px-6 text-[10px] font-bold text-gray-400 uppercase tracking-wider text-center">SKS</th>
                            <th class="py-4 px-6 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Kelas</th>
                            <th class="py-4 px-6 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Dosen</th>
                            <th class="py-4 px-6 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @foreach($krs->details as $index => $detail)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-6 font-medium text-gray-500">{{ $index + 1 }}</td>
                            <td class="py-4 px-6">
                                <p class="font-bold text-gray-900">{{ $detail->kelas->matakuliah->nama_mk }}</p>
                                <p class="text-[10px] text-gray-400">{{ $detail->kelas->matakuliah->kode_mk }}</p>
                            </td>
                            <td class="py-4 px-6 font-bold text-gray-700 text-center">{{ $detail->kelas->matakuliah->sks }}</td>
                            <td class="py-4 px-6 font-bold text-gray-900 uppercase">{{ $detail->kelas->kode_kelas }}</td>
                            <td class="py-4 px-6 text-xs text-gray-600">
                                @foreach($detail->kelas->dosenPengampu as $dp)
                                    <div>{{ $dp->dosen->nama }}</div>
                                @endforeach
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2 py-1 rounded-md text-[10px] font-bold uppercase {{ $detail->status === 'diambil' ? 'bg-blue-50 text-blue-600' : 'bg-green-50 text-green-600' }}">
                                    {{ $detail->status }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="bg-gray-50 font-bold">
                            <td colspan="2" class="py-4 px-6 text-right text-gray-600">Total SKS</td>
                            <td class="py-4 px-6 text-center text-[#1b4d36] text-lg">{{ $krs->total_sks }}</td>
                            <td colspan="3"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    {{-- Sidebar Details --}}
    <div class="space-y-6">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <h3 class="text-sm font-bold text-[#1b4d36] uppercase tracking-wider mb-4">Informasi Pengajuan</h3>
            <div class="space-y-4">
                <div>
                    <label class="text-[10px] font-bold text-gray-400 uppercase">Status KRS</label>
                    <div class="mt-1 flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full {{ $krs->status === 'disetujui' ? 'bg-green-500' : 'bg-orange-500' }}"></span>
                        <span class="text-sm font-bold text-gray-700 uppercase">{{ $krs->status }}</span>
                    </div>
                </div>
                <div>
                    <label class="text-[10px] font-bold text-gray-400 uppercase">Tanggal Pengajuan</label>
                    <p class="text-sm font-bold text-gray-700">{{ $krs->tanggal_pengajuan ? \Carbon\Carbon::parse($krs->tanggal_pengajuan)->format('d F Y') : '-' }}</p>
                </div>
                <div>
                    <label class="text-[10px] font-bold text-gray-400 uppercase">Tanggal Validasi</label>
                    <p class="text-sm font-bold text-gray-700">{{ $krs->tanggal_validasi ? \Carbon\Carbon::parse($krs->tanggal_validasi)->format('d F Y') : 'Belum divalidasi' }}</p>
                </div>
            </div>
        </div>

        @if($krs->catatan)
        <div class="bg-orange-50 p-6 rounded-xl border border-orange-100">
            <h3 class="text-sm font-bold text-orange-800 uppercase tracking-wider mb-2">Catatan Dosen Wali</h3>
            <p class="text-xs text-orange-900 italic leading-relaxed">
                "{{ $krs->catatan }}"
            </p>
        </div>
        @endif
    </div>
</div>
@endsection
