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

<div class="mb-8 rounded-[2rem] bg-gradient-to-r from-slate-800 to-slate-900 p-8 text-white relative overflow-hidden shadow-lg">
    <div class="absolute right-0 bottom-0 p-8 opacity-10 pointer-events-none">
         <div class="grid grid-cols-6 gap-3">
            @for($i=0; $i<24; $i++)
                <div class="h-1.5 w-1.5 rounded-full bg-white/60"></div>
            @endfor
        </div>
    </div>

    <div class="relative z-10 flex flex-col md:flex-row items-center gap-8">
        <div class="flex-shrink-0 group relative">
            <div class="h-48 w-48 rounded-[1.5rem] border border-white/40 bg-white/5 flex flex-col items-center justify-center backdrop-blur-sm relative shadow-2xl overflow-hidden">
                <div class="rounded-full border border-white/50 p-4 mb-2">
                    <svg class="h-12 w-12 text-white/90" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span class="text-xs font-bold text-white/90 tracking-widest uppercase">SYSTEM ADMIN</span>
            </div>
        </div>

        <div class="flex-1 text-center md:text-left">
            <h1 class="text-[2.5rem] font-bold uppercase tracking-tight leading-none mb-2">{{ $user->name }}</h1>
            <p class="text-xl font-medium text-white/80 mb-6">Administrator Sistem</p>
            
            <div class="flex flex-wrap items-center justify-center md:justify-start gap-x-8 gap-y-3 text-sm font-semibold text-white/90 mb-8">
                 <div class="flex items-center gap-2.5 bg-white/10 px-4 py-2 rounded-full backdrop-blur-md">
                    <svg class="h-5 w-5 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span>{{ $user->email }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    {{-- Personal Info Form --}}
    <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm">
        <div class="flex items-center gap-3 mb-8">
            <div class="w-10 h-10 bg-slate-100 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-800">Detail Profile</h3>
        </div>

        <form action="{{ route('admin.profile.update') }}" method="POST">
            @csrf
            <div class="space-y-6">
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ $user->name }}" required class="w-full px-5 py-4 bg-gray-50 border-2 border-gray-100 rounded-2xl focus:border-slate-800 focus:bg-white transition-all font-bold text-gray-700">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Email Admin</label>
                    <input type="email" name="email" value="{{ $user->email }}" required class="w-full px-5 py-4 bg-gray-50 border-2 border-gray-100 rounded-2xl focus:border-slate-800 focus:bg-white transition-all font-bold text-gray-700">
                </div>
                <div class="pt-4">
                    <button type="submit" class="w-full px-8 py-4 bg-slate-800 text-white rounded-2xl font-bold shadow-lg hover:shadow-xl hover:scale-[1.02] active:scale-[0.98] transition-all">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- Password Change Form --}}
    <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm">
        <div class="flex items-center gap-3 mb-8">
            <div class="w-10 h-10 bg-amber-50 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-800">Ubah Keamanan</h3>
        </div>

        <form action="{{ route('admin.profile.password') }}" method="POST">
            @csrf
            <div class="space-y-6">
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Password Saat Ini</label>
                    <input type="password" name="current_password" required class="w-full px-5 py-4 bg-gray-50 border-2 border-gray-100 rounded-2xl focus:border-slate-800 focus:bg-white transition-all font-bold text-gray-700">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Password Baru</label>
                    <input type="password" name="password" required class="w-full px-5 py-4 bg-gray-50 border-2 border-gray-100 rounded-2xl focus:border-slate-800 focus:bg-white transition-all font-bold text-gray-700">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" required class="w-full px-5 py-4 bg-gray-50 border-2 border-gray-100 rounded-2xl focus:border-slate-800 focus:bg-white transition-all font-bold text-gray-700">
                </div>
                <div class="pt-4">
                    <button type="submit" class="w-full px-8 py-4 bg-amber-600 text-white rounded-2xl font-bold shadow-lg hover:shadow-xl hover:scale-[1.02] active:scale-[0.98] transition-all">
                        Update Password
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
