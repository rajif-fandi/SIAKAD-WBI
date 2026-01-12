@extends('layouts.app')

@section('content')
<div class="px-8 py-8">
    {{-- Header Section --}}
    <div class="bg-gradient-to-r from-indigo-700 to-indigo-600 text-white p-10 rounded-[2.5rem] mb-8 shadow-2xl relative overflow-hidden">
        <div class="relative z-10">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-6">
                    <div class="w-16 h-16 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center border border-white/20 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <span class="px-3 py-1 bg-white/10 rounded-lg text-[10px] font-black uppercase tracking-widest border border-white/20">{{ $class->matakuliah->kode_mk }} - {{ $class->kode_kelas }}</span>
                            <span class="px-3 py-1 bg-emerald-500/20 text-emerald-100 rounded-lg text-[10px] font-black uppercase tracking-widest border border-emerald-500/30">{{ $class->semesterAjaran->nama_semester }}</span>
                        </div>
                        <h2 class="text-3xl font-black tracking-tight uppercase">{{ $class->matakuliah->nama_mk }}</h2>
                        <p class="text-indigo-100/80 font-medium text-sm mt-1">Input Nilai Mahasiswa & Konfigurasi Kontrak Kuliah</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <a href="{{ route('dosen.penilaian') }}" class="px-6 py-4 bg-white/10 hover:bg-white/20 border border-white/10 rounded-2xl font-black text-xs uppercase tracking-widest transition-all">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
        <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-white/5 rounded-full blur-3xl"></div>
    </div>

    {{-- Weight Configuration (Kontrak Kuliah) --}}
    <div class="bg-white rounded-[2.5rem] shadow-xl border border-gray-100 p-8 mb-8 overflow-hidden relative">
        <div class="flex items-center justify-between mb-8 pb-6 border-bottom border-gray-100">
            <div>
                <h3 class="text-xl font-black text-gray-900 uppercase tracking-tight">Kontrak Kuliah (Bobot Nilai)</h3>
                <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mt-1">Tentukan persentase penilaian untuk kelas ini</p>
            </div>
            <div id="total-weight-badge" class="px-6 py-3 bg-emerald-50 text-emerald-600 rounded-2xl font-black text-lg shadow-inner border border-emerald-100">
                100%
            </div>
        </div>

        <form action="{{ route('dosen.penilaian.weights.update', $class->kelas_id) }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @csrf
            <div class="space-y-2">
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest">Kehadiran (%)</label>
                <input type="number" name="bobot_kehadiran" value="{{ $class->bobot_kehadiran }}" class="weight-input w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-indigo-500 font-black text-gray-700 transition-all shadow-inner" placeholder="10">
            </div>
            <div class="space-y-2">
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest">Tugas (%)</label>
                <input type="number" name="bobot_tugas" value="{{ $class->bobot_tugas }}" class="weight-input w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-indigo-500 font-black text-gray-700 transition-all shadow-inner" placeholder="20">
            </div>
            <div class="space-y-2">
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest">UTS (%)</label>
                <input type="number" name="bobot_uts" value="{{ $class->bobot_uts }}" class="weight-input w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-indigo-500 font-black text-gray-700 transition-all shadow-inner" placeholder="30">
            </div>
            <div class="space-y-2">
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest">UAS (%)</label>
                <input type="number" name="bobot_uas" value="{{ $class->bobot_uas }}" class="weight-input w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-indigo-500 font-black text-gray-700 transition-all shadow-inner" placeholder="40">
            </div>
            <div class="md:col-span-4 flex justify-end">
                <button type="submit" class="px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-black rounded-2xl transition-all shadow-lg shadow-indigo-200 uppercase text-xs tracking-widest">
                    Simpan Kontrak Kuliah
                </button>
            </div>
        </form>
    </div>

    {{-- Student List & Grading --}}
    <form action="{{ route('dosen.penilaian.store') }}" method="POST">
        @csrf
        <input type="hidden" name="kelas_id" value="{{ $class->kelas_id }}">
        
        <div class="bg-white rounded-[2.5rem] shadow-xl border border-gray-100 overflow-hidden">
            <div class="p-8 border-b border-gray-100 flex flex-col md:flex-row items-center justify-between bg-gray-50/50 gap-4">
                <div>
                    <h3 class="text-xl font-black text-gray-900 uppercase tracking-tight">Daftar Mahasiswa</h3>
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mt-1">Total Pertemuan: {{ $pertemuanCount }} Sesi</p>
                </div>
                <div class="flex items-center gap-6">
                    <button type="button" id="auto-attendance-btn" class="px-6 py-3 bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white border border-emerald-100 rounded-2xl font-black text-[10px] uppercase tracking-widest transition-all shadow-sm flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                        </svg>
                        Ambil Absensi Otomatis
                    </button>
                    <label class="inline-flex items-center cursor-pointer group">
                        <input type="checkbox" name="lock_grades" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-rose-500"></div>
                        <span class="ml-3 text-[10px] font-black uppercase text-gray-400 group-hover:text-rose-600 transition-colors">Kunci Nilai (Final)</span>
                    </label>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="p-8 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-gray-100">Mahasiswa</th>
                            <th class="p-6 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-gray-100 text-center w-24">Hadir</th>
                            <th class="p-6 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-gray-100 text-center w-24">Tugas</th>
                            <th class="p-6 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-gray-100 text-center w-24">UTS</th>
                            <th class="p-6 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-gray-100 text-center w-24">UAS</th>
                            <th class="p-6 text-[10px] font-black text-indigo-500 uppercase tracking-widest border-b border-gray-100 text-center w-32">Akhir</th>
                            <th class="p-6 text-[10px] font-black text-indigo-500 uppercase tracking-widest border-b border-gray-100 text-center w-24">Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $mhs)
                        @php $isLocked = $mhs->nilai && $mhs->nilai->status_kunci; @endphp
                        <tr class="hover:bg-gray-50/50 transition-colors group student-row {{ $isLocked ? 'opacity-75' : '' }}" 
                            data-student-id="{{ $mhs->mahasiswa_id }}"
                            data-auto-kehadiran="{{ $mhs->auto_kehadiran }}">
                            <td class="p-8 border-b border-gray-100">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 {{ $isLocked ? 'bg-rose-50 text-rose-600' : 'bg-indigo-50 text-indigo-600' }} rounded-2xl flex items-center justify-center font-black text-lg shadow-inner group-hover:scale-110 transition-transform">
                                        @if($isLocked)
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                            </svg>
                                        @else
                                            {{ substr($mhs->nama, 0, 1) }}
                                        @endif
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <p class="font-black text-gray-900 uppercase tracking-tight leading-none">{{ $mhs->nama }}</p>
                                            @if($isLocked)
                                                <span class="px-2 py-0.5 bg-rose-50 text-rose-600 text-[8px] font-black uppercase rounded border border-rose-100">Locked</span>
                                            @endif
                                        </div>
                                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">{{ $mhs->npm }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 border-b border-gray-100 text-center">
                                <input type="number" name="grades[{{ $mhs->mahasiswa_id }}][kehadiran]" value="{{ $mhs->nilai->nilai_kehadiran ?? 0 }}" step="0.01" min="0" max="100" class="grade-input w-20 px-3 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-indigo-500 font-bold text-center text-gray-700 shadow-inner {{ $isLocked ? 'cursor-not-allowed' : '' }}" data-type="kehadiran" {{ $isLocked ? 'readonly' : '' }}>
                            </td>
                            <td class="p-4 border-b border-gray-100 text-center">
                                <input type="number" name="grades[{{ $mhs->mahasiswa_id }}][tugas]" value="{{ $mhs->nilai->nilai_tugas ?? 0 }}" step="0.01" min="0" max="100" class="grade-input w-20 px-3 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-indigo-500 font-bold text-center text-gray-700 shadow-inner {{ $isLocked ? 'cursor-not-allowed' : '' }}" data-type="tugas" {{ $isLocked ? 'readonly' : '' }}>
                            </td>
                            <td class="p-4 border-b border-gray-100 text-center">
                                <input type="number" name="grades[{{ $mhs->mahasiswa_id }}][uts]" value="{{ $mhs->nilai->nilai_uts ?? 0 }}" step="0.01" min="0" max="100" class="grade-input w-20 px-3 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-indigo-500 font-bold text-center text-gray-700 shadow-inner {{ $isLocked ? 'cursor-not-allowed' : '' }}" data-type="uts" {{ $isLocked ? 'readonly' : '' }}>
                            </td>
                            <td class="p-4 border-b border-gray-100 text-center">
                                <input type="number" name="grades[{{ $mhs->mahasiswa_id }}][uas]" value="{{ $mhs->nilai->nilai_uas ?? 0 }}" step="0.01" min="0" max="100" class="grade-input w-20 px-3 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-indigo-500 font-bold text-center text-gray-700 shadow-inner {{ $isLocked ? 'cursor-not-allowed' : '' }}" data-type="uas" {{ $isLocked ? 'readonly' : '' }}>
                            </td>
                            <td class="p-4 border-b border-gray-100 text-center">
                                <span class="final-score text-xl font-black text-indigo-600 tracking-tight">
                                    {{ number_format($mhs->nilai->nilai_angka ?? 0, 2) }}
                                </span>
                            </td>
                            <td class="p-4 border-b border-gray-100 text-center">
                                <div class="w-12 h-12 mx-auto bg-gray-100 rounded-2xl flex items-center justify-center font-black text-lg text-gray-900 letter-grade shadow-inner border border-gray-100">
                                    {{ $mhs->nilai->nilai_huruf ?? '-' }}
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="p-10 bg-gray-50/50 flex flex-col md:flex-row items-center justify-between gap-8 border-t border-gray-100">
                <div class="flex items-center gap-4 text-gray-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-xs font-bold font-medium italic">Nilai akan dikonversi otomatis ke huruf dan bobot 4.0 saat Anda memasukkan angka.</p>
                </div>
                <button type="submit" class="w-full md:w-auto px-12 py-5 bg-indigo-600 hover:bg-indigo-700 text-white font-black rounded-3xl transition-all shadow-2xl shadow-indigo-200 uppercase text-sm tracking-widest transform hover:-translate-y-1">
                    Simpan Seluruh Nilai
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const weightInputs = document.querySelectorAll('.weight-input');
        const gradeInputs = document.querySelectorAll('.grade-input');
        const rows = document.querySelectorAll('.student-row');
        const totalWeightBadge = document.getElementById('total-weight-badge');

        function calculateWeights() {
            let total = 0;
            weightInputs.forEach(input => total += parseFloat(input.value || 0));
            totalWeightBadge.textContent = total + '%';
            if (total !== 100) {
                totalWeightBadge.className = 'px-6 py-3 bg-rose-50 text-rose-600 rounded-2xl font-black text-lg shadow-inner border border-rose-100';
            } else {
                totalWeightBadge.className = 'px-6 py-3 bg-emerald-50 text-emerald-600 rounded-2xl font-black text-lg shadow-inner border border-emerald-100';
            }
            return total;
        }

        function getWeights() {
            return {
                kehadiran: parseFloat(document.querySelector('[name="bobot_kehadiran"]').value || 0) / 100,
                tugas: parseFloat(document.querySelector('[name="bobot_tugas"]').value || 0) / 100,
                uts: parseFloat(document.querySelector('[name="bobot_uts"]').value || 0) / 100,
                uas: parseFloat(document.querySelector('[name="bobot_uas"]').value || 0) / 100,
            };
        }

        function getLetterGrade(score) {
            if (score >= 85) return 'A';
            if (score >= 80) return 'A-';
            if (score >= 75) return 'B+';
            if (score >= 70) return 'B';
            if (score >= 65) return 'B-';
            if (score >= 60) return 'C+';
            if (score >= 55) return 'C';
            if (score >= 45) return 'D';
            return 'E';
        }

        function calculateRow(row) {
            const weights = getWeights();
            const inputs = row.querySelectorAll('.grade-input');
            let numeric = 0;

            inputs.forEach(input => {
                const type = input.dataset.type;
                const value = parseFloat(input.value || 0);
                numeric += value * weights[type];
            });

            row.querySelector('.final-score').textContent = numeric.toFixed(2);
            const letter = getLetterGrade(numeric);
            const letterEl = row.querySelector('.letter-grade');
            letterEl.textContent = letter;

            // Optional styling based on letter
            let baseClasses = 'w-12 h-12 mx-auto rounded-2xl flex items-center justify-center font-black text-lg shadow-inner border letter-grade transition-all ';
            if (['D', 'E'].includes(letter)) {
                letterEl.className = baseClasses + 'bg-rose-50 text-rose-600 border-rose-100';
            } else if (['A', 'A-'].includes(letter)) {
                letterEl.className = baseClasses + 'bg-emerald-50 text-emerald-600 border-emerald-100';
            } else {
                letterEl.className = baseClasses + 'bg-gray-100 text-gray-900 border-gray-100';
            }
        }

        weightInputs.forEach(input => {
            input.addEventListener('input', () => {
                calculateWeights();
                rows.forEach(row => calculateRow(row));
            });
        });

        gradeInputs.forEach(input => {
            input.addEventListener('input', () => {
                calculateRow(input.closest('.student-row'));
            });
        });

        // Auto attendance logic
        const autoAttendanceBtn = document.getElementById('auto-attendance-btn');
        autoAttendanceBtn.addEventListener('click', function() {
            Swal.fire({
                title: 'Sinkronisasi Absensi',
                text: 'Ambil data kehadiran otomatis dari jurnal mengajar?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#059669',
                confirmButtonText: 'Ya, Sinkronkan'
            }).then((result) => {
                if (result.isConfirmed) {
                    rows.forEach(row => {
                        const autoValue = row.dataset.autoKehadiran;
                        const input = row.querySelector('[data-type="kehadiran"]');
                        if (input && !input.readOnly) {
                            input.value = parseFloat(autoValue).toFixed(2);
                            calculateRow(row);
                        }
                    });
                    
                    Swal.fire('Berhasil!', 'Data kehadiran telah diperbarui sesuai jurnal mengajar.', 'success');
                }
            });
        });

        // Initial calculation
        calculateWeights();
        rows.forEach(row => calculateRow(row));
    });
</script>
@endsection
