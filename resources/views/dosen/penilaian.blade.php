@extends('layouts.app')

@section('content')


<div class="">
    {{-- Header Section --}}
    <div class="bg-gradient-to-r from-indigo-600 to-indigo-500 text-white p-10 rounded-[2rem] mb-8 shadow-2xl relative overflow-hidden">
        <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-[10px] font-black uppercase tracking-[0.2em] mb-4">
                    Portal Penilaian Akademik
                </div>
                <h2 class="text-4xl font-black mb-1 tracking-tight">Penilaian Mahasiswa</h2>
                <p class="text-indigo-100/80 text-sm font-medium">Semester {{ $activeSemester->nama_semester ?? 'Aktif' }}</p>
            </div>
            <div class="text-right">
                <div class="bg-white/10 backdrop-blur-md rounded-2xl px-8 py-5 border border-white/10 shadow-lg">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] opacity-70 mb-1">Batas Input Nilai</p>
                    <p class="text-2xl font-black uppercase tracking-tight">{{ $activeSemester->tanggal_akhir ? \Carbon\Carbon::parse($activeSemester->tanggal_akhir)->translatedFormat('d F Y') : '15 Januari 2025' }}</p>
                </div>
            </div>
        </div>
        {{-- Decorative elements --}}
        <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-white/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-64 h-64 bg-indigo-400/10 rounded-full blur-3xl"></div>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        @php
            $totalClasses = $classes->count();
            $completedClasses = $classes->where('grading_progress', 100)->count();
            $pendingClasses = $totalClasses - $completedClasses;
            $totalStudents = $classes->sum('total_students');
        @endphp
        <div class="bg-white p-8 rounded-[2rem] shadow-xl border border-gray-100 relative overflow-hidden group">
            <div class="relative z-10">
                <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 mb-6 group-hover:scale-110 transition-transform shadow-inner">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Nilai Selesai</p>
                <h4 class="text-4xl font-black text-gray-900 leading-none">{{ $completedClasses }}</h4>
                <p class="text-[10px] font-bold text-gray-400 mt-2 uppercase tracking-tighter">Kelas Terkunci</p>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[2rem] shadow-xl border border-gray-100 relative overflow-hidden group">
            <div class="relative z-10">
                <div class="w-14 h-14 bg-rose-50 rounded-2xl flex items-center justify-center text-rose-600 mb-6 group-hover:scale-110 transition-transform shadow-inner">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Belum Selesai</p>
                <h4 class="text-4xl font-black text-gray-900 leading-none">{{ $pendingClasses }}</h4>
                <p class="text-[10px] font-bold text-gray-400 mt-2 uppercase tracking-tighter">Kelas Tersisa</p>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[2rem] shadow-xl border border-gray-100 relative overflow-hidden group">
            <div class="relative z-10">
                <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 mb-6 group-hover:scale-110 transition-transform shadow-inner">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Total Mahasiswa</p>
                <h4 class="text-4xl font-black text-gray-900 leading-none">{{ $totalStudents }}</h4>
                <p class="text-[10px] font-bold text-gray-400 mt-2 uppercase tracking-tighter">Semua Kelas</p>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[2rem] shadow-xl border border-gray-100 relative overflow-hidden group">
            <div class="relative z-10">
                <div class="w-14 h-14 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 mb-6 group-hover:scale-110 transition-transform shadow-inner">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Rata-rata Nilai</p>
                @php
                    $overallAvg = $classes->avg('avg_grade_numeric') ?? 0;
                    $letter = 'N/A';
                    if ($overallAvg >= 85) $letter = 'A';
                    elseif ($overallAvg >= 75) $letter = 'B+';
                    elseif ($overallAvg >= 65) $letter = 'B';
                    elseif ($overallAvg >= 55) $letter = 'C';
                @endphp
                <h4 class="text-4xl font-black text-gray-900 leading-none">{{ $letter }}</h4>
                <p class="text-[10px] font-bold text-gray-400 mt-2 uppercase tracking-tighter">Berdasarkan Capaian</p>
            </div>
        </div>
    </div>

    {{-- Class List Cards --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
        @foreach($classes as $class)
        <div class="bg-white rounded-[2.5rem] shadow-xl border border-gray-100 overflow-hidden hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 group">
            <div class="p-8">
                <div class="flex items-start justify-between mb-8">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="px-3 py-1 bg-indigo-50 text-indigo-700 rounded-lg text-[10px] font-black uppercase tracking-widest border border-indigo-100">
                                {{ $class->matakuliah->kode_mk }}
                            </span>
                            @if($class->grading_progress == 100)
                                <span class="px-3 py-1 bg-emerald-50 text-emerald-700 rounded-lg text-[10px] font-black uppercase tracking-widest border border-emerald-100">Lengkap</span>
                            @endif
                        </div>
                        <h3 class="text-2xl font-black text-gray-900 leading-tight group-hover:text-indigo-600 transition-colors uppercase tracking-tight">{{ $class->matakuliah->nama_mk }}</h3>
                        <p class="text-sm text-gray-400 font-bold mt-1 uppercase tracking-widest">Kelas {{ $class->kode_kelas }}</p>
                    </div>
                    <div class="text-right">
                        <div class="w-20 h-20 bg-gray-50 rounded-3xl flex flex-col items-center justify-center border border-gray-100 shadow-inner">
                            <span class="text-3xl font-black text-gray-900">{{ $class->avg_grade_letter }}</span>
                            <span class="text-[8px] font-black text-gray-400 uppercase tracking-widest mt-0.5">RERATA</span>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-6 mb-8">
                    <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 shadow-inner">
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-2">Total Mahasiswa</p>
                        <div class="flex items-baseline gap-2">
                            <h4 class="text-3xl font-black text-gray-900">{{ $class->total_students }}</h4>
                            <span class="text-[10px] font-bold text-gray-400 uppercase">MHS</span>
                        </div>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 shadow-inner">
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-2">Terinput</p>
                        <div class="flex items-baseline gap-2">
                            <h4 class="text-3xl font-black text-emerald-600">{{ $class->graded_count }}</h4>
                            <span class="text-[10px] font-bold text-gray-400 uppercase">/ {{ $class->total_students }}</span>
                        </div>
                    </div>
                </div>

                <div class="mb-8">
                    <div class="flex items-center justify-between text-[10px] font-black uppercase tracking-widest text-gray-400 mb-3">
                        <span>Progres Pengisian</span>
                        <span class="text-gray-900 font-black">{{ round($class->grading_progress) }}%</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-2 overflow-hidden shadow-inner">
                        <div class="bg-gradient-to-r from-indigo-500 to-emerald-500 h-full rounded-full transition-all duration-1000" style="width: {{ $class->grading_progress }}%"></div>
                    </div>
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('dosen.penilaian.kelas', $class->kelas_id) }}" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-black py-4 rounded-2xl transition-all shadow-lg shadow-indigo-200 flex items-center justify-center gap-2 uppercase text-xs tracking-widest">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Input Nilai
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Recent Graded Students --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Nilai Terbaru</h3>
                    <p class="text-sm text-gray-500">Mahasiswa yang baru dinilai</p>
                </div>
                <a href="#" class="text-sm text-indigo-600 hover:text-indigo-700 font-semibold">
                    Lihat Semua →
                </a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">NIM</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Nama Mahasiswa</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Mata Kuliah</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Nilai Angka</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Nilai Huruf</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Waktu Input</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($recentGrades as $nilai)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-sm font-mono font-medium text-gray-900">{{ $nilai->mahasiswa->npm }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $nilai->mahasiswa->nama }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $nilai->kelas->matakuliah->nama_mk }}</td>
                        <td class="px-6 py-4 text-center">
                            <span class="text-sm font-bold text-gray-900">{{ number_format($nilai->nilai_angka, 2) }}</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @php
                                $gradeColor = 'green';
                                if($nilai->nilai_huruf == 'A' || $nilai->nilai_huruf == 'A-') $gradeColor = 'emerald';
                                elseif(str_contains($nilai->nilai_huruf, 'B')) $gradeColor = 'blue';
                                elseif(str_contains($nilai->nilai_huruf, 'C')) $gradeColor = 'yellow';
                                else $gradeColor = 'rose';
                            @endphp
                            <span class="inline-block px-3 py-1 bg-{{ $gradeColor }}-50 text-{{ $gradeColor }}-700 rounded-full text-xs font-black border border-{{ $gradeColor }}-100">
                                {{ $nilai->nilai_huruf }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center text-[10px] font-bold text-gray-400 uppercase">{{ $nilai->updated_at->diffForHumans() }}</td>
                    </tr>
                    @endforeach
                    @if($recentGrades->isEmpty())
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-400 italic font-medium">Belum ada nilai yang diinput baru-baru ini.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    {{-- Footer --}}
    <div class="mt-8 text-center text-sm text-gray-500">
        <p>© 2025 Bagian Teknologi Informasi Wiyata Bhakti Indonesia</p>
    </div>
</div>

@endsection