@extends('layouts.app')

@section('content')

{{-- Filter Section --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 mb-6">
    <form action="{{ route('dosen.KRSMahasiswa') }}" method="GET" class="flex flex-wrap items-center justify-between gap-4">
        <div class="flex flex-wrap items-center gap-3 flex-1">
            <div class="relative flex-1 max-w-md">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari mahasiswa (nama/NIM)..." class="w-full border-2 border-gray-300 rounded-lg pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            
            <select name="status" onchange="this.form.submit()" class="border-2 border-gray-300 rounded-lg px-4 py-2.5 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-orange-500 bg-white">
                <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Semua Status</option>
                <option value="diajukan" {{ request('status') == 'diajukan' || !request('status') ? 'selected' : '' }}>Pending</option>
                <option value="disetujui_wali" {{ request('status') == 'disetujui_wali' ? 'selected' : '' }}>Disetujui</option>
                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>

            <div class="text-sm font-semibold text-gray-700 bg-orange-50 px-4 py-2.5 rounded-lg border border-orange-200">
                Semester: {{ $activeSemester->nama_semester }}
            </div>
        </div>

        <div class="flex items-center gap-2">
            <button type="submit" class="bg-orange-600 text-white px-4 py-2.5 rounded-lg text-sm font-semibold hover:bg-orange-700 transition">
                Filter
            </button>
            @if(request()->anyFilled(['search', 'status']))
                <a href="{{ route('dosen.KRSMahasiswa') }}" class="text-gray-500 hover:text-gray-700 text-sm font-medium">Reset</a>
            @endif
        </div>
    </form>
</div>

{{-- Summary Stats --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-6">
    <div class="bg-gradient-to-br from-orange-500 to-orange-600 text-white p-5 rounded-xl shadow-lg">
        <div class="flex items-center justify-between mb-2">
            <p class="text-sm opacity-90">Pending Review</p>
            <svg class="w-6 h-6 opacity-75" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
            </svg>
        </div>
        <p class="text-4xl font-bold" id="stat-pending">{{ $stats['pending'] }}</p>
    </div>

    <div class="bg-gradient-to-br from-green-500 to-green-600 text-white p-5 rounded-xl shadow-lg">
        <div class="flex items-center justify-between mb-2">
            <p class="text-sm opacity-90">Disetujui</p>
            <svg class="w-6 h-6 opacity-75" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
        </div>
        <p class="text-4xl font-bold" id="stat-approved">{{ $stats['approved'] }}</p>
    </div>

    <div class="bg-gradient-to-br from-red-500 to-red-600 text-white p-5 rounded-xl shadow-lg">
        <div class="flex items-center justify-between mb-2">
            <p class="text-sm opacity-90">Ditolak</p>
            <svg class="w-6 h-6 opacity-75" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
            </svg>
        </div>
        <p class="text-4xl font-bold" id="stat-rejected">{{ $stats['rejected'] }}</p>
    </div>

    <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white p-5 rounded-xl shadow-lg">
        <div class="flex items-center justify-between mb-2">
            <p class="text-sm opacity-90">Total KRS</p>
            <svg class="w-6 h-6 opacity-75" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
            </svg>
        </div>
        <p class="text-4xl font-bold">{{ $stats['total'] }}</p>
    </div>
</div>

{{-- KRS List --}}
<div class="space-y-5" id="krs-list-container">
    @forelse($krsList as $krs)
    <div id="krs-card-{{ $krs->krs_id }}" class="krs-card bg-white rounded-2xl shadow-sm border-2 border-gray-200 hover:shadow-lg transition overflow-hidden">
        {{-- Header Card --}}
        <div class="bg-gradient-to-r from-orange-50 to-orange-100 p-5 border-b-2 border-orange-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg">
                        {{ strtoupper(substr($krs->mahasiswa->nama, 0, 1)) }}{{ strtoupper(substr(strrchr($krs->mahasiswa->nama, " "), 1, 1)) ?: '' }}
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">{{ $krs->mahasiswa->nama }}</h3>
                        <p class="text-sm text-gray-600">NIM: {{ $krs->mahasiswa->npm }} | {{ $krs->mahasiswa->prodi->nama_prodi }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $krs->semesterAjaran->nama_semester }}</p>
                    </div>
                </div>
                <div class="text-right">
                    @php
                        $statusBadge = [
                            'draft' => ['color' => 'bg-gray-500', 'text' => 'Draft'],
                            'diajukan' => ['color' => 'bg-orange-500', 'text' => 'Pending'],
                            'disetujui_wali' => ['color' => 'bg-green-500', 'text' => 'Disetujui'],
                            'ditolak' => ['color' => 'bg-red-500', 'text' => 'Ditolak'],
                            'final' => ['color' => 'bg-blue-600', 'text' => 'Final'],
                        ][$krs->status];
                    @endphp
                    <span class="px-4 py-2 {{ $statusBadge['color'] }} text-white rounded-full text-sm font-semibold inline-flex items-center gap-2 status-badge">
                        @if($krs->status == 'diajukan')
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                            </svg>
                        @endif
                        {{ $statusBadge['text'] }}
                    </span>
                    <p class="text-xs text-gray-500 mt-2">Diajukan: {{ $krs->tanggal_pengajuan ? \Carbon\Carbon::parse($krs->tanggal_pengajuan)->diffForHumans() : '-' }}</p>
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="p-6">
            {{-- KRS Summary --}}
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 text-center">
                    <p class="text-sm text-gray-600 mb-1">Total SKS</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $krs->total_sks }}</p>
                </div>
                <div class="bg-purple-50 border border-purple-200 rounded-xl p-4 text-center">
                    <p class="text-sm text-gray-600 mb-1">Mata Kuliah</p>
                    <p class="text-3xl font-bold text-purple-600">{{ $krs->details->count() }}</p>
                </div>
                <div class="bg-green-50 border border-green-200 rounded-xl p-4 text-center hidden md:block">
                    <p class="text-sm text-gray-600 mb-1">Semester</p>
                    <p class="text-3xl font-bold text-green-600">{{ $krs->mahasiswa->semester_sekarang }}</p>
                </div>
            </div>

            {{-- Mata Kuliah List Preview --}}
            <div class="mb-6">
                <div class="flex items-center justify-between mb-3">
                    <h4 class="font-bold text-gray-800">Daftar Mata Kuliah ({{ $krs->details->count() }} MK)</h4>
                    <button onclick="toggleDetail({{ $krs->krs_id }})" class="text-orange-600 hover:text-orange-700 font-semibold text-sm">
                        Lihat Detail →
                    </button>
                </div>
                
                {{-- Hidden Detail --}}
                <div id="detail-{{ $krs->krs_id }}" class="hidden space-y-2 bg-gray-50 rounded-lg p-4">
                    @foreach($krs->details as $detail)
                    <div class="flex items-center justify-between p-3 bg-white border border-gray-200 rounded-lg">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center">
                                <span class="text-indigo-600 font-bold text-xs">{{ $detail->kelas->matakuliah->sks }}</span>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-800">{{ $detail->kelas->matakuliah->nama_mk }}</p>
                                <p class="text-xs text-gray-500">{{ $detail->kelas->matakuliah->kode_mk }} | Kelas: {{ $detail->kelas->kode_kelas }}</p>
                            </div>
                        </div>
                        <span class="text-sm text-gray-600 font-medium">{{ $detail->kelas->matakuliah->sks }} SKS</span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Catatan Section --}}
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Catatan untuk Mahasiswa ({{ $krs->status == 'diajukan' ? 'Opsional' : 'Feedback' }})</label>
                <textarea id="notes-{{ $krs->krs_id }}" rows="3" 
                    {{ $krs->status != 'diajukan' ? 'disabled' : '' }}
                    class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 disabled:bg-gray-50 disabled:text-gray-600" 
                    placeholder="{{ $krs->status == 'diajukan' ? 'Tambahkan catatan atau saran untuk mahasiswa...' : 'Tidak ada catatan.' }}">{{ $krs->catatan }}</textarea>
            </div>

            {{-- Action Buttons --}}
            <div id="actions-{{ $krs->krs_id }}">
                @if($krs->status == 'diajukan')
                <div class="flex items-center gap-3">
                    <button onclick="approveKRS({{ $krs->krs_id }})" class="flex-1 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-6 py-3 rounded-xl font-semibold transition shadow-md flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Setujui KRS</span>
                    </button>

                    <button onclick="rejectKRS({{ $krs->krs_id }})" class="flex-1 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-6 py-3 rounded-xl font-semibold transition shadow-md flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Tolak KRS</span>
                    </button>
                </div>
                @else
                <div class="flex items-center justify-center p-3 bg-gray-50 rounded-xl border border-gray-200">
                    <p class="text-sm font-medium text-gray-500">KRS telah diproses pada {{ $krs->tanggal_validasi ? \Carbon\Carbon::parse($krs->tanggal_validasi)->translatedFormat('d F Y H:i') : '-' }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
    @empty
    <div class="bg-white rounded-2xl p-12 text-center border-2 border-dashed border-gray-300">
        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
        </svg>
        <h3 class="text-xl font-bold text-gray-800 mb-2">Tidak Ada Data</h3>
        <p class="text-gray-600">Tidak ditemukan pengajuan KRS yang sesuai dengan filter atau pencarian Anda.</p>
    </div>
    @endforelse
</div>

{{-- Pagination --}}
<div class="mt-6">
    {{ $krsList->appends(request()->query())->links() }}
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function toggleDetail(id) {
    const detail = document.getElementById('detail-' + id);
    detail.classList.toggle('hidden');
}

function approveKRS(id) {
    const notes = document.getElementById('notes-' + id).value;
    
    Swal.fire({
        title: 'Setujui KRS?',
        text: "KRS ini akan divalidasi dan mahasiswa dapat melanjutkan proses akademik.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#10B981',
        cancelButtonColor: '#6B7280',
        confirmButtonText: 'Ya, Setujui!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            performAction(id, 'approve', notes);
        }
    })
}

function rejectKRS(id) {
    const notes = document.getElementById('notes-' + id).value;
    
    if (!notes.trim()) {
        Swal.fire({
            title: 'Catatan Diperlukan',
            text: 'Silakan berikan alasan penolakan pada kolom catatan.',
            icon: 'warning',
            confirmButtonColor: '#F97316'
        });
        document.getElementById('notes-' + id).focus();
        return;
    }
    
    Swal.fire({
        title: 'Tolak KRS?',
        text: "Mahasiswa harus merevisi KRS mereka berdasarkan catatan Anda.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#EF4444',
        cancelButtonColor: '#6B7280',
        confirmButtonText: 'Ya, Tolak!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            performAction(id, 'reject', notes);
        }
    })
}

async function performAction(id, action, notes) {
    const url = action === 'approve' ? `/dosen/KRSMahasiswa/${id}/approve` : `/dosen/KRSMahasiswa/${id}/reject`;
    
    // Show loading
    Swal.fire({
        title: 'Memproses...',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading()
        }
    });

    const controller = new AbortController();
    const timeoutId = setTimeout(() => controller.abort(), 20000); // 20 detik timeout

    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ catatan: notes }),
            signal: controller.signal
        });

        clearTimeout(timeoutId);

        if (!response.ok) {
            const errorData = await response.json();
            throw new Error(errorData.message || 'Terjadi kesalahan sistem.');
        }

        const data = await response.json();
        
        if (data.message) {
            Swal.fire({
                title: 'Berhasil!',
                text: data.message,
                icon: 'success',
                confirmButtonColor: '#F97316',
                timer: 800, // Reduced timer
                showConfirmButton: false
            });

            // PERFORMANCE OPTIMIZATION: Update UI immediately
            const card = document.getElementById('krs-card-' + id);
            const currentFilterStatus = new URLSearchParams(window.location.search).get('status') || 'diajukan';

            if (currentFilterStatus === 'all') {
                const badge = card.querySelector('.status-badge');
                const actions = document.getElementById('actions-' + id);
                const textArea = document.getElementById('notes-' + id);

                if (action === 'approve') {
                    badge.className = 'px-4 py-2 bg-green-500 text-white rounded-full text-sm font-semibold inline-flex items-center gap-2 status-badge';
                    badge.innerHTML = 'Disetujui';
                    updateStat('stat-approved', 1);
                } else {
                    badge.className = 'px-4 py-2 bg-red-500 text-white rounded-full text-sm font-semibold inline-flex items-center gap-2 status-badge';
                    badge.innerHTML = 'Ditolak';
                    updateStat('stat-rejected', 1);
                }
                
                updateStat('stat-pending', -1);
                textArea.disabled = true;
                textArea.classList.add('bg-gray-50', 'text-gray-600');
                actions.innerHTML = `<div class="flex items-center justify-center p-3 bg-gray-50 rounded-xl border border-gray-200"><p class="text-sm font-medium text-gray-500">Baru saja diproses</p></div>`;
            } else {
                // Instantly remove card with animation
                card.style.transition = 'all 0.3s ease'; // Faster transition
                card.style.opacity = '0';
                card.style.transform = 'scale(0.95)';
                
                setTimeout(() => {
                    card.remove();
                    updateStat('stat-pending', -1);
                    if (action === 'approve') updateStat('stat-approved', 1);
                    else updateStat('stat-rejected', 1);

                    if (document.querySelectorAll('.krs-card').length === 0) {
                        window.location.reload();
                    }
                }, 300);
            }
        }
    } catch (error) {
        clearTimeout(timeoutId);
        console.error('Error:', error);
        
        let msg = 'Terjadi kesalahan sistem.';
        if (error.name === 'AbortError') {
            msg = 'Koneksi timeout (20 detik). Server tidak merespons tepat waktu.';
        } else {
            msg = error.message;
        }

        Swal.fire({
            title: 'Gagal!',
            text: msg,
            icon: 'error',
            confirmButtonColor: '#F97316'
        });
    }
}

function updateStat(id, change) {
    const el = document.getElementById(id);
    if (el) {
        el.innerText = parseInt(el.innerText) + change;
    }
}
</script>
@endpush