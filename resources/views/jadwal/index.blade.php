@extends('layouts.app')

@section('content')

<div class="relative mb-8 overflow-hidden rounded-3xl bg-gradient-to-r from-[#1b4d36] to-[#3a9e6c] p-10 text-white shadow-xl">
    
    <div class="pointer-events-none absolute left-6 top-6 grid grid-cols-4 gap-2 opacity-30">
        @for($i=0; $i<16; $i++)
            <div class="h-1.5 w-1.5 rounded-full bg-white"></div>
        @endfor
    </div>

    <div class="pointer-events-none absolute bottom-6 right-6 grid grid-cols-5 gap-2 opacity-30">
        @for($i=0; $i<20; $i++)
            <div class="h-1.5 w-1.5 rounded-full bg-white"></div>
        @endfor
    </div>

    <div class="relative z-10 flex gap-6 pl-8">
        <div>
            <svg class="h-8 w-8 text-white mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
        </div>

        <div>
            <h3 class="text-2xl font-bold tracking-tight mb-4">Penting! Mohon Dibaca dengan Teliti</h3>
            <ul class="space-y-1.5 text-base font-normal text-green-50/95 list-none leading-relaxed">
                <li class="flex gap-3">
                    <span class="mt-2 block h-1.5 w-1.5 flex-none rounded-full bg-white"></span>
                    <span>Setelah selesai KRS, mahasiswa wajib untuk join kelas</span>
                </li>
                <li class="flex gap-3">
                    <span class="mt-2 block h-1.5 w-1.5 flex-none rounded-full bg-white"></span>
                    <span>Mahasiswa harus bergabung pada kelas yang sesuai dengan mata kuliah yang diambil pada KRS</span>
                </li>
                <li class="flex gap-3">
                    <span class="mt-2 block h-1.5 w-1.5 flex-none rounded-full bg-white"></span>
                    <span>Jika mata kuliah terbagi menjadi beberapa kelas, silahkan pilih kelas yang sesuai</span>
                </li>
                <li class="flex gap-3">
                    <span class="mt-2 block h-1.5 w-1.5 flex-none rounded-full bg-white"></span>
                    <span>Mahasiswa harus bergabung pada sebuah kelas, paling lambat 4 minggu setelah perkuliahan dimulai</span>
                </li>
                <li class="flex gap-3">
                    <span class="mt-2 block h-1.5 w-1.5 flex-none rounded-full bg-white"></span>
                    <span>Mahasiswa tidak akan terdaftar pada tabel absen dan tabel nilai jika belum bergabung pada kelas</span>
                </li>
                <li class="flex gap-3">
                    <span class="mt-2 block h-1.5 w-1.5 flex-none rounded-full bg-white"></span>
                    <span>Konsep join kelas juga berlaku pada mata kuliah PKL, KKN dan Skripsi</span>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 gap-6 md:grid-cols-3 mb-8">
    <div class="flex items-center justify-between rounded-xl border-l-[6px] border-green-500 bg-white p-6 shadow-sm">
        <div>
            <p class="text-xs font-bold uppercase tracking-wider text-gray-500">Kelas Tergabung</p>
            <h3 class="mt-1 text-4xl font-extrabold text-gray-900">5</h3>
            <p class="mt-1 text-[10px] text-gray-400">dari 8 mata kuliah</p>
        </div>
        <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-green-100 text-green-600">
             <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </div>
    </div>

    <div class="flex items-center justify-between rounded-xl border-l-[6px] border-red-500 bg-white p-6 shadow-sm">
        <div>
            <p class="text-xs font-bold uppercase tracking-wider text-gray-500">Belum Bergabung</p>
            <h3 class="mt-1 text-4xl font-extrabold text-gray-900">3</h3>
            <p class="mt-1 text-[10px] text-red-500 font-medium">Segera join kelas!</p>
        </div>
        <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-red-100 text-red-500">
             <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
        </div>
    </div>

    <div class="flex items-center justify-between rounded-xl border-l-[6px] border-blue-500 bg-white p-6 shadow-sm">
        <div>
            <p class="text-xs font-bold uppercase tracking-wider text-gray-500">Total Mata Kuliah</p>
            <h3 class="mt-1 text-4xl font-extrabold text-gray-900">8</h3>
            <p class="mt-1 text-[10px] text-gray-400">Semester Aktif</p>
        </div>
        <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-blue-100 text-blue-600">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
        </div>
    </div>
</div>

<div class="rounded-t-xl overflow-hidden shadow-sm bg-white">
    <table class="w-full min-w-[800px]">
        <thead>
            <tr class="bg-[#194D33] text-white">
                <th class="py-4 px-6 text-left text-sm font-bold">Kode</th>
                <th class="py-4 px-6 text-left text-sm font-bold">Mata Kuliah</th>
                <th class="py-4 px-6 text-left text-sm font-bold">Dosen</th>
                <th class="py-4 px-6 text-left text-sm font-bold">Hari | Jam</th>
                <th class="py-4 px-6 text-center text-sm font-bold">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @php
                $courses = array_fill(0, 7, [
                    'kode' => '5508',
                    'nama' => 'Agile Development',
                    'dosen' => 'Rizki Ramadhansyah, S.T., M.Kom',
                    'ruang' => 'Ruang : 4.1',
                    'hari' => 'Senin',
                    'jam' => '08:00 - 10:00'
                ]);
            @endphp

            @foreach($courses as $index => $course)
            <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-green-50/30' }}">
                <td class="py-6 px-6 align-top">
                    <span class="inline-block rounded bg-green-100 px-2.5 py-1 text-xs font-bold text-green-700">
                        {{ $course['kode'] }}
                    </span>
                </td>
                <td class="py-6 px-6 align-top">
                    <h4 class="text-sm font-bold text-gray-900">{{ $course['nama'] }}</h4>
                </td>
                <td class="py-6 px-6 align-top">
                    <p class="text-xs text-gray-500 max-w-[150px]">{{ $course['dosen'] }}</p>
                </td>
                <td class="py-6 px-6 align-top">
                    <div class="space-y-0.5">
                        <p class="text-xs text-gray-500">{{ $course['ruang'] }}</p>
                        <p class="text-xs font-bold text-gray-700">{{ $course['hari'] }}</p>
                        <p class="text-xs text-gray-500">{{ $course['jam'] }}</p>
                    </div>
                </td>
                <td class="py-6 px-6 align-top text-center">
                    <button class="rounded bg-[#00B050] px-6 py-2 text-xs font-bold text-white shadow-sm transition hover:bg-green-600">
                        Join Kelas
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection