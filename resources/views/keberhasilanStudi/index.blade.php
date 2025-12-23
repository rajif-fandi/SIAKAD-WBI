
@extends('layouts.app')

@section('content')

{{-- Statistics Cards --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">
    {{-- IPK Kumulatif --}}
    <div class="bg-gradient-to-br from-green-600 to-green-700 text-white p-6 rounded-2xl shadow-lg relative overflow-hidden">
        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-sm opacity-90 mb-1">IPK Kumulatif</p>
            <p class="text-5xl font-bold">3.0</p>
        </div>
        <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-10 rounded-full -ml-12 -mb-12"></div>
    </div>

    {{-- Rata-rata IPS --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm border-2 border-orange-200 relative overflow-hidden">
        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 bg-orange-50 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-sm text-gray-600 mb-1">Rata-rata IPS</p>
            <p class="text-5xl font-bold text-gray-900">3.0</p>
            <p class="text-xs text-gray-500 mt-1">Dari 5 Semester</p>
        </div>
    </div>

    {{-- SKS yang sudah ditempuh --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm border-2 border-blue-200 relative overflow-hidden">
        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-sm text-gray-600 mb-1">SKS yang sudah ditempuh</p>
            <p class="text-5xl font-bold text-gray-900">62</p>
        </div>
    </div>

    {{-- Semester yang dijalani --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm border-2 border-purple-200 relative overflow-hidden">
        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 bg-purple-50 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
            <p class="text-sm text-gray-600 mb-1">Semester yang dijalani</p>
            <p class="text-5xl font-bold text-gray-900">3</p>
        </div>
    </div>
</div>

{{-- Detail Tabel Section --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
    {{-- Header Content --}}
    <div class="flex items-center justify-between mb-6">
        <div class="px-4 py-2 bg-gray-100 rounded-lg">
            <h2 class="text-green-900 font-bold text-lg">Detail Tabel</h2>
        </div>
        
        <button class="bg-[#1a5c38] hover:bg-[#14452a] text-white px-6 py-2.5 rounded-lg text-sm font-bold transition duration-200 flex items-center gap-2 shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <span>Export PDF</span>
        </button>
    </div>

    {{-- Table Content --}}
    <div class="overflow-hidden rounded-xl border border-gray-100">
        <table class="w-full">
            <thead>
                <tr class="bg-[#1a5c38] text-white">
                    <th class="px-6 py-4 text-left font-bold text-base">Semester</th>
                    <th class="px-6 py-4 text-center font-bold text-base">IPS</th>
                    <th class="px-6 py-4 text-center font-bold text-base">IPK</th>
                    <th class="px-6 py-4 text-center font-bold text-base">SKS Semester</th>
                    <th class="px-6 py-4 text-center font-bold text-base">Total SKS</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                {{-- Row 1 --}}
                <tr class="bg-white hover:bg-gray-50 transition">
                    <td class="px-6 py-5">
                        <div>
                            <p class="font-bold text-gray-900 text-base">Semester 1 (Ganjil)</p>
                            <p class="text-sm text-gray-500 mt-1">1 (Satu)</p>
                        </div>
                    </td>
                    <td class="px-6 py-5 text-center">
                        <span class="text-xl font-bold text-[#00b4d8]">3.48</span>
                    </td>
                    <td class="px-6 py-5 text-center">
                        <span class="text-xl font-bold text-[#1a5c38]">3.48</span>
                    </td>
                    <td class="px-6 py-5 text-center">
                        <span class="text-base font-bold text-gray-400">20</span>
                    </td>
                    <td class="px-6 py-5 text-center">
                        <span class="text-base font-bold text-[#2ecc71]">20</span>
                    </td>
                </tr>

                {{-- Row 2 --}}
                <tr class="bg-[#e8fce8] hover:bg-[#dfffe0] transition">
                    <td class="px-6 py-5">
                        <div>
                            <p class="font-bold text-gray-900 text-base">Semester 1 (Ganjil)</p>
                            <p class="text-sm text-gray-500 mt-1">1 (Satu)</p>
                        </div>
                    </td>
                    <td class="px-6 py-5 text-center">
                        <span class="text-xl font-bold text-[#00b4d8]">3.48</span>
                    </td>
                    <td class="px-6 py-5 text-center">
                        <span class="text-xl font-bold text-[#1a5c38]">3.48</span>
                    </td>
                    <td class="px-6 py-5 text-center">
                        <span class="text-base font-bold text-gray-400">20</span>
                    </td>
                    <td class="px-6 py-5 text-center">
                        <span class="text-base font-bold text-[#2ecc71]">20</span>
                    </td>
                </tr>

                {{-- Row 3 --}}
                <tr class="bg-white hover:bg-gray-50 transition">
                    <td class="px-6 py-5">
                        <div>
                            <p class="font-bold text-gray-900 text-base">Semester 1 (Ganjil)</p>
                            <p class="text-sm text-gray-500 mt-1">1 (Satu)</p>
                        </div>
                    </td>
                    <td class="px-6 py-5 text-center">
                        <span class="text-xl font-bold text-[#00b4d8]">3.48</span>
                    </td>
                    <td class="px-6 py-5 text-center">
                        <span class="text-xl font-bold text-[#1a5c38]">3.48</span>
                    </td>
                    <td class="px-6 py-5 text-center">
                        <span class="text-base font-bold text-gray-400">20</span>
                    </td>
                    <td class="px-6 py-5 text-center">
                        <span class="text-base font-bold text-[#2ecc71]">20</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


@endsection