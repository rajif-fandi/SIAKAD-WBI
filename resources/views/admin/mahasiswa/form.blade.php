@extends('layouts.app')

@section('content')

{{-- Header --}}
<div class="mb-6">
    <div class="flex items-center gap-3">
        <a href="#" class="w-10 h-10 bg-gray-100 hover:bg-gray-200 rounded-lg flex items-center justify-center transition">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <div>
            <h1 class="text-3xl font-bold text-gray-800">{{ isset($mahasiswa) ? 'Edit Mahasiswa' : 'Form Mahasiswa' }}</h1>
            <p class="text-gray-600">{{ isset($mahasiswa) ? 'Update data biodata mahasiswa' : 'Lengkapi biodata mahasiswa dengan teliti' }}</p>
        </div>
    </div>
</div>

{{-- Tab Navigation --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6 overflow-hidden">
    <div class="flex border-b border-gray-200">
        <button onclick="showTab('pribadi')" id="tab-pribadi" class="flex-1 px-6 py-4 text-sm font-semibold text-white bg-blue-600 transition flex items-center justify-center gap-2">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
            </svg>
            Data Pribadi
        </button>
        <button onclick="showTab('keluarga')" id="tab-keluarga" class="flex-1 px-6 py-4 text-sm font-semibold text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition flex items-center justify-center gap-2">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
            </svg>
            Data Keluarga
        </button>
        <button onclick="showTab('alamat')" id="tab-alamat" class="flex-1 px-6 py-4 text-sm font-semibold text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition flex items-center justify-center gap-2">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
            </svg>
            Data Alamat
        </button>
        <button onclick="showTab('akademik')" id="tab-akademik" class="flex-1 px-6 py-4 text-sm font-semibold text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition flex items-center justify-center gap-2">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"></path>
            </svg>
            Data Akademik
        </button>
    </div>
</div>

<form id="mahasiswaForm" action="{{ isset($mahasiswa) ? route('admin.mahasiswa.update', $mahasiswa->mahasiswa_id) : route('admin.mahasiswa.store') }}" method="POST">
    @csrf
    @if(isset($mahasiswa))
        @method('PUT')
    @endif
    {{-- Tab 1: Data Pribadi --}}
    <div id="content-pribadi" class="tab-content">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                Informasi Pribadi
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">NPM <span class="text-red-500">*</span></label>
                    <input type="text" name="npm" value="{{ old('npm', $mahasiswa->npm ?? '') }}" required class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <p class="text-xs text-blue-600 mt-1 font-medium italic">Login: [NPM]@wbi.ac.id</p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" value="{{ old('nama', $mahasiswa->nama ?? '') }}" required class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">NIK</label>
                    <input type="text" name="nik" value="{{ old('nik', $mahasiswa->nik ?? '') }}" maxlength="16" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <p class="text-xs text-gray-500 mt-1">16 digit</p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                    <select name="jenis_kelamin" required class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L" {{ (old('jenis_kelamin', $mahasiswa->jenis_kelamin ?? '') == 'L') ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ (old('jenis_kelamin', $mahasiswa->jenis_kelamin ?? '') == 'P') ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $mahasiswa->tempat_lahir ?? '') }}" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $mahasiswa->tanggal_lahir ?? '') }}" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Agama</label>
                    <select name="agama" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                        <option value="">Pilih Agama</option>
                        <option {{ old('agama', $mahasiswa->agama ?? '') == 'Islam' ? 'selected' : '' }}>Islam</option>
                        <option {{ old('agama', $mahasiswa->agama ?? '') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                        <option {{ old('agama', $mahasiswa->agama ?? '') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                        <option {{ old('agama', $mahasiswa->agama ?? '') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                        <option {{ old('agama', $mahasiswa->agama ?? '') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                        <option {{ old('agama', $mahasiswa->agama ?? '') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kewarganegaraan</label>
                    <select name="kewarganegaraan" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                        <option {{ old('kewarganegaraan', $mahasiswa->kewarganegaraan ?? 'Indonesia') == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                        <option {{ old('kewarganegaraan', $mahasiswa->kewarganegaraan ?? '') == 'Asing' ? 'selected' : '' }}>Asing</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">No. Telepon</label>
                    <input type="tel" name="no_telp" value="{{ old('no_telp', $mahasiswa->no_hp ?? '') }}" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email Pribadi <span class="text-red-500">*</span></label>
                    <input type="email" name="email" value="{{ old('email', $mahasiswa->email_pribadi ?? $mahasiswa->user->email ?? '') }}" required {{ isset($mahasiswa) ? 'readonly bg-gray-50' : '' }} class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Mahasiswa</label>
                    <input type="file" name="foto" accept="image/*" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <p class="text-xs text-gray-500 mt-1">Max 2MB, format: JPG, PNG</p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Password <span class="text-xs font-normal text-gray-500">(Opsional)</span></label>
                    <input type="password" name="password" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <p class="text-xs text-blue-600 mt-1 font-medium italic">
                        {{ isset($mahasiswa) ? 'Biarkan kosong jika tidak ingin mengubah password.' : 'Default: 12345678 jika tidak diisi.' }}
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Status Pernikahan</label>
                    <select name="status_nikah" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                        <option>Belum Menikah</option>
                        <option>Menikah</option>
                        <option>Cerai</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    {{-- Tab 2: Data Keluarga --}}
    <div id="content-keluarga" class="tab-content hidden">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                    </svg>
                </div>
                Informasi Keluarga
            </h3>

            <div class="space-y-6">
                {{-- Data Ayah --}}
                <div>
                    <h4 class="font-semibold text-gray-700 mb-4 pb-2 border-b">Data Ayah</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Ayah</label>
                            <input type="text" name="nama_ayah" value="{{ old('nama_ayah', $mahasiswa->nama_ayah ?? '') }}" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Pekerjaan Ayah</label>
                            <input type="text" name="pekerjaan_ayah" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Pendidikan Ayah</label>
                            <select name="pendidikan_ayah" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                                <option value="">Pilih Pendidikan</option>
                                <option>SD</option>
                                <option>SMP</option>
                                <option>SMA</option>
                                <option>D3</option>
                                <option>S1</option>
                                <option>S2</option>
                                <option>S3</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Penghasilan Ayah</label>
                            <select name="penghasilan_ayah" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                                <option value="">Pilih Range</option>
                                <option>< Rp 1.000.000</option>
                                <option>Rp 1.000.000 - Rp 3.000.000</option>
                                <option>Rp 3.000.000 - Rp 5.000.000</option>
                                <option>> Rp 5.000.000</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Data Ibu --}}
                <div>
                    <h4 class="font-semibold text-gray-700 mb-4 pb-2 border-b">Data Ibu</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Ibu Kandung</label>
                            <input type="text" name="nama_ibu" value="{{ old('nama_ibu', $mahasiswa->nama_ibu ?? '') }}" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Pekerjaan Ibu</label>
                            <input type="text" name="pekerjaan_ibu" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Pendidikan Ibu</label>
                            <select name="pendidikan_ibu" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                                <option value="">Pilih Pendidikan</option>
                                <option>SD</option>
                                <option>SMP</option>
                                <option>SMA</option>
                                <option>D3</option>
                                <option>S1</option>
                                <option>S2</option>
                                <option>S3</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Penghasilan Ibu</label>
                            <select name="penghasilan_ibu" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                                <option value="">Pilih Range</option>
                                <option>< Rp 1.000.000</option>
                                <option>Rp 1.000.000 - Rp 3.000.000</option>
                                <option>Rp 3.000.000 - Rp 5.000.000</option>
                                <option>> Rp 5.000.000</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Data Wali --}}
                <div>
                    <h4 class="font-semibold text-gray-700 mb-4 pb-2 border-b">Data Wali (Jika Ada)</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Wali</label>
                            <input type="text" name="nama_wali" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">No. Telepon Wali</label>
                            <input type="tel" name="telp_wali" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tab 3: Data Alamat --}}
    <div id="content-alamat" class="tab-content hidden">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                Informasi Alamat
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Lengkap</label>
                    <textarea name="alamat" rows="3" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('alamat', $mahasiswa->alamat_detail ?? '') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">RT</label>
                    <input type="text" name="rt" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">RW</label>
                    <input type="text" name="rw" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Provinsi</label>
                    <select name="provinsi" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                        <option value="">Pilih Provinsi</option>
                        <option>Sumatera Utara</option>
                        <option>DKI Jakarta</option>
                        <option>Jawa Barat</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kabupaten/Kota</label>
                    <select name="kabupaten" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                        <option value="">Pilih Kabupaten/Kota</option>
                        <option>Medan</option>
                        <option>Deli Serdang</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kecamatan</label>
                    <input type="text" name="kecamatan" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kelurahan/Desa</label>
                    <input type="text" name="kelurahan" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kode Pos</label>
                    <input type="text" name="kode_pos" maxlength="5" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Tinggal</label>
                    <select name="jenis_tinggal" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                        <option>Bersama Orang Tua</option>
                        <option>Kost</option>
                        <option>Asrama</option>
                        <option>Rumah Sendiri</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    {{-- Tab 4: Data Akademik --}}
    <div id="content-akademik" class="tab-content hidden">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"></path>
                    </svg>
                </div>
                Informasi Akademik
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Program Studi <span class="text-red-500">*</span></label>
                    <select name="prodi_id" required class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                        <option value="">Pilih Program Studi</option>
                        @foreach($prodis as $prodi)
                            <option value="{{ $prodi->prodi_id }}" {{ (old('prodi_id', $mahasiswa->prodi_id ?? '') == $prodi->prodi_id) ? 'selected' : '' }}>{{ $prodi->nama_prodi }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Angkatan <span class="text-red-500">*</span></label>
                    <select name="angkatan" required class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                        <option value="">Pilih Angkatan</option>
                        @for($year = date('Y') + 1; $year >= 2020; $year--)
                            <option value="{{ $year }}" {{ (old('angkatan', $mahasiswa->angkatan ?? '') == $year) ? 'selected' : '' }}>{{ $year }}</option>
                        @endfor
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jalur Masuk</label>
                    <select name="jalur_masuk" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                        <option>SNBP</option>
                        <option>SNBT</option>
                        <option>Mandiri</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Dosen Pembimbing Akademik</label>
                    <select name="dosen_wali_id" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                        <option value="">Pilih Dosen PA</option>
                        @foreach($dosens as $dosen)
                            <option value="{{ $dosen->dosen_id }}" {{ (old('dosen_wali_id', $mahasiswa->dosen_wali_id ?? '') == $dosen->dosen_id) ? 'selected' : '' }}>{{ $dosen->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Status Mahasiswa</label>
                    <select name="status" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                        @foreach(['Aktif', 'Cuti', 'Non-Aktif', 'Lulus', 'Keluar', 'DO'] as $st)
                            <option value="{{ $st }}" {{ (old('status', $mahasiswa->status ?? 'Aktif') == $st) ? 'selected' : '' }}>{{ $st }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Masuk</label>
                    <input type="date" name="tanggal_masuk" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="flex items-center justify-end gap-3 mb-6">
        <a href="{{ route('admin.mahasiswa.mahasiswa') }}" class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition">
            Batal
        </a>
        <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-xl font-semibold transition shadow-lg">
            {{ isset($mahasiswa) ? 'Update Data Mahasiswa' : 'Simpan Data Mahasiswa' }}
        </button>
    </div>
</form>

@endsection

@push('scripts')
<script>
function showTab(tabName) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });

    // Remove active class from all tabs
    document.querySelectorAll('[id^="tab-"]').forEach(tab => {
        tab.classList.remove('bg-blue-600', 'text-white');
        tab.classList.add('text-gray-600', 'hover:text-gray-900', 'hover:bg-gray-50');
    });

    // Show selected tab content
    document.getElementById('content-' + tabName).classList.remove('hidden');

    // Add active class to selected tab
    const activeTab = document.getElementById('tab-' + tabName);
    activeTab.classList.add('bg-blue-600', 'text-white');
    activeTab.classList.remove('text-gray-600', 'hover:text-gray-900', 'hover:bg-gray-50');
}

// Form submission removed, using standard form POST
</script>
@endpush