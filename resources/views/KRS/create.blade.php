@extends('layouts.app')

@section('title', 'Isi KRS')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-gray-900">Pengisian KRS</h1>
    <p class="text-gray-500">Tahun Ajaran {{ $activeSemester->tahun_ajaran }} - Semester {{ ucfirst($activeSemester->semester) }}</p>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-8">
    <div class="p-6 bg-[#1b4d36] text-white">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <p class="text-green-200 text-xs font-bold uppercase tracking-wider mb-1">Mahasiswa</p>
                <h2 class="text-xl font-bold">{{ $mahasiswa->nama }}</h2>
                <p class="text-sm opacity-90">{{ $mahasiswa->npm }} • {{ $mahasiswa->prodi->nama_prodi }}</p>
            </div>
            <div class="bg-white/10 px-4 py-2 rounded-lg backdrop-blur-sm">
                <p class="text-green-200 text-[10px] font-bold uppercase tracking-wider mb-1 text-center">Semester Paket</p>
                <p class="text-lg font-bold text-center">{{ $mahasiswa->semester_sekarang }}</p>
            </div>
        </div>
    </div>

    <form action="{{ route('KRS.store') }}" method="POST" id="krsForm">
        @csrf
        <input type="hidden" name="action" id="formAction" value="submit">
        <div class="overflow-x-auto">
            <table class="w-full text-left font-inter">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="py-4 px-6 text-[10px] font-bold text-gray-400 uppercase tracking-wider w-10">Pilih</th>
                        <th class="py-4 px-6 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Kode</th>
                        <th class="py-4 px-6 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Mata Kuliah</th>
                        <th class="py-4 px-6 text-[10px] font-bold text-gray-400 uppercase tracking-wider">SKS</th>
                        <th class="py-4 px-6 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Kelas</th>
                        <th class="py-4 px-6 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Dosen</th>
                        <th class="py-4 px-6 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Jadwal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @php
                        $selectedKelasIds = $mahasiswa->activeKrs ? $mahasiswa->activeKrs->details->pluck('kelas_id')->toArray() : [];
                        // Identify failed MK IDs for labeling
                        $failedMkIds = \App\Models\Nilai::where('mahasiswa_id', $mahasiswa->mahasiswa_id)
                            ->where('bobot', '<', 2.0)
                            ->join('kelas', 'nilai.kelas_id', '=', 'kelas.kelas_id')
                            ->pluck('kelas.matakuliah_id')
                            ->toArray();
                    @endphp
                    @forelse($availableClasses as $kelas)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-6">
                            <input type="checkbox" name="kelas_ids[]" value="{{ $kelas->kelas_id }}" 
                                {{ in_array($kelas->kelas_id, $selectedKelasIds) ? 'checked' : '' }}
                                class="w-4 h-4 text-[#1b4d36] border-gray-300 rounded focus:ring-[#1b4d36]">
                        </td>
                        <td class="py-4 px-6 font-bold text-[#1b4d36]">{{ $kelas->matakuliah->kode_mk }}</td>
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-2">
                                <p class="font-bold text-gray-900">{{ $kelas->matakuliah->nama_mk }}</p>
                                @if(in_array($kelas->matakuliah_id, $failedMkIds))
                                    <span class="px-2 py-0.5 rounded text-[9px] font-bold uppercase tracking-wider bg-orange-100 text-orange-700 border border-orange-200">Mengulang</span>
                                @endif
                            </div>
                            <p class="text-[10px] text-gray-400">Paket Semester: {{ $kelas->matakuliah->semester_paket }}</p>
                        </td>
                        <td class="py-4 px-6 font-bold text-gray-700 text-center">{{ $kelas->matakuliah->sks }}</td>
                        <td class="py-4 px-6 font-bold text-gray-900">{{ $kelas->kode_kelas }}</td>
                        <td class="py-4 px-6">
                            @foreach($kelas->dosenPengampu as $dp)
                                <p class="text-xs text-gray-700">{{ $dp->dosen->nama }}</p>
                            @endforeach
                        </td>
                        <td class="py-4 px-6">
                            @foreach($kelas->jadwals as $jadwal)
                                <p class="text-xs text-gray-600 font-medium">{{ $jadwal->hari }}, {{ substr($jadwal->jam_mulai, 0, 5) }} - {{ substr($jadwal->jam_selesai, 0, 5) }}</p>
                                <p class="text-[10px] text-gray-400">{{ $jadwal->ruangan }}</p>
                            @endforeach
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-12 px-6 text-center text-gray-500 italic">
                            Tidak ada mata kuliah yang tersedia untuk semester {{ $activeSemester->semester }} ini sesuai Program Studi Anda.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-6 bg-gray-50 flex items-center justify-between border-t border-gray-100">
            <div class="text-sm font-medium text-gray-600">
                Total SKS Terpilih: <span id="totalSks" class="font-bold text-[#1b4d36]">0</span>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('KRS.index') }}" class="px-6 py-2 rounded-lg font-bold text-gray-500 hover:bg-gray-200 transition text-sm">Batal</a>
                <button type="submit" onclick="document.getElementById('formAction').value='draft'" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg font-bold transition text-sm">Simpan Draft</button>
                <button type="submit" onclick="document.getElementById('formAction').value='submit'" class="bg-[#1b4d36] hover:bg-[#153e2b] text-white px-8 py-2 rounded-lg font-bold shadow-sm transition text-sm">Ajukan KRS</button>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('input[name="kelas_ids[]"]');
        const totalSksEl = document.getElementById('totalSks');
        
        function updateTotalSks(e) {
            let total = 0;
            checkboxes.forEach(cb => {
                if (cb.checked) {
                    const row = cb.closest('tr');
                    const sks = parseInt(row.cells[3].textContent);
                    total += sks;
                }
            });

            if (total > 25 && e && e.target.checked) {
                Swal.fire({
                    title: 'Batas SKS Terlampaui',
                    text: 'Maksimal pengambilan adalah 25 SKS. Total saat ini: ' + total + ' SKS.',
                    icon: 'warning',
                    confirmButtonColor: '#1b4d36'
                });
                
                // Uncheck the last action
                e.target.checked = false;
                
                // Recalculate without the last one
                updateTotalSks();
                return;
            }

            totalSksEl.textContent = total;
        }

        checkboxes.forEach(cb => {
            cb.addEventListener('change', (e) => updateTotalSks(e));
        });

        // Initialize total on load
        updateTotalSks();
    });
</script>
@endsection
