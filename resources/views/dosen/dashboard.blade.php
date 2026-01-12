@extends('layouts.app')

@section('content')

{{-- Welcome Section --}}
<div class="relative mb-8 overflow-hidden rounded-3xl bg-gradient-to-r from-[#2E7D55] to-[#1F653F] p-8 text-white shadow-lg">
    <div class="relative z-10 flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-bold mb-2">Selamat Datang Kembali!</h2>
            <p class="text-[#ffffff] text-lg mb-1">{{ $dosen->nama }}</p>
            <p class="text-[#ffffff]">NIDN/NIP: {{ $dosen->nip }} • Program Studi {{ $dosen->prodi->nama_prodi ?? '-' }}</p>
        </div>
        <div class="text-right">
            <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-xl p-4 mb-2">
                <p class="text-sm opacity-90">Semester Aktif</p>
                <p class="text-2xl font-bold">{{ $activeSemester->nama_semester ?? '-' }}</p>
            </div>
            <p class="text-sm text-[#ffffff]">{{ now()->translatedFormat('l, d F Y') }}</p>
        </div>
    </div>
    <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -mr-32 -mt-32"></div>
    <div class="absolute bottom-0 left-0 w-48 h-48 bg-white opacity-5 rounded-full -ml-24 -mb-24"></div>
</div>

{{-- Quick Stats --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-6">
    {{-- Total Mata Kuliah --}}
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white p-6 rounded-2xl shadow-lg relative overflow-hidden">
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-3">
                <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-sm opacity-90 mb-1">Mata Kuliah</p>
            <p class="text-4xl font-bold">{{ $totalMatkul }}</p>
            <p class="text-xs opacity-75 mt-1">Diampu semester ini</p>
        </div>
        <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-white opacity-10 rounded-full"></div>
    </div>

    {{-- Total Mahasiswa --}}
    <div class="bg-gradient-to-br from-green-500 to-green-600 text-white p-6 rounded-2xl shadow-lg relative overflow-hidden">
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-3">
                <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-sm opacity-90 mb-1">Total Mahasiswa</p>
            <p class="text-4xl font-bold">{{ $totalBimbingan }}</p>
            <p class="text-xs opacity-75 mt-1">Mahasiswa bimbingan</p>
        </div>
        <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-white opacity-10 rounded-full"></div>
    </div>

    {{-- KRS Pending --}}
    <div class="bg-gradient-to-br from-orange-500 to-orange-600 text-white p-6 rounded-2xl shadow-lg relative overflow-hidden">
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-3">
                <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
            <p class="text-sm opacity-90 mb-1">KRS Pending</p>
            <p class="text-4xl font-bold">{{ $krsPendingCount }}</p>
            <p class="text-xs opacity-75 mt-1">Menunggu approval</p>
        </div>
        <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-white opacity-10 rounded-full"></div>
    </div>

    {{-- Total Kelas --}}
    <div class="bg-gradient-to-br from-red-500 to-red-600 text-white p-6 rounded-2xl shadow-lg relative overflow-hidden">
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-3">
                <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
            <p class="text-sm opacity-90 mb-1">Total Kelas</p>
            <p class="text-4xl font-bold">{{ $totalKelas }}</p>
            <p class="text-xs opacity-75 mt-1">Kelas aktif</p>
        </div>
        <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-white opacity-10 rounded-full"></div>
    </div>
</div>

{{-- Main Content Grid --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    {{-- Jadwal Hari Ini --}}
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Jadwal Mengajar Hari Ini</h3>
                    <p class="text-sm text-gray-500">{{ now()->translatedFormat('l, d F Y') }}</p>
                </div>
                <a href="{{ route('dosen.jadwal') }}" class="text-sm text-indigo-600 hover:text-indigo-700 font-semibold">
                    Lihat Semua →
                </a>
            </div>
        </div>
        <div class="p-6">
            @if($todaySchedules->count() > 0)
                <div class="space-y-4">
                    @foreach($todaySchedules as $schedule)
                    @php
                        $colors = ['blue', 'green', 'purple', 'orange', 'red'];
                        $color = $colors[$loop->index % count($colors)];
                    @endphp
                    <div class="border-l-4 border-{{ $color }}-500 bg-gradient-to-r from-{{ $color }}-50 to-white rounded-lg p-4 hover:shadow-md transition">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-{{ $color }}-500 rounded-lg flex items-center justify-center text-white font-bold">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800">{{ $schedule->kelas->matakuliah->nama_mk }}</h4>
                                    <p class="text-sm text-gray-600">{{ $schedule->kelas->kode_kelas }}</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 bg-{{ $color }}-100 text-{{ $color }}-700 rounded-full text-sm font-semibold">
                                {{ substr($schedule->jam_mulai, 0, 5) }} - {{ substr($schedule->jam_selesai, 0, 5) }}
                            </span>
                        </div>
                        <div class="flex items-center gap-4 text-sm text-gray-600">
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ $schedule->ruangan }}</span>
                            </div>
                            <button class="ml-auto text-indigo-600 hover:text-indigo-700 font-semibold text-sm">
                                Mulai Kelas →
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-dashed border-gray-200">
                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-500 font-medium">Tidak ada jadwal mengajar hari ini</p>
                    <p class="text-xs text-gray-400 mt-1">Selamat beristirahat atau persiapkan materi besok!</p>
                </div>
            @endif
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-800">Quick Actions</h3>
            <p class="text-sm text-gray-500">Akses cepat</p>
        </div>
        <div class="p-6">
            <div class="space-y-3">
                <a href="{{ route('dosen.jadwal') }}" class="flex items-center gap-3 p-4 bg-gradient-to-r from-blue-50 to-blue-100 border-2 border-blue-200 rounded-xl hover:shadow-md transition">
                    <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-gray-800 text-sm">Jadwal Mengajar</p>
                        <p class="text-xs text-gray-600">Lihat jadwal lengkap</p>
                    </div>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>

                <a href="{{ route('dosen.KRSMahasiswa') }}" class="flex items-center gap-3 p-4 bg-gradient-to-r from-orange-50 to-orange-100 border-2 border-orange-200 rounded-xl hover:shadow-md transition">
                    <div class="w-10 h-10 bg-orange-500 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-gray-800 text-sm">Review KRS</p>
                        <p class="text-xs text-gray-600">{{ $krsPendingCount }} pending approval</p>
                    </div>
                    @if($krsPendingCount > 0)
                        <span class="px-2 py-1 bg-orange-500 text-white rounded-full text-xs font-bold">{{ $krsPendingCount }}</span>
                    @endif
                </a>

                <a href="{{ route('dosen.penilaian') }}" class="flex items-center gap-3 p-4 bg-gradient-to-r from-green-50 to-green-100 border-2 border-green-200 rounded-xl hover:shadow-md transition">
                    <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-gray-800 text-sm">Input Nilai</p>
                        <p class="text-xs text-gray-600">{{ $totalKelas }} kelas aktif</p>
                    </div>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>

                <a href="{{ route('dosen.profilDosen') }}" class="flex items-center gap-3 p-4 bg-gradient-to-r from-purple-50 to-purple-100 border-2 border-purple-200 rounded-xl hover:shadow-md transition">
                    <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-gray-800 text-sm">Profil Saya</p>
                        <p class="text-xs text-gray-600">Update data personal</p>
                    </div>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>

{{-- Recent Activities & Notifications --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    {{-- Recent KRS Submissions --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-800">KRS Terbaru (Mahasiswa Bimbingan)</h3>
            <p class="text-sm text-gray-500">Pengajuan KRS mahasiswa bimbingan Anda</p>
        </div>
        <div class="p-6">
            @if($recentKrs->count() > 0)
                <div class="space-y-3">
                    @foreach($recentKrs as $krs)
                    <div class="flex items-center gap-4 p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                        <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-indigo-600 font-bold text-sm">{{ substr($krs->mahasiswa->nama, 0, 1) }}</span>
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold text-gray-800 text-sm">{{ $krs->mahasiswa->nama }}</p>
                            <p class="text-xs text-gray-500">{{ $krs->mahasiswa->npm }} • {{ $krs->created_at->diffForHumans() }}</p>
                        </div>
                        @if($krs->status == 'diajukan')
                            <span class="px-3 py-1 bg-orange-100 text-orange-700 rounded-full text-xs font-semibold">Diajukan</span>
                        @elseif($krs->status == 'disetujui_wali')
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Verified</span>
                        @else
                            <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-semibold">{{ ucfirst($krs->status) }}</span>
                        @endif
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <p class="text-sm text-gray-400 italic">Belum ada pengajuan KRS terbaru</p>
                </div>
            @endif
            <a href="{{ route('dosen.KRSMahasiswa') }}" class="block w-full mt-4 py-2 text-center text-indigo-600 hover:text-indigo-700 font-semibold text-sm">
                Lihat Semua KRS →
            </a>
        </div>
    </div>

    {{-- Announcements --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-800">Pengumuman Terkini</h3>
            <p class="text-sm text-gray-500">Update terbaru sistem akademik</p>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                <div class="border-l-4 border-blue-500 bg-blue-50 p-4 rounded-r-lg">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">Batas Input Nilai</p>
                            <p class="text-xs text-gray-600 mt-1">Deadline input nilai akhir semester adalah {{ now()->addWeeks(2)->translatedFormat('d F Y') }}</p>
                            <p class="text-xs text-gray-400 mt-2">Sistem • Admin Akademik</p>
                        </div>
                    </div>
                </div>

                <div class="border-l-4 border-green-500 bg-green-50 p-4 rounded-r-lg">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">Evaluasi Kurikulum 2024</p>
                            <p class="text-xs text-gray-600 mt-1">Rapat evaluasi kurikulum akan dilaksanakan secara hybrid di Ruang Rapat Utama.</p>
                            <p class="text-xs text-gray-400 mt-2">2 hari lalu • Prodi {{ $dosen->prodi->nama_prodi ?? '' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection