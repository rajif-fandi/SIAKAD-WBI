@extends('layouts.app')

@section('content')

{{-- Top Action Button --}}
<div class="mb-6">
    <button class="flex items-center gap-2 bg-[#1b4d36] hover:bg-[#153e2b] text-white px-6 py-2.5 rounded-lg font-bold shadow-sm transition">
        <span>Isi KRS</span>
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
    </button>
</div>

{{-- Filter & Search Bar --}}
<div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 mb-6 font-inter">
    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-3 w-full md:w-auto">
            {{-- Reload Button --}}
            <button class="flex items-center gap-2 bg-[#1b4d36] hover:bg-[#153e2b] text-white px-4 py-2 rounded-lg font-semibold text-sm transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                Reload
            </button>
            
            {{-- Records Select --}}
            <div class="relative">
                <select class="appearance-none bg-white border border-gray-300 text-gray-700 py-2 pl-3 pr-8 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-green-500 font-medium shadow-sm">
                    <option>10 records</option>
                    <option>25 records</option>
                    <option>50 records</option>
                    <option>100 records</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
            </div>
        </div>

        {{-- Search Input --}}
        <div class="relative w-full md:w-64">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-4 w-4 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <input type="text" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-green-500 focus:border-green-500 sm:text-sm shadow-sm" placeholder="Search...">
        </div>
    </div>
</div>

{{-- Content Cards --}}
<div class="space-y-6">
    @php
        $krsList = [
            [
                'number' => 1,
                'semester' => '2023/2024 Ganjil',
                'id_smt' => '20231',
                'status' => 'Final',
                'registrasi' => [
                    'hp' => 'Ada',
                    'hp_ortu' => '081234567890',
                    'alamat' => 'Hapesong Baru, Tapsel'
                ],
                'note' => [
                    'active' => true,
                    'user' => 'Septian Simatupang',
                    'text' => 'Perbaiki kembali SKS nya masih kurang',
                    'time' => '22-09-2023 10:30'
                ],
                'updated_at' => '22-09-2023 11:16'
            ],
            [
                'number' => 2,
                'semester' => '2023/2024 Genap',
                'id_smt' => '20232',
                'status' => 'Final',
                'registrasi' => [
                    'hp' => 'Ada',
                    'hp_ortu' => '081234567890',
                    'alamat' => 'Hapesong Baru, Tapsel'
                ],
                'note' => [
                    'active' => false
                ],
                'updated_at' => '22-09-2023 11:16'
            ]
        ];
    @endphp

    @foreach($krsList as $krs)
    <div class="bg-white rounded-lg shadow-sm overflow-hidden flex font-inter">
        {{-- Left Border Strip --}}
        <div class="w-1.5 bg-[#1b4d36] flex-shrink-0"></div>
        
        <div class="flex-1 p-0">
            {{-- Header --}}
            <div class="bg-[#e2f2e9] px-6 py-4 flex items-center justify-between border-b border-[#c8e6d5]">
                <div class="flex items-center gap-4">
                    <div class="w-8 h-8 rounded-full bg-[#1b4d36] text-white flex items-center justify-center font-bold text-sm shadow-sm">
                        {{ $krs['number'] }}
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-[#1b4d36]">{{ $krs['semester'] }}</h3>
                        <p class="text-xs text-gray-500 font-medium">ID SMT: {{ $krs['id_smt'] }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <span class="px-4 py-1 rounded-full border border-[#a5d6a7] bg-[#c8e6d5]/50 text-[#2e7d32] text-xs font-bold">
                        {{ $krs['status'] }}
                    </span>
                    <button class="flex items-center gap-1.5 bg-[#1b4d36] hover:bg-[#153e2b] text-white px-4 py-1.5 rounded-md text-xs font-bold transition shadow-sm">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        Lihat KRS
                    </button>
                </div>
            </div>

            <div class="p-6 space-y-6">
                {{-- Data Registrasi --}}
                <div>
                    <div class="flex items-center gap-2 mb-3 text-[#1b4d36]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <h4 class="text-xs font-bold uppercase tracking-wide">Data Registrasi</h4>
                    </div>
                    
                    <div class="bg-[#fcfdfd] p-3 rounded-md">
                        <div class="flex flex-wrap gap-3">
                            <div class="flex items-center gap-2 bg-white border border-gray-200 px-3 py-2 rounded-md shadow-sm">
                                <svg class="w-3.5 h-3.5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                <span class="text-xs font-medium text-gray-600">Handphone: {{ $krs['registrasi']['hp'] }}</span>
                            </div>
                            <div class="flex items-center gap-2 bg-white border border-gray-200 px-3 py-2 rounded-md shadow-sm">
                                <svg class="w-3.5 h-3.5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                <span class="text-xs font-medium text-gray-600">HP Orang Tua: {{ $krs['registrasi']['hp_ortu'] }}</span>
                            </div>
                            <div class="flex items-center gap-2 bg-white border border-gray-200 px-3 py-2 rounded-md shadow-sm">
                                <svg class="w-3.5 h-3.5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                <span class="text-xs font-medium text-gray-600">Alamat: {{ $krs['registrasi']['alamat'] }}</span>
                            </div>
                            <div class="flex items-center gap-2 bg-white border border-gray-200 px-3 py-2 rounded-md shadow-sm w-12 justify-center">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Catatan & Timeline --}}
                <div>
                    <div class="flex items-center gap-2 mb-3 text-[#1b4d36]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                        <h4 class="text-xs font-bold uppercase tracking-wide">Catatan dan Timeline</h4>
                    </div>

                    @if($krs['note']['active'])
                        <div class="bg-[#e2f2e9] p-4 rounded-md border-l-4 border-[#1b4d36]">
                            <div class="flex gap-3">
                                <div class="w-8 h-8 rounded-full bg-[#1b4d36] text-white flex items-center justify-center font-bold text-xs">
                                    S
                                </div>
                                <div>
                                    <h5 class="text-xs font-bold text-gray-800">{{ $krs['note']['user'] }}</h5>
                                    <p class="text-xs text-gray-600 mt-1">{{ $krs['note']['text'] }}</p>
                                    <div class="flex items-center gap-1 mt-2 text-[10px] text-gray-500">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        {{ $krs['note']['time'] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-[#e2f2e9] p-4 rounded-md border-l-4 border-[#1b4d36] h-20">
                            {{-- Empty state (green box) --}}
                        </div>
                    @endif
                </div>

                {{-- Footer Timestamp --}}
                <div class="pt-4 border-t border-gray-100 flex items-center gap-2 text-[10px] text-gray-500 font-medium uppercase tracking-wide">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Terakhir di update: <span class="text-gray-900">{{ $krs['updated_at'] }}</span>
                </div>
            </div>
        </div>
    </div>
    @endforeach
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