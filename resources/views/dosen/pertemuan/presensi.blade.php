@extends('layouts.app')

@section('content')
<div class="">
    <div class="relative mb-8 overflow-hidden rounded-[2rem] bg-gradient-to-br from-[#047857] via-[#065f46] to-[#064e3b] p-10 text-white shadow-2xl">
        <div class="relative flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-[10px] font-black uppercase tracking-[0.2em] mb-4">
                    Jurnal Mengajar - Ke-{{ $pertemuan->pertemuan_ke }}
                </div>
                <h2 class="text-4xl font-black mb-1 tracking-tight uppercase">{{ $pertemuan->jadwal->kelas->matakuliah->nama_mk }}</h2>
                <p class="text-emerald-100/80 text-sm font-medium">Pengisian Berita Acara Perkuliahan (BAP) - {{ \Carbon\Carbon::parse($pertemuan->tanggal)->translatedFormat('d F Y') }}</p>
            </div>
            <a href="{{ route('dosen.pertemuan.index', ['jadwal_id' => $pertemuan->jadwal_id]) }}" class="group bg-white/10 hover:bg-white hover:text-emerald-900 backdrop-blur-md px-6 py-3 rounded-2xl text-xs font-black uppercase tracking-widest transition-all duration-300 flex items-center gap-2 border border-white/10 shadow-lg">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-6 py-4 rounded-2xl font-bold flex items-center gap-3 animate-in slide-in-from-top duration-300">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('dosen.pertemuan.presensi.simpan') }}" method="POST">
        @csrf
        <input type="hidden" name="pertemuan_id" value="{{ $pertemuan->pertemuan_id }}">
        
        {{-- BAP FORM SECTION --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="md:col-span-2 space-y-6">
                <div class="bg-white p-8 rounded-[2.5rem] shadow-xl border border-gray-100">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Materi Pembahasan (Sesuai Silabus/BAP)</label>
                    <textarea name="materi_pembahasan" rows="4" placeholder="Contoh: Pengenalan Arsitektur MVC, Routing, dan Controller pada Laravel..." class="w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-emerald-500 font-bold text-gray-700 transition-all placeholder:text-gray-300 placeholder:font-medium">{{ old('materi_pembahasan', $pertemuan->materi_pembahasan) }}</textarea>
                </div>
                <div class="bg-white p-8 rounded-[2.5rem] shadow-xl border border-gray-100">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Catatan Perkuliahan / Berita Acara</label>
                    <textarea name="catatan" rows="4" placeholder="Contoh: Mahasiswa aktif bertanya tentang middleware. Kendala proyektor di awal kelas..." class="w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-emerald-500 font-bold text-gray-700 transition-all placeholder:text-gray-300 placeholder:font-medium">{{ old('catatan', $pertemuan->catatan) }}</textarea>
                </div>
            </div>
            <div class="space-y-6">
                <div class="bg-white p-8 rounded-[2.5rem] shadow-xl border border-gray-100">
                    <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-6">Analisis Kehadiran</h4>
                    <div class="space-y-4">
                        @php
                            $stats = [
                                'hadir' => $pertemuan->presensis->where('status', 'hadir')->count(),
                                'izin' => $pertemuan->presensis->where('status', 'izin')->count(),
                                'sakit' => $pertemuan->presensis->where('status', 'sakit')->count(),
                                'alpa' => $pertemuan->presensis->where('status', 'alpa')->count(),
                            ];
                            $total = array_sum($stats);
                        @endphp
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-gray-500">Hadir</span>
                            <span class="text-xs font-black text-emerald-600">{{ $stats['hadir'] }}</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-1.5">
                            <div class="bg-emerald-500 h-1.5 rounded-full" style="width: {{ $total > 0 ? ($stats['hadir']/$total)*100 : 0 }}%"></div>
                        </div>
                        <div class="grid grid-cols-3 gap-2 mt-4 text-center">
                            <div class="p-2 bg-orange-50 rounded-xl">
                                <p class="text-[10px] font-black text-orange-600 uppercase">{{ $stats['izin'] }}</p>
                                <p class="text-[8px] font-bold text-orange-400">Izin</p>
                            </div>
                            <div class="p-2 bg-blue-50 rounded-xl">
                                <p class="text-[10px] font-black text-blue-600 uppercase">{{ $stats['sakit'] }}</p>
                                <p class="text-[8px] font-bold text-blue-400">Sakit</p>
                            </div>
                            <div class="p-2 bg-rose-50 rounded-xl">
                                <p class="text-[10px] font-black text-rose-600 uppercase">{{ $stats['alpa'] }}</p>
                                <p class="text-[8px] font-bold text-rose-400">Alpa</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-gray-900 to-gray-800 p-8 rounded-[2.5rem] shadow-xl text-white">
                    <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-4">Opsi Dokumen</h4>
                    <a href="{{ route('dosen.pertemuan.export-pdf', $pertemuan->pertemuan_id) }}" class="flex items-center gap-3 px-6 py-4 bg-white/10 hover:bg-white/20 rounded-2xl transition-all border border-white/10 group">
                        <svg class="w-5 h-5 text-emerald-400 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span class="text-[10px] font-black uppercase tracking-widest">Cetak BAP (PDF)</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-xl border border-gray-100 overflow-hidden mb-8">
            <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-black text-gray-800 uppercase tracking-tight">Daftar Mahaswiswa & Presensi</h3>
                    <p class="text-xs text-gray-400 font-medium">Data ini disinkronkan dengan KRS resmi mahasiswa</p>
                </div>
                <div class="flex gap-2">
                    <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-[9px] font-black rounded-lg uppercase">Resmi SIAKAD</span>
                </div>
            </div>
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100">
                            <th class="px-6 py-6 text-left text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Mahasiswa</th>
                            <th class="px-6 py-6 text-center text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Hadir</th>
                            <th class="px-6 py-6 text-center text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Izin</th>
                            <th class="px-6 py-6 text-center text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Sakit</th>
                            <th class="px-6 py-6 text-center text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Alpa</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 italic1">
                        @foreach($mahasiswas as $index => $mhs)
                        @php
                            $status = strtolower($existingPresensi[$mhs->mahasiswa_id] ?? 'hadir');
                        @endphp
                        <tr class="hover:bg-gray-50 transition group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 bg-gray-100 rounded-xl overflow-hidden shadow-inner border border-gray-200">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($mhs->nama) }}&background=EBF5FF&color=1E40AF" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <p class="font-black text-gray-800 text-sm tracking-tight">{{ $mhs->nama }}</p>
                                        <p class="text-[10px] text-gray-400 font-mono">{{ $mhs->npm }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <label class="cursor-pointer group/label">
                                    <input type="radio" name="presensi[{{ $mhs->mahasiswa_id }}]" value="hadir" {{ $status == 'hadir' ? 'checked' : '' }} class="hidden peer">
                                    <div class="w-10 h-10 rounded-full border-2 border-gray-100 peer-checked:border-emerald-500 peer-checked:bg-emerald-500 flex items-center justify-center transition-all group-hover/label:border-emerald-200 shadow-sm">
                                        <svg class="w-5 h-5 text-gray-200 peer-checked:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <p class="text-[9px] font-black text-gray-400 uppercase mt-1 tracking-widest peer-checked:text-emerald-600">Hadir</p>
                                </label>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <label class="cursor-pointer group/label">
                                    <input type="radio" name="presensi[{{ $mhs->mahasiswa_id }}]" value="izin" {{ $status == 'izin' ? 'checked' : '' }} class="hidden peer">
                                    <div class="w-10 h-10 rounded-full border-2 border-gray-100 peer-checked:border-orange-500 peer-checked:bg-orange-500 flex items-center justify-center transition-all group-hover/label:border-orange-200 shadow-sm">
                                        <svg class="w-5 h-5 text-gray-200 peer-checked:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-[9px] font-black text-gray-400 uppercase mt-1 tracking-widest peer-checked:text-orange-600">Izin</p>
                                </label>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <label class="cursor-pointer group/label">
                                    <input type="radio" name="presensi[{{ $mhs->mahasiswa_id }}]" value="sakit" {{ $status == 'sakit' ? 'checked' : '' }} class="hidden peer">
                                    <div class="w-10 h-10 rounded-full border-2 border-gray-100 peer-checked:border-blue-500 peer-checked:bg-blue-500 flex items-center justify-center transition-all group-hover/label:border-blue-200 shadow-sm">
                                        <svg class="w-5 h-5 text-gray-200 peer-checked:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-[9px] font-black text-gray-400 uppercase mt-1 tracking-widest peer-checked:text-blue-600">Sakit</p>
                                </label>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <label class="cursor-pointer group/label">
                                    <input type="radio" name="presensi[{{ $mhs->mahasiswa_id }}]" value="alpa" {{ $status == 'alpa' ? 'checked' : '' }} class="hidden peer">
                                    <div class="w-10 h-10 rounded-full border-2 border-gray-100 peer-checked:border-rose-500 peer-checked:bg-rose-500 flex items-center justify-center transition-all group-hover/label:border-rose-200 shadow-sm">
                                        <svg class="w-5 h-5 text-gray-200 peer-checked:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </div>
                                    <p class="text-[9px] font-black text-gray-400 uppercase mt-1 tracking-widest peer-checked:text-rose-600">Alpa</p>
                                </label>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="fixed bottom-8 left-1/2 -translate-x-1/2 z-50">
            <button type="submit" class="bg-gray-900 text-white px-12 py-5 rounded-[2rem] font-black uppercase text-xs tracking-[0.25em] shadow-2xl shadow-gray-900/40 hover:scale-110 hover:-translate-y-2 transition-all active:scale-95 border-4 border-white">
                Simpan Presensi Hari Ini
            </button>
        </div>
    </form>
</div>
@endsection
