@extends('layouts.app')

@section('content')

{{-- Welcome Card --}}
{{-- Based on image: Deep green gradient, dots pattern, white text, IPK box on right --}}
<div class="relative mb-8 overflow-hidden rounded-3xl bg-gradient-to-r from-[#2E7D55] to-[#1F653F] p-8 text-white shadow-lg">
    {{-- Decorative Dots/Pattern (CSS Simulated) --}}
    <div class="absolute left-0 top-0 p-4 opacity-20">
        <div class="grid grid-cols-6 gap-2">
            @for($i=0; $i<24; $i++)
                <div class="h-1 w-1 rounded-full bg-white"></div>
            @endfor
        </div>
    </div>
    <div class="absolute bottom-0 right-0 p-4 opacity-20 rotate-180">
        <div class="grid grid-cols-6 gap-2">
            @for($i=0; $i<24; $i++)
                <div class="h-1 w-1 rounded-full bg-white"></div>
            @endfor
        </div>
    </div>

    <div class="relative z-10 flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-bold tracking-tight mb-2">Selamat Datang Kembali!</h2>
            <p class="text-lg text-green-50 font-medium">Budi Doremi</p>
            <p class="text-green-100/90 font-light">Teknologi Rekayasa Perangkat Lunak</p>
        </div>
        
        {{-- IPK Box --}}
        <div class="rounded-2xl bg-white/10 p-4 text-center backdrop-blur-sm border border-white/20 min-w-[120px]">
            <div class="text-5xl font-bold tracking-tighter">3.0</div>
            <div class="text-xs font-medium uppercase tracking-wider text-green-100 mt-1">IPK Kumulatif</div>
        </div>
    </div>
</div>

{{-- Stats Row --}}
{{-- Colors based on image: Blue, Cyan, Purple, Orange (Pastel backgrounds) --}}
<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 mb-8">
    
    {{-- SKS Lulus (Blue) --}}
    <div class="relative overflow-hidden rounded-2xl bg-[#E6F0FF] p-6 transition-all hover:-translate-y-1 hover:shadow-md border border-[#D0E1FD]">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-sm font-bold text-[#4B6B99] mb-1">SKS Lulus</p>
                <h3 class="text-4xl font-bold text-[#2B6CB0]">82</h3>
                <p class="mt-2 text-xs text-[#6B8CB3]">81.18% dari total</p>
            </div>
            <div class="rounded-lg bg-[#CDE0FD] p-2 text-[#2B6CB0]">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
        </div>
    </div>

    {{-- Total SKS (Cyan) --}}
    <div class="relative overflow-hidden rounded-2xl bg-[#E0F7FA] p-6 transition-all hover:-translate-y-1 hover:shadow-md border border-[#B2EBF2]">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-sm font-bold text-[#00838F] mb-1">Total SKS</p>
                <h3 class="text-4xl font-bold text-[#00ACC1]">82</h3>
                <p class="mt-2 text-xs text-[#4DD0E1]">Tidak Lulus: 0</p>
            </div>
            <div class="rounded-lg bg-[#B2EBF2] p-2 text-[#00838F]">
                 <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
    </div>

    {{-- Semester Aktif (Purple) --}}
    <div class="relative overflow-hidden rounded-2xl bg-[#F3E5F5] p-6 transition-all hover:-translate-y-1 hover:shadow-md border border-[#E1BEE7]">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-sm font-bold text-[#8E24AA] mb-1">Semester Aktif</p>
                <h3 class="text-4xl font-bold text-[#9C27B0]">5</h3>
                <p class="mt-2 text-xs text-[#BA68C8]">2025/2026 Ganjil</p>
            </div>
            <div class="rounded-lg bg-[#E1BEE7] p-2 text-[#8E24AA]">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
        </div>
    </div>

    {{-- Dosen Wali (Orange) --}}
    <div class="relative overflow-hidden rounded-2xl bg-[#FFF3E0] p-6 transition-all hover:-translate-y-1 hover:shadow-md border border-[#FFE0B2]">
        <div class="flex items-start justify-between">
            <div class="flex-1">
                <p class="text-sm font-bold text-[#E65100] mb-1">Dosen Wali</p>
                <h3 class="text-3xl font-bold text-[#FB8C00] truncate" title="Rahmat">Rahmat</h3>
                <p class="mt-2 text-xs text-[#FFB74D]">2025/2026 Ganjil</p>
            </div>
            <div class="rounded-lg bg-[#FFE0B2] p-2 text-[#E65100] flex-shrink-0 ml-2">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            </div>
        </div>
    </div>
</div>

{{-- Charts Section --}}
{{-- Main Chart Left (60%), Side Charts Right (40%) --}}
<div class="grid grid-cols-1 gap-8 lg:grid-cols-12 mb-8">
    
    {{-- Left: Academic Progress --}}
    <div class="lg:col-span-7 flex flex-col">
        <div class="flex-1 rounded-3xl bg-white p-6 shadow-sm border border-gray-100">
            <h3 class="text-lg font-bold text-gray-900">Perkembangan Akademik</h3>
            <p class="text-sm text-gray-400 mb-6">Grafik IPK dan IPS per Semester</p>
            <div class="h-80 w-full">
                <canvas id="academicChart"></canvas>
            </div>
        </div>
    </div>

    {{-- Right: Side Charts --}}
    <div class="lg:col-span-5 flex flex-col gap-6">
        
        {{-- Distribution (Pie) --}}
        <div class="rounded-3xl bg-white p-6 shadow-sm border border-gray-100">
            <h3 class="text-sm font-bold text-gray-900">Distribusi Nilai</h3>
            <p class="text-xs text-gray-400 mb-4">Persentase Per Grade</p>
            <div class="h-48 flex justify-center">
                <canvas id="gradeChart"></canvas>
            </div>
        </div>

        {{-- Details (Bar) --}}
        <div class="rounded-3xl bg-white p-6 shadow-sm border border-gray-100">
            <h3 class="text-sm font-bold text-gray-900">Statistik Nilai Detail</h3>
            <p class="text-xs text-gray-400 mb-4">Total SKS per Grade</p>
            <div class="h-40">
                <canvas id="detailChart"></canvas>
            </div>
        </div>
    </div>
</div>

{{-- Semester History Table --}}
<div class="rounded-3xl bg-white p-8 shadow-sm border border-gray-100 mb-12">
    <h3 class="text-xl font-bold text-gray-900 mb-1">Riwayat Semester</h3>
    <p class="text-sm text-gray-400 mb-8">Detail prestasi per semester</p>

    <div class="overflow-x-auto">
        <table class="w-full min-w-[600px]">
            <thead>
                <tr class="border-b border-gray-100 text-left">
                    <th class="py-4 px-4 text-xs font-bold text-white uppercase tracking-wider bg-[#207045] rounded-l-lg">Semester</th>
                    <th class="py-4 px-4 text-xs font-bold text-white uppercase tracking-wider bg-[#207045]">IPS</th>
                    <th class="py-4 px-4 text-xs font-bold text-white uppercase tracking-wider bg-[#207045]">SKS Semester</th>
                    <th class="py-4 px-4 text-xs font-bold text-white uppercase tracking-wider bg-[#207045]">IPK</th>
                    <th class="py-4 px-4 text-xs font-bold text-white uppercase tracking-wider bg-[#207045] rounded-r-lg">Total SKS</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @php
                    $semesters = [
                        ['Ganjil 23/24', '3.48', 20, '3.48', 20],
                        ['Genap 23/24', '3.22', 21, '2.82', 41],
                        ['Ganjil 24/25', '3.64', 21, '3.56', 61],
                        ['Genap 24/25', '3.58', 20, '3.57', 81],
                        ['Ganjil 25/26', '-', 19, '2.9', 101],
                    ];
                @endphp

                @foreach($semesters as $sem)
                <tr class="group transition-colors hover:bg-gray-50">
                    <td class="py-5 px-4 text-sm font-bold text-gray-800">{{ $sem[0] }}</td>
                    <td class="py-5 px-4 text-sm font-bold text-blue-500">{{ $sem[1] }}</td>
                    <td class="py-5 px-4 text-sm font-bold text-gray-800">{{ $sem[2] }}</td>
                    <td class="py-5 px-4 text-sm font-bold text-emerald-500">{{ $sem[3] }}</td>
                    <td class="py-5 px-4 text-sm font-bold text-gray-800">{{ $sem[4] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    Chart.defaults.font.family = "'Inter', sans-serif";
    Chart.defaults.font.size = 11;
    Chart.defaults.color = '#94a3b8';

    // 1. Line Chart (Academic)
    const academicCtx = document.getElementById('academicChart').getContext('2d');
    new Chart(academicCtx, {
        type: 'line',
        data: {
            labels: ['Ganjil 23/24', 'Genap 23/24', 'Ganjil 24/25', 'Genap 24/25'],
            datasets: [{
                label: 'IPS',
                data: [3.2, 3.0, 3.5, 3.7], // Matching image visual approximation
                borderColor: '#0ea5e9', // Sky Blue
                backgroundColor: '#ffffff',
                borderWidth: 2,
                pointBackgroundColor: '#0ea5e9',
                pointRadius: 4,
                tension: 0
            }, {
                label: 'IPK',
                data: [3.2, 2.8, 3.3, 3.65], 
                borderColor: '#3b82f6', // Blue
                backgroundColor: '#ffffff',
                borderWidth: 2,
                pointBackgroundColor: '#3b82f6',
                pointRadius: 4,
                tension: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20 } },
                tooltip: { displayColors: false, backgroundColor: '#fff', titleColor: '#333', bodyColor: '#666', borderColor: '#eee', borderWidth: 1 }
            },
            scales: {
                y: {
                    min: 0, max: 4,
                    grid: { borderDash: [4, 4], color: '#f1f5f9' },
                    ticks: { stepSize: 1 }
                },
                x: {
                    grid: { drawing: false } // Only baseline
                }
            }
        }
    });

    // 2. Pie Chart
    const gradeCtx = document.getElementById('gradeChart').getContext('2d');
    new Chart(gradeCtx, {
        type: 'pie',
        data: {
            labels: ['A 30%', 'B 23.6%', 'C 3.8%', 'D 14.5%', 'E 2.1%'],
            datasets: [{
                data: [30, 23.6, 3.8, 14.5, 2.1],
                backgroundColor: [
                    '#15803d', // Green A
                    '#0ea5e9', // Blue B
                    '#fbbf24', // Yellow C
                    '#a855f7', // Purple D/E
                    '#f97316'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'right', labels: { font: { size: 10 }, boxWidth: 10 } }
            }
        }
    });

    // 3. Bar Chart
    const detailCtx = document.getElementById('detailChart').getContext('2d');
    new Chart(detailCtx, {
        type: 'bar',
        data: {
            labels: ['A', 'B+', 'B', 'C+', 'C'],
            datasets: [{
                label: 'Total SKS',
                data: [38, 28, 18, 5, 3],
                backgroundColor: [
                    '#15803d', // A
                    '#0ea5e9', // B+
                    '#8b5cf6', // B (Purple)
                    '#fbbf24', // C+
                    '#f97316'  // C
                ],
                borderRadius: 4,
                barThickness: 25
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 40,
                    grid: { display: false },
                    ticks: { display: true }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });
});
</script>
@endpush