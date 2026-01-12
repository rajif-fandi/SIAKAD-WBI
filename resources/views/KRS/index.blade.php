@extends('layouts.app')

@section('content')

{{-- Top Action Button & Rejection Alert --}}
<div class="mb-6 space-y-4">
    @if(!$hasActiveKrs || $activeKrsStatus === 'ditolak' || $activeKrsStatus === 'draft')
        <a href="{{ route('KRS.create') }}" class="flex items-center gap-2 {{ $activeKrsStatus === 'ditolak' ? 'bg-orange-600 hover:bg-orange-700' : ($activeKrsStatus === 'draft' ? 'bg-blue-600 hover:bg-blue-700' : 'bg-[#1b4d36] hover:bg-[#153e2b]') }} text-white px-6 py-2.5 rounded-lg font-bold shadow-sm transition w-fit">
            <span>
                @if($activeKrsStatus === 'ditolak')
                    Revisi & Isi Kembali KRS
                @elseif($activeKrsStatus === 'draft')
                    Lanjutkan Pengisian (Draft)
                @else
                    Isi KRS
                @endif
            </span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
        </a>

        @if($activeKrsStatus === 'ditolak')
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="bg-red-500 p-1.5 rounded-full text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-red-800 uppercase tracking-tight">KRS Anda Ditolak</h3>
                        <p class="text-xs text-red-700 mt-0.5">Silakan baca catatan dosen di bawah dan klik tombol di atas untuk mengajukan ulang KRS yang sudah diperbaiki.</p>
                    </div>
                </div>
            </div>
        @elseif($activeKrsStatus === 'draft')
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-r-lg shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="bg-blue-500 p-1.5 rounded-full text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-blue-800 uppercase tracking-tight">KRS Masih Draft</h3>
                        <p class="text-xs text-blue-700 mt-0.5">KRS Anda belum diajukan ke Dosen Wali. Klik tombol di atas untuk melanjutkan dan mengirimkan KRS.</p>
                    </div>
                </div>
            </div>
        @endif
    @else
        <div class="bg-green-100 text-green-700 px-6 py-2.5 rounded-lg font-bold border border-green-200 w-fit">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                KRS Semester Ini Sudah Terdaftar ({{ $activeKrsStatus === 'disetujui_wali' ? 'Disetujui' : 'Dalam Proses' }})
            </div>
        </div>
    @endif
</div>

{{-- Filter & Search Bar ... (omitted for brevity, keep existing or update if needed) --}}

{{-- Content Cards --}}
<div class="space-y-6">
    @forelse($krsList as $index => $krs)
    <div class="bg-white rounded-lg shadow-sm overflow-hidden flex font-inter">
        {{-- Left Border Strip --}}
        <div class="w-1.5 bg-[#1b4d36] flex-shrink-0"></div>
        
        <div class="flex-1 p-0">
            {{-- Header --}}
            <div class="bg-[#e2f2e9] px-6 py-4 flex items-center justify-between border-b border-[#c8e6d5]">
                <div class="flex items-center gap-4">
                    <div class="w-8 h-8 rounded-full bg-[#1b4d36] text-white flex items-center justify-center font-bold text-sm shadow-sm">
                        {{ $krsList->count() - $index }}
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-[#1b4d36]">{{ $krs->semesterAjaran->tahun_ajaran }} {{ ucfirst($krs->semesterAjaran->semester) }}</h3>
                        <p class="text-xs text-gray-500 font-medium">ID SMT: {{ $krs->semester_ajaran_id }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    @php
                        $statusClasses = [
                            'draft' => 'bg-gray-100 text-gray-600 border-gray-200',
                            'diajukan' => 'bg-blue-50 text-blue-700 border-blue-200',
                            'disetujui_wali' => 'bg-green-50 text-green-700 border-green-200',
                            'ditolak' => 'bg-red-50 text-red-700 border-red-200',
                            'final' => 'bg-purple-50 text-purple-700 border-purple-200'
                        ];
                        $statusLabels = [
                            'draft' => 'Draft',
                            'diajukan' => 'Pend. Review',
                            'disetujui_wali' => 'Disetujui',
                            'ditolak' => 'Ditolak',
                            'final' => 'Final'
                        ];
                        $currentClass = $statusClasses[$krs->status] ?? $statusClasses['draft'];
                        $currentLabel = $statusLabels[$krs->status] ?? $krs->status;
                    @endphp
                    <span class="px-4 py-1 rounded-full border {{ $currentClass }} text-[10px] font-bold uppercase tracking-wider">
                        {{ $currentLabel }}
                    </span>
                    <button onclick="showKrsDetails({{ $krs->krs_id }})" class="flex items-center gap-1.5 bg-[#1b4d36] hover:bg-[#153e2b] text-white px-4 py-1.5 rounded-md text-xs font-bold transition shadow-sm">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        Lihat KRS
                    </button>
                </div>
            </div>

            <div class="p-6 space-y-6">
                {{-- Summary Stats --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                     <div class="bg-[#fcfdfd] border border-gray-100 p-4 rounded-xl">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Total SKS</p>
                        <p class="text-xl font-bold text-gray-900">{{ $krs->total_sks }} SKS</p>
                    </div>
                    <div class="bg-[#fcfdfd] border border-gray-100 p-4 rounded-xl">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Tgl Pengajuan</p>
                        <p class="text-sm font-bold text-gray-700">{{ $krs->tanggal_pengajuan ? \Carbon\Carbon::parse($krs->tanggal_pengajuan)->format('d-m-Y') : '-' }}</p>
                    </div>
                    <div class="bg-[#fcfdfd] border border-gray-100 p-4 rounded-xl">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Tgl Validasi</p>
                        <p class="text-sm font-bold text-green-700">{{ $krs->tanggal_validasi ? \Carbon\Carbon::parse($krs->tanggal_validasi)->format('d-m-Y') : 'Belum divalidasi' }}</p>
                    </div>
                </div>

                {{-- Note Placeholder (If any) --}}
                @if($krs->catatan)
                <div>
                    <div class="flex items-center gap-2 mb-3 text-[#1b4d36]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                        <h4 class="text-xs font-bold uppercase tracking-wide">Catatan Dosen Wali</h4>
                    </div>
                    <div class="bg-[#f0f9f4] p-4 rounded-lg border-l-4 border-[#1b4d36] text-xs text-gray-700 italic">
                        "{{ $krs->catatan }}"
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    @empty
    <div class="bg-white rounded-xl p-12 text-center shadow-sm border border-gray-100">
        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
        </svg>
        <p class="text-gray-500 font-medium">Belum ada riwayat KRS.</p>
    </div>
    @endforelse
</div>

{{-- KRS Modal --}}
<div id="krsModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="closeKrsModal()"></div>

        <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-4xl font-inter">
            <div class="bg-[#1b4d36] px-6 py-4 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-white" id="modalTitle">Detail KRS</h3>
                    <p class="text-xs text-green-200" id="modalSubTitle"></p>
                </div>
                <button onclick="closeKrsModal()" class="text-white hover:text-green-200 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="p-6">
                <div class="overflow-x-auto rounded-xl border border-gray-100">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50 text-[10px] font-bold text-gray-400 uppercase tracking-wider border-b border-gray-100">
                                <th class="py-4 px-6">Mata Kuliah</th>
                                <th class="py-4 px-6 text-center">SKS</th>
                                <th class="py-4 px-6">Kelas</th>
                                <th class="py-4 px-6">Dosen</th>
                                <th class="py-4 px-6">Status</th>
                            </tr>
                        </thead>
                        <tbody id="modalContent" class="divide-y divide-gray-100 text-sm">
                            {{-- Content loaded via JS --}}
                        </tbody>
                        <tfoot>
                            <tr class="bg-gray-50 font-bold">
                                <td class="py-4 px-6 text-right text-gray-500">Total SKS</td>
                                <td class="py-4 px-6 text-center text-[#1b4d36]" id="modalTotalSks">0</td>
                                <td colspan="3"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="bg-gray-50 px-6 py-4 flex justify-end">
                <button onclick="closeKrsModal()" class="bg-[#1b4d36] hover:bg-[#153e2b] text-white px-6 py-2 rounded-lg text-sm font-bold transition shadow-sm">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    function showKrsDetails(krsId) {
        const modal = document.getElementById('krsModal');
        const content = document.getElementById('modalContent');
        const title = document.getElementById('modalTitle');
        const subTitle = document.getElementById('modalSubTitle');
        const totalSks = document.getElementById('modalTotalSks');

        content.innerHTML = '<tr><td colspan="5" class="py-12 text-center text-gray-500 italic">Memuat data...</td></tr>';
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        fetch(`/KRS/${krsId}`, {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            title.textContent = `KRS ${data.semester_ajaran.tahun_ajaran} ${data.semester_ajaran.semester.charAt(0).toUpperCase() + data.semester_ajaran.semester.slice(1)}`;
            subTitle.textContent = `Diajukan pada: ${new Date(data.tanggal_pengajuan).toLocaleDateString('id-ID')}`;
            totalSks.textContent = data.total_sks;

            let html = '';
            
            // Add catatan if exists
            if (data.catatan) {
                html += `
                    <tr>
                        <td colspan="5" class="py-4 px-6 bg-orange-50 border-b border-orange-100">
                            <p class="text-[10px] uppercase font-bold text-orange-800 tracking-wider">Catatan Dosen Wali:</p>
                            <p class="text-xs text-orange-900 mt-1 leading-relaxed italic">"${data.catatan}"</p>
                        </td>
                    </tr>
                `;
            }

            data.details.forEach(detail => {
                const dosenList = detail.kelas.dosen_pengampu.map(dp => `<div>${dp.dosen.nama}</div>`).join('');
                html += `
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-6">
                            <p class="font-bold text-gray-900">${detail.kelas.matakuliah.nama_mk}</p>
                            <p class="text-[10px] text-gray-400">${detail.kelas.matakuliah.kode_mk}</p>
                        </td>
                        <td class="py-4 px-6 font-bold text-gray-700 text-center">${detail.kelas.matakuliah.sks}</td>
                        <td class="py-4 px-6 font-bold text-gray-900 uppercase">${detail.kelas.kode_kelas}</td>
                        <td class="py-4 px-6 text-[11px] text-gray-600">${dosenList}</td>
                        <td class="py-4 px-6">
                            <span class="px-2 py-1 rounded-md text-[10px] font-bold uppercase ${detail.status === 'terverifikasi' ? 'bg-green-50 text-green-600' : 'bg-blue-50 text-blue-600'}">
                                ${detail.status}
                            </span>
                        </td>
                    </tr>
                `;
            });
            content.innerHTML = html;
        })
        .catch(err => {
            content.innerHTML = '<tr><td colspan="5" class="py-12 text-center text-red-500 italic">Gagal memuat data.</td></tr>';
        });
    }

    function closeKrsModal() {
        const modal = document.getElementById('krsModal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
</script>
</div>

{{-- Footer Pagination --}}
<div class="mt-6 bg-white p-3 rounded-lg shadow-sm border border-gray-100 flex items-center justify-between">
    <span class="text-xs text-gray-500 font-medium pl-2">Showing 1 to 1 of 1 entries</span>
    <div class="flex gap-1">
        <button class="px-3 py-1 text-xs font-medium text-gray-500 hover:bg-gray-50 rounded border border-gray-200">First</button>
        <button class="px-3 py-1 text-xs font-bold text-white bg-[#1b4d36] rounded">1</button>
        <button class="px-3 py-1 text-xs font-medium text-gray-500 hover:bg-gray-50 rounded border border-gray-200">Last</button>
    </div>
</div>

@endsection