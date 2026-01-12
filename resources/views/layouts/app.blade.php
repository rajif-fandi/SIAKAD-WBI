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

<body class="bg-gray-100">
@if(Auth::user()->role === 'mahasiswa')
    @include('partials.topbar')
    @include('partials.navbar')
@elseif(Auth::user()->role === 'dosen')
    @include('partials.topbar')
    @include('partials.navbarDosen')
@endif


<main class="pt-[43px] lg:ml-64 px-6 py-6 min-h-screen transition-all">
    @yield('content')
</main>


    @stack('scripts')

</body>
</html>
