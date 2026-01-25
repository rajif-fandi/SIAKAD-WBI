<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SIAKAD Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="bg-gray-100 flex flex-col min-h-screen">

    {{-- Topbar & Sidebar --}}
    @if(Auth::user()->role === 'mahasiswa')
        @include('partials.topbar')
        @include('partials.navbar')
    @elseif(Auth::user()->role === 'dosen')
        @include('partials.topbar')
        @include('partials.navbarDosen')
    @elseif(Auth::user()->role === 'admin')
        @include('partials.topbar')
        @include('partials.navbarAdmin')
    @elseif(Auth::user()->role === 'akademik')
        @include('partials.topbar')
        @include('partials.navbarAkademik')
    @endif

    {{-- Content --}}
    <div class="flex-grow">
        <main class="pt-[43px] lg:ml-64 px-6 py-6 transition-all">
            @yield('content')
        </main>
    </div>

    {{-- Footer --}}
    @include('Footer.index')

    @stack('scripts')
</body>
