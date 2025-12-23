@extends('layouts.app')

@section('content')

{{-- Header Section --}}
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Konsultasi Nilai</h1>
</div>

{{-- Info Alert Card --}}
<div class="bg-[#2d6a4f] text-white p-6 rounded-xl mb-6 relative overflow-hidden shadow-lg">
    {{-- Decorative Dots --}}
    <div class="absolute top-0 right-0 p-4 opacity-20">
        <div class="grid grid-cols-5 gap-1">
            @for($i=0; $i<25; $i++)
                <div class="w-1 h-1 bg-white rounded-full"></div>
            @endfor
        </div>
    </div>
    
    <div class="flex items-start gap-4 relative z-10">
        <div class="w-8 h-8 rounded-full border-2 border-white flex items-center justify-center flex-shrink-0 mt-1">
            <span class="font-bold text-lg">!</span>
        </div>
        <div class="flex-1">
            <h3 class="text-lg font-bold mb-2">Keterangan</h3>
            <ul class="space-y-1 text-sm text-gray-100">
                <li class="flex items-start gap-2">
                    <span class="mt-1.5 w-1.5 h-1.5 bg-white rounded-full flex-shrink-0"></span>
                    <span class="leading-relaxed">Menu Konsultasi Nilai Merupakan Wadah Untuk Melakukan Perbaikan Terhadap Nilai Mahasiswa Perwakilan</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="mt-1.5 w-1.5 h-1.5 bg-white rounded-full flex-shrink-0"></span>
                    <span class="leading-relaxed">Nilai Yang Dibesar Adalah Nilai Mata Kuliah Tidak Lulus</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="mt-1.5 w-1.5 h-1.5 bg-white rounded-full flex-shrink-0"></span>
                    <span class="leading-relaxed">Dalam Hal Perwatian, Dosen Wali Akan Melakukan Konsultasi Perwatian Dengan Bertanya ke Mahasiswa Mengenai Nilai Tidak Lulus</span>
                </li>
            </ul>
        </div>
    </div>
</div>

{{-- Search Bar --}}
<div class="bg-white rounded-xl shadow-sm p-4 mb-6">
    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
        <div class="relative w-full md:w-1/2">
            <input type="text" placeholder="Cari Mahasiswa Berdasarkan NIM atau Nama..." class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
        <div>
            <select class="border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 bg-white">
                <option>10 records</option>
                <option>25 records</option>
                <option>50 records</option>
            </select>
        </div>
    </div>
</div>

{{-- Student Card --}}
<div class="bg-white rounded-xl shadow-sm overflow-hidden mb-6 border-l-[6px] border-l-[#1a5c38]">
    {{-- Card Header --}}
    <div class="bg-[#D4F0E1] p-4 flex flex-col md:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 bg-[#1a5c38] text-white rounded-full flex items-center justify-center font-bold text-lg shadow-sm">
                1
            </div>
            <div>
                <h3 class="text-lg font-bold text-gray-800 uppercase">BUDI DOREMI</h3>
                <p class="text-sm text-gray-500">NIM: 2305010034</p>
            </div>
        </div>
        <button onclick="openModal()" class="bg-[#1a5c38] hover:bg-[#14452a] text-white px-5 py-2 rounded-lg text-sm font-bold transition flex items-center gap-2 shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
            </svg>
            <span>Catatan</span>
        </button>
    </div>

    {{-- Card Stats --}}
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            {{-- Red Box --}}
            <div class="bg-[#fff5f5] border border-red-100 rounded-lg p-4">
                <p class="text-sm text-gray-600 mb-1">Jumlah MK Tidak Lulus</p>
                <p class="text-3xl font-bold text-red-600">4</p>
            </div>
            
            {{-- Blue Box --}}
            <div class="bg-[#e0f2fe] border border-blue-100 rounded-lg p-4">
                <p class="text-sm text-gray-600 mb-1">KRS Terakhir</p>
                <p class="text-2xl font-bold text-blue-600">2025/2026 Ganjil</p>
            </div>

            {{-- White/Gray Box --}}
            <div class="bg-white border border-gray-200 rounded-lg p-4">
                <p class="text-sm text-gray-600 mb-1">Status Nasihat</p>
                <p class="text-2xl font-bold text-gray-500">Tersedia</p>
            </div>
        </div>
    </div>
</div>

{{-- Pagination --}}
<div class="bg-white p-4 rounded-xl shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">
    <div class="text-sm text-gray-500">
        Showing 1 to 1 of 1 entries
    </div>
    <div class="flex items-center gap-1">
        <button class="px-3 py-1 border border-gray-200 rounded text-sm text-gray-500 hover:bg-gray-50">First</button>
        <button class="w-8 h-8 bg-[#1a5c38] text-white rounded text-sm font-bold flex items-center justify-center">1</button>
        <button class="px-3 py-1 border border-gray-200 rounded text-sm text-gray-500 hover:bg-gray-50">Last</button>
    </div>
</div>

{{-- Modal Overlay --}}
<div id="catatanModal" class="fixed inset-0 bg-black/60 z-50 hidden items-center justify-center p-4 backdrop-blur-sm font-sans transition-opacity duration-300">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl max-h-[95vh] overflow-y-auto transform scale-100 transition-all flex flex-col">
        
        {{-- Modal Header --}}
        <div class="bg-gradient-to-r from-[#1F653F] via-[#2F8054] to-[#47AF76] text-white px-6 py-4 flex justify-between items-center rounded-t-2xl shrink-0">
            <div>
                <h2 class="text-xl font-bold tracking-tight">Catatan Konsultasi Akademik</h2>
                <p class="text-green-50 text-sm font-medium opacity-90">Detail nilai dan nasihat akademik</p>
            </div>
            <button onclick="closeModal()" class="text-white/80 hover:text-white hover:bg-white/10 rounded-full p-2 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        {{-- Modal Body --}}
        <div class="p-6 md:p-8 space-y-6 overflow-y-auto">
            
            {{-- Student Info Card --}}
            <div class="bg-[#E6FFF1] rounded-2xl p-6 relative overflow-hidden">
                {{-- Left Green Accent --}}
                <div class="absolute left-0 top-0 bottom-0 w-2 bg-[#2d6a4f] rounded-l-2xl"></div>
                
                <div class="pl-4 grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8">
                    <div>
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-0.5">NIM</p>
                        <p class="text-lg font-bold text-gray-900">2305010009</p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-0.5">Nama</p>
                        <p class="text-lg font-bold text-gray-900">Budi Doremi</p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-0.5">KRS Terakhir</p>
                        <p class="text-base font-bold text-[#43A972]">2025/2026 Ganjil</p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-0.5">Daftar Mata Kuliah Tidak Lulus</p>
                        <p class="text-base font-bold text-[#d32f2f]">4 Mata Kuliah</p>
                    </div>
                </div>
            </div>

            {{-- Table Section --}}
            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-4">Daftar Mata Kuliah Tidak Lulus</h3>
                
                <div class="overflow-hidden rounded-xl border border-gray-200 shadow-sm">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gradient-to-r from-[#DC0000] via-[#FF1212] to-[#FFB433] text-white">
                                <th class=" px-4 py-3.5 text-center font-bold w-16">No</th>
                                <th class=" px-4 py-3.5 text-left font-bold">Kode MK | Nama MK</th>
                                <th class=" px-4 py-3.5 text-left font-bold w-32 border-l border-white/20">UTS|UAS</th>
                                <th class=" px-4 py-3.5 text-left font-bold w-40 border-l border-white/20">Nilai</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            {{-- Row 1 --}}
                            <tr class="group hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-4 align-top">
                                    <div class="w-8 h-8 rounded-full bg-[#E40404] text-white flex items-center justify-center font-bold text-sm mx-auto shadow-sm group-hover:scale-110 transition-transform">1</div>
                                </td>
                                <td class="px-4 py-4 align-top">
                                    <div class="font-bold text-[#E40404] mb-0.5">RPL32307</div>
                                    <div class="font-bold text-gray-900 text-base">Pemrograman Web Lanjut</div>
                                </td>
                                <td class="px-4 py-4 align-top text-gray-600 font-medium">
                                    <div class="whitespace-nowrap">UTS : 0.00</div>
                                    <div class="whitespace-nowrap">UAS : 0.00</div>
                                </td>
                                <td class="px-4 py-4 align-top">
                                    <div class="text-gray-600 font-medium">Angka : <span class="text-[#E40404] font-bold">18.00</span></div>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="text-gray-600 font-medium">huruf :</span>
                                        <span class="w-6 h-6 rounded-full bg-[#FFD4D4] border border-[] text-[#E40404] flex items-center justify-center font-bold text-xs">E</span>
                                    </div>
                                </td>
                            </tr>

                            {{-- Row 2 --}}
                            <tr class="bg-[#FFF3F3] group hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-4 align-top">
                                    <div class="w-8 h-8 rounded-full bg-[#E40404] text-white flex items-center justify-center font-bold text-sm mx-auto shadow-sm group-hover:scale-110 transition-transform">2</div>
                                </td>
                                <td class="px-4 py-4 align-top">
                                    <div class="font-bold text-[#E40404] mb-0.5">RPL32203</div>
                                    <div class="font-bold text-gray-900 text-base">Praktik Analisis dan Desain Perangkat Lunak</div>
                                </td>
                                <td class="px-4 py-4 align-top text-gray-600 font-medium">
                                    <div class="whitespace-nowrap">UTS : 60.00</div>
                                    <div class="whitespace-nowrap">UAS : 0.00</div>
                                </td>
                                <td class="px-4 py-4 align-top">
                                    <div class="text-gray-600 font-medium">Angka : <span class="text-gray-900 font-bold">39.25</span></div>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="text-gray-600 font-medium">huruf :</span>
                                        <span class="w-6 h-6 rounded-full bg-[#FFD4D4] border text-[#E40404] flex items-center justify-center font-bold text-xs">E</span>
                                    </div>
                                </td>
                            </tr>

                            {{-- Row 3 --}}

                            {{-- Row 1 --}}
                            <tr class="group hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-4 align-top">
                                    <div class="w-8 h-8 rounded-full bg-[#E40404] text-white flex items-center justify-center font-bold text-sm mx-auto shadow-sm group-hover:scale-110 transition-transform">1</div>
                                </td>
                                <td class="px-4 py-4 align-top">
                                    <div class="font-bold text-[#E40404] mb-0.5">RPL32307</div>
                                    <div class="font-bold text-gray-900 text-base">Pemrograman Web Lanjut</div>
                                </td>
                                <td class="px-4 py-4 align-top text-gray-600 font-medium">
                                    <div class="whitespace-nowrap">UTS : 0.00</div>
                                    <div class="whitespace-nowrap">UAS : 0.00</div>
                                </td>
                                <td class="px-4 py-4 align-top">
                                    <div class="text-gray-600 font-medium">Angka : <span class="text-[#E40404] font-bold">18.00</span></div>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="text-gray-600 font-medium">huruf :</span>
                                        <span class="w-6 h-6 rounded-full bg-[#FFD4D4] border border-[] text-[#E40404] flex items-center justify-center font-bold text-xs">E</span>
                                    </div>
                                </td>
                            </tr>

                             {{-- Row 4 --}}
                            <tr class="bg-[#FFF3F3] group hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-4 align-top">
                                    <div class="w-8 h-8 rounded-full bg-[#E40404] text-white flex items-center justify-center font-bold text-sm mx-auto shadow-sm group-hover:scale-110 transition-transform">2</div>
                                </td>
                                <td class="px-4 py-4 align-top">
                                    <div class="font-bold text-[#E40404] mb-0.5">RPL32203</div>
                                    <div class="font-bold text-gray-900 text-base">Praktik Analisis dan Desain Perangkat Lunak</div>
                                </td>
                                <td class="px-4 py-4 align-top text-gray-600 font-medium">
                                    <div class="whitespace-nowrap">UTS : 60.00</div>
                                    <div class="whitespace-nowrap">UAS : 0.00</div>
                                </td>
                                <td class="px-4 py-4 align-top">
                                    <div class="text-gray-600 font-medium">Angka : <span class="text-gray-900 font-bold">39.25</span></div>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="text-gray-600 font-medium">huruf :</span>
                                        <span class="w-6 h-6 rounded-full bg-[#FFD4D4] border text-[#E40404] flex items-center justify-center font-bold text-xs">E</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Nasihat Akademik --}}
            <div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Nasihat Akademik</h3>
                <div class="bg-[#fff8e1] rounded-xl p-4 border border-[#ffecb3]">
                    <textarea class="w-full h-32 p-4 border-0 bg-white rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 resize-none text-gray-700 placeholder-gray-400 shadow-sm" placeholder="Tulis nasihat akademik disini..."></textarea>
                </div>
            </div>
        </div>

        {{-- Modal Footer --}}
        <div class="px-8 py-5 flex items-center justify-end gap-3 pb-8 rounded-b-2xl shrink-0">
            <button onclick="closeModal()" class="px-6 py-2.5 bg-gray-200 text-gray-700 rounded-lg font-bold hover:bg-gray-300 transition-colors">
                Batal
            </button>
            <button class="px-6 py-2.5 bg-[#2E7D55] text-white rounded-lg font-bold hover:bg-[#246343] transition-colors shadow-lg shadow-green-900/20">
                Simpan
            </button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function openModal() {
    const modal = document.getElementById('catatanModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    const modal = document.getElementById('catatanModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = 'auto';
}

// Close modal when clicking outside
document.getElementById('catatanModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});

// Close modal with ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal();
    }
});
</script>
@endpush
