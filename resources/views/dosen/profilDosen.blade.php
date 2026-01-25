@extends('layouts.app')

@section('content')

@if(session('success'))
    <div class="mb-4 flex items-center gap-3 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-xl shadow-sm animate-fade-in">
        <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
        </svg>
        <span class="text-sm font-bold text-green-800">{{ session('success') }}</span>
    </div>
@endif

@if($errors->any())
    <div class="mb-4 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-xl shadow-sm">
        <ul class="list-disc list-inside text-xs text-red-700 font-medium">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form id="profile-form" action="{{ route('dosen.profilDosen.update') }}" method="POST" enctype="multipart/form-data">
    @csrf

<div class="mb-8 rounded-[2rem] bg-gradient-to-r from-[#1F653F] via-[#2F8054] to-[#47AF76] p-8 text-white relative overflow-hidden shadow-lg">
    {{-- Decorative Dots Pattern (Right Bottom) --}}
    <div class="absolute right-0 bottom-0 p-8 opacity-30 pointer-events-none">
         <div class="grid grid-cols-6 gap-3">
            @for($i=0; $i<24; $i++)
                <div class="h-1.5 w-1.5 rounded-full bg-white/60"></div>
            @endfor
        </div>
    </div>

    <div class="relative z-10 flex flex-col md:flex-row items-center gap-8">
        {{-- Profile Image --}}
        <div class="flex-shrink-0 group relative">
            <div class="h-48 w-48 rounded-[1.5rem] border border-white/40 bg-white/5 flex flex-col items-center justify-center backdrop-blur-sm relative shadow-2xl overflow-hidden">
                @if($dosen->foto)
                    <img id="profile-preview" src="{{ asset('storage/' . $dosen->foto) }}" class="h-full w-full object-cover">
                @else
                    <div id="profile-placeholder" class="flex flex-col items-center justify-center">
                        <div class="rounded-full border border-white/50 p-4 mb-2">
                            <svg class="h-12 w-12 text-white/90" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-white/90 tracking-widest uppercase">{{ $dosen->nip }}</span>
                    </div>
                @endif
                
                {{-- Only visible in edit mode --}}
                <div id="photo-overlay" class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center cursor-pointer hidden">
                    <svg class="h-8 w-8 text-white mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="text-[10px] font-bold text-white uppercase tracking-wider">Ubah Foto</span>
                </div>
                <input type="file" name="foto" id="foto-input" class="hidden" accept="image/*" onchange="previewPhoto(this)">
            </div>
        </div>

        {{-- Profile Info --}}
        <div class="flex-1 text-center md:text-left">
            <h1 class="text-[2rem] font-bold uppercase tracking-tight leading-none mb-2">{{ ($dosen->gelar_depan ? $dosen->gelar_depan.' ' : '').$dosen->nama.($dosen->gelar_belakang ? ', '.$dosen->gelar_belakang : '') }}</h1>
            <p class="text-xl font-medium text-white/80 mb-6">{{ $dosen->jabatan ?? '-' }} - {{ $dosen->status_kepegawaian ?? '-' }}</p>
            
            <div class="flex flex-wrap items-center justify-center md:justify-start gap-x-8 gap-y-3 text-sm font-semibold text-white/90 mb-8">
                <div class="flex items-center gap-2.5 bg-white/10 px-4 py-2 rounded-full backdrop-blur-md">
                    <svg class="h-5 w-5 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>Medan</span>
                </div>
                 <div class="flex items-center gap-2.5 bg-white/10 px-4 py-2 rounded-full backdrop-blur-md">
                    <svg class="h-5 w-5 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>15 Mei 1980</span>
                </div>
                <!-- Status Keaktifan Badge -->
                <div class="flex items-center gap-2.5 bg-green-400/20 px-4 py-2 rounded-full backdrop-blur-md border border-green-300/30">
                    <svg class="h-5 w-5 text-green-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-green-100">{{ $dosen->status_dosen ?? 'Aktif' }}</span>
                </div>
            </div>

            <div class="flex flex-wrap items-center justify-center md:justify-start gap-4">
                <button type="button" onclick="enableEditing()" class="flex items-center gap-2 bg-white text-[#2E7D55] px-6 py-3 rounded-xl font-bold text-sm hover:scale-105 transition-all shadow-lg active:scale-95">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    Edit Profil
                </button>
                <button type="button" onclick="showPasswordModal()" class="flex items-center gap-2 bg-[#1F653F] border border-white/30 text-white px-6 py-3 rounded-xl font-bold text-sm hover:bg-[#1B5937] transition-all shadow-lg active:scale-95">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    Ubah Password
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Tab Navigation --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-2 mb-8">
    <div class="flex items-center justify-between gap-2 overflow-x-auto pb-2 md:pb-0">
        <button type="button" onclick="showTab('personal')" id="tab-personal" class="flex-1 min-w-[120px] px-4 md:px-6 py-3 rounded-xl text-sm font-bold text-gray-400 hover:text-gray-600 transition-all duration-300">
            Data Personal
        </button>
        <button type="button" onclick="showTab('kontak')" id="tab-kontak" class="flex-1 min-w-[120px] px-4 md:px-6 py-3 rounded-xl text-sm font-bold text-gray-400 hover:text-gray-600 transition-all duration-300">
            Alamat & Kontak
        </button>
        <button type="button" onclick="showTab('akademik')" id="tab-akademik" class="flex-1 min-w-[120px] px-4 md:px-6 py-3 rounded-xl text-sm font-bold text-gray-400 hover:text-gray-600 transition-all duration-300">
            Pendidikan
        </button>
        <button type="button" onclick="showTab('kepegawaian')" id="tab-kepegawaian" class="flex-1 min-w-[120px] px-4 md:px-6 py-3 rounded-xl text-sm font-bold text-gray-400 hover:text-gray-600 transition-all duration-300">
            Kepegawaian
        </button>
    </div>
</div>

{{-- Tab Content --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
    
    {{-- Tab 1: Data Personal --}}
    <div id="content-personal" class="tab-content">
        <div class="flex items-center gap-2 mb-6">
            <svg class="w-5 h-5 text-[#2F8054]" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
            </svg>
            <h2 class="text-lg font-bold text-gray-800">Informasi Personal</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">NIDN</label>
                <div class="text-base font-bold text-gray-400 border-b border-gray-100 pb-2 bg-gray-50/50 cursor-not-allowed">{{ $dosen->nip }}</div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Nama Lengkap</label>
                <input type="text" name="nama" value="{{ old('nama', $dosen->nama) }}" class="editable-input w-full text-base font-bold text-gray-800 border-b border-gray-100 pb-2 focus:outline-none focus:border-[#2F8054] transition-colors bg-transparent" readonly>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Gelar Depan</label>
                <input type="text" name="gelar_depan" value="{{ old('gelar_depan', $dosen->gelar_depan) }}" class="editable-input w-full text-base font-bold text-gray-800 border-b border-gray-100 pb-2 focus:outline-none focus:border-[#2F8054] transition-colors bg-transparent" readonly>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Gelar Belakang</label>
                <input type="text" name="gelar_belakang" value="{{ old('gelar_belakang', $dosen->gelar_belakang) }}" class="editable-input w-full text-base font-bold text-gray-800 border-b border-gray-100 pb-2 focus:outline-none focus:border-[#2F8054] transition-colors bg-transparent" readonly>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $dosen->tempat_lahir) }}" class="editable-input w-full text-base font-bold text-gray-800 border-b border-gray-100 pb-2 focus:outline-none focus:border-[#2F8054] transition-colors bg-transparent" readonly>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $dosen->tanggal_lahir) }}" class="editable-input w-full text-base font-bold text-gray-800 border-b border-gray-100 pb-2 focus:outline-none focus:border-[#2F8054] transition-colors bg-transparent" readonly>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="editable-input w-full text-base font-bold text-gray-800 border-b border-gray-100 pb-2 focus:outline-none focus:border-[#2F8054] transition-colors bg-transparent h-10" disabled>
                    <option value="L" {{ $dosen->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ $dosen->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Agama</label>
                <input type="text" name="agama" value="{{ old('agama', $dosen->agama) }}" class="editable-input w-full text-base font-bold text-gray-800 border-b border-gray-100 pb-2 focus:outline-none focus:border-[#2F8054] transition-colors bg-transparent" readonly>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Status Perkawinan</label>
                <select name="status_perkawinan" class="editable-input w-full text-base font-bold text-gray-800 border-b border-gray-100 pb-2 focus:outline-none focus:border-[#2F8054] transition-colors bg-transparent h-10" disabled>
                    <option value="Menikah" {{ $dosen->status_perkawinan == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                    <option value="Belum Menikah" {{ $dosen->status_perkawinan == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                    <option value="Janda/Duda" {{ $dosen->status_perkawinan == 'Janda/Duda' ? 'selected' : '' }}>Janda/Duda</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Tab 2: Alamat & Kontak --}}
    <div id="content-kontak" class="tab-content hidden">
        <div class="flex items-center gap-2 mb-6">
            <svg class="w-5 h-5 text-[#2F8054]" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
            </svg>
            <h2 class="text-lg font-bold text-gray-800">Alamat & Kontak</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="md:col-span-2">
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Alamat Lengkap</label>
                <textarea name="alamat_detail" rows="2" class="editable-input w-full text-base font-bold text-gray-800 border-b border-gray-100 pb-2 focus:outline-none focus:border-[#2F8054] transition-colors bg-transparent resize-none" readonly>{{ old('alamat_detail', $dosen->alamat_detail) }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Program Studi</label>
                <div class="text-base font-bold text-gray-800 border-b border-gray-100 pb-2">{{ $dosen->prodi->nama_prodi ?? '-' }}</div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Email Akumulasi</label>
                <div class="text-base font-bold text-gray-400 border-b border-gray-100 pb-2 bg-gray-50/50 cursor-not-allowed">{{ $user->email }}</div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Telepon / HP</label>
                <input type="text" name="no_hp" value="{{ old('no_hp', $dosen->no_hp) }}" class="editable-input w-full text-base font-bold text-gray-800 border-b border-gray-100 pb-2 focus:outline-none focus:border-[#2F8054] transition-colors bg-transparent" readonly>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Provinsi</label>
                <input type="text" name="provinsi" value="Sumatera Utara" class="editable-input w-full text-base font-bold text-gray-800 border-b border-gray-100 pb-2 focus:outline-none focus:border-[#2F8054] transition-colors bg-transparent" readonly>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Kabupaten/Kota</label>
                <input type="text" name="kabupaten" value="Medan" class="editable-input w-full text-base font-bold text-gray-800 border-b border-gray-100 pb-2 focus:outline-none focus:border-[#2F8054] transition-colors bg-transparent" readonly>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Kecamatan</label>
                <input type="text" name="kecamatan" value="Medan Petisah" class="editable-input w-full text-base font-bold text-gray-800 border-b border-gray-100 pb-2 focus:outline-none focus:border-[#2F8054] transition-colors bg-transparent" readonly>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Kelurahan</label>
                <input type="text" name="kelurahan" value="Sekip" class="editable-input w-full text-base font-bold text-gray-800 border-b border-gray-100 pb-2 focus:outline-none focus:border-[#2F8054] transition-colors bg-transparent" readonly>
            </div>
        </div>
    </div>

    {{-- Tab 3: Pendidikan --}}
    <div id="content-akademik" class="tab-content hidden">
        <div class="flex items-center gap-2 mb-6">
            <svg class="w-5 h-5 text-[#2F8054]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M12 14l9-5-9-5-9 5 9 5z" />
                <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
            </svg>
            <h2 class="text-lg font-bold text-gray-800">Riwayat Pendidikan & Keahlian</h2>
        </div>

        <div class="space-y-6">
             {{-- Card like style for education --}}
            <div class="bg-gray-50 border border-gray-200 rounded-xl p-6">
                 <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Pendidikan Terakhir</label>
                        <input type="text" name="pendidikan_terakhir" value="S3" class="editable-input w-full text-base font-bold text-gray-800 border-b border-gray-100 pb-2 focus:outline-none focus:border-[#2F8054] transition-colors bg-transparent" readonly>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Tahun Lulus</label>
                        <input type="text" name="tahun_lulus" value="2015" class="editable-input w-full text-base font-bold text-gray-800 border-b border-gray-100 pb-2 focus:outline-none focus:border-[#2F8054] transition-colors bg-transparent" readonly>
                    </div>

                     <div class="md:col-span-2">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">S1 (Gelar - Prodi - Kampus)</label>
                        <div class="text-base font-bold text-gray-800 border-b border-gray-100 pb-2">{{ $dosen->s1_gelar }} - {{ $dosen->s1_prodi }} ({{ $dosen->s1_univ }} - {{ $dosen->s1_tahun }})</div>
                    </div>
                     <div class="md:col-span-2">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">S2 (Gelar - Prodi - Kampus)</label>
                        <div class="text-base font-bold text-gray-800 border-b border-gray-100 pb-2">{{ $dosen->s2_gelar }} - {{ $dosen->s2_prodi }} ({{ $dosen->s2_univ }} - {{ $dosen->s2_tahun }})</div>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Bidang Keahlian</label>
                <div class="flex flex-wrap gap-2">
                    @foreach(explode(',', $dosen->bidang_keahlian) as $expert)
                        <span class="bg-[#1F653F]/10 text-[#1F653F] px-4 py-2 rounded-lg text-sm font-bold border border-[#1F653F]/20">{{ trim($expert) }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Tab 4: Kepegawaian --}}
    <div id="content-kepegawaian" class="tab-content hidden">
        <div class="flex items-center gap-2 mb-6">
            <svg class="w-5 h-5 text-[#2F8054]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            <h2 class="text-lg font-bold text-gray-800">Status Kepegawaian</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Status Dosen</label>
                <div class="text-base font-bold text-[#2E7D55] bg-green-50 px-3 py-1.5 rounded-lg inline-block border border-green-100">{{ $dosen->status_dosen }}</div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Status Keaktifan</label>
                 <div class="text-base font-bold text-blue-600 bg-blue-50 px-3 py-1.5 rounded-lg inline-block border border-blue-100">{{ $dosen->status_kepegawaian }}</div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Jabatan Fungsional</label>
                <div class="text-base font-bold text-gray-800 border-b border-gray-100 pb-2">{{ $dosen->jabatan }}</div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Tanggal Mulai Kerja</label>
                <div class="text-base font-bold text-gray-800 border-b border-gray-100 pb-2">{{ $dosen->tanggal_mulai }}</div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">No. Sertifikat Pendidik</label>
                <div class="text-base font-bold text-gray-800 border-b border-gray-100 pb-2">{{ $dosen->no_sertifikat ?? '-' }}</div>
            </div>
        </div>
    </div>

</div>

</form>

<div id="edit-actions" class="hidden flex items-center justify-end gap-3 mt-6 pb-6">
    <button type="button" onclick="window.location.reload()" class="px-6 py-2.5 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
        <span>Batal</span>
    </button>
    <button type="submit" form="profile-form" class="px-6 py-2.5 bg-[#1B5937] hover:bg-green-700 text-white rounded-lg font-semibold transition shadow-sm flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
        </svg>
        <span>Simpan Perubahan</span>
    </button>
</div>

{{-- Password Modal --}}
<div id="password-modal" class="fixed inset-0 z-[60] hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity" onclick="closePasswordModal()"></div>
        
        <div class="relative bg-white rounded-[2rem] shadow-2xl w-full max-w-md overflow-hidden transform transition-all">
            <div class="bg-gradient-to-r from-[#1F653F] to-[#2F8054] p-6 text-white relative">
                <h3 class="text-xl font-bold">Ubah Kata Sandi</h3>
                <p class="text-white/70 text-sm">Ganti kata sandi Anda secara berkala untuk keamanan.</p>
                <button onclick="closePasswordModal()" class="absolute right-6 top-6 text-white/50 hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <form action="{{ route('dosen.profilDosen.password') }}" method="POST" class="p-8">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Kata Sandi Saat Ini</label>
                        <input type="password" name="current_password" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#2F8054] focus:ring-0 transition-all font-bold text-gray-700">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Kata Sandi Baru</label>
                        <input type="password" name="password" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#2F8054] focus:ring-0 transition-all font-bold text-gray-700">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Konfirmasi Kata Sandi Baru</label>
                        <input type="password" name="password_confirmation" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#2F8054] focus:ring-0 transition-all font-bold text-gray-700">
                    </div>
                </div>
                
                <div class="mt-8 flex gap-3">
                    <button type="button" onclick="closePasswordModal()" class="flex-1 px-6 py-3 border-2 border-gray-100 text-gray-500 rounded-xl font-bold hover:bg-gray-50 transition-all">Batal</button>
                    <button type="submit" class="flex-1 px-6 py-3 bg-[#2E7D55] text-white rounded-xl font-bold shadow-lg hover:shadow-green-900/20 active:scale-95 transition-all">Update Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Set default tab
    showTab('personal');
});

function showTab(tabName) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });

    // Reset all tabs to inactive state
    document.querySelectorAll('[id^="tab-"]').forEach(tab => {
        // Remove active classes
        tab.classList.remove('bg-[#2E7D55]', 'text-white', 'shadow-md');
        // Add inactive classes
        tab.classList.add('text-gray-400', 'hover:text-gray-600');
    });

    // Show selected tab content
    document.getElementById('content-' + tabName).classList.remove('hidden');

    // Set active tab style
    const activeTab = document.getElementById('tab-' + tabName);
    // Remove inactive classes
    activeTab.classList.remove('text-gray-400', 'hover:text-gray-600');
    // Add active classes
    activeTab.classList.add('bg-[#2E7D55]', 'text-white', 'shadow-md');
}

function enableEditing() {
    const inputs = document.querySelectorAll('.editable-input');
    inputs.forEach(input => {
        input.removeAttribute('readonly');
        input.removeAttribute('disabled');
        input.classList.add('border-b-2', 'border-green-500', 'bg-green-50/10');
    });
    
    document.getElementById('edit-actions').classList.remove('hidden');
    document.getElementById('photo-overlay').classList.remove('hidden');
    
    // Smooth scroll to fields
    document.getElementById('content-personal').scrollIntoView({ behavior: 'smooth', block: 'center' });
}

function showPasswordModal() {
    document.getElementById('password-modal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closePasswordModal() {
    document.getElementById('password-modal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function previewPhoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            let preview = document.getElementById('profile-preview');
            let placeholder = document.getElementById('profile-placeholder');
            
            if (!preview) {
                preview = document.createElement('img');
                preview.id = 'profile-preview';
                preview.className = 'h-full w-full object-cover';
                placeholder.parentNode.prepend(preview);
                placeholder.classList.add('hidden');
            }
            preview.src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// Add event listener for photo overlay
document.getElementById('photo-overlay').addEventListener('click', () => {
    document.getElementById('foto-input').click();
});
</script>
<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fade-in 0.3s ease-out forwards;
    }
</style>
@endpush
