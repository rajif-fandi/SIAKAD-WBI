<aside class="fixed bottom-0 left-0 top-[73px] z-40 h-[calc(100vh-73px)] w-64 -translate-x-full bg-[#1b4d36] transition-transform lg:translate-x-0 hidden lg:block overflow-y-auto">
    <div class="h-full px-4 py-6">
        <div class="overflow-hidden rounded-lg bg-[#245d43]/50">
            <button class="flex w-full items-center justify-between bg-[#2d6a4f] px-4 py-3 text-left text-sm font-bold text-white transition hover:bg-[#367c5d]">
                <div class="flex items-center gap-2">
                    <span class="h-4 w-1 rounded-full bg-green-400"></span>
                    PERKULIAHAN
                </div>
                <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>

            <div class="py-1">
                <a href="{{ route('dashboard') }}"
   class="block px-4 py-2.5 text-sm transition
   {{ request()->routeIs('dashboard')
        ? 'bg-[#3da76e]/20 border-l-4 border-green-400 font-semibold text-white'
        : 'pl-5 font-medium text-green-100/70 hover:text-white' }}">
    Beranda
</a>
<a href="{{ route('jadwal.index') }}"
   class="block px-4 py-2.5 text-sm transition
   {{ request()->routeIs('jadwal.*')
        ? 'bg-[#3da76e]/20 border-l-4 border-green-400 font-semibold text-white'
        : 'pl-5 font-medium text-green-100/70 hover:text-white' }}">
    Jadwal
</a>
<a href="{{ route('KRS.index') }}"
class="block px-4 py-2.5 text-sm transition
{{ request()->routeIs('KRS.*')
 ? 'bg-[#3da76e]/20 border-l-4 border-green-400 font-semibold text-white'
 : 'pl-5 font-medium text-green-100/70 hover:text-white' }}">
 Rencana Studi
</a>

                <a href="{{ route('keberhasilanStudi.index') }}" 
                class="block px-4 py-2.5 text-sm transition
{{ request()->routeIs('keberhasilanStudi.*')
 ? 'bg-[#3da76e]/20 border-l-4 border-green-400 font-semibold text-white'
 : 'pl-5 font-medium text-green-100/70 hover:text-white' }}">
                    Keberhasilan Studi
                </a>

                <a href="{{ route('konsultasiNilai.index')}}"
                class="block px-4 py-2.5 text-sm transition
                {{ request()->routeIs('konsultasiNilai.*')
                 ? 'bg-[#3da76e]/20 border-l-4 border-green-400 font-semibold text-white'
                 : 'pl-5 font-medium text-green-100/70 hover:text-white'}}">
                    Konsultasi Nilai
                </a>

                <a href="{{ route('kehadiran.index')}}"
                class="block px-4 py-2.5 text-sm transition
                {{ request()->routeIs('kehadiran.*')
                 ? 'bg-[#3da76e]/20 border-l-4 border-green-400 font-semibold text-white'
                 : 'pl-5 font-medium text-green-100/70 hover:text-white'}}">
                    Kehadiran
                </a>

                <a href="{{ route('profilMahasiswa.index')}}"
                class="block px-4 py-2.5 text-sm transition
                {{ request()->routeIs('profilMahasiswa.*')
                 ? 'bg-[#3da76e]/20 border-l-4 border-green-400 font-semibold text-white'
                 : 'pl-5 font-medium text-green-100/70 hover:text-white'}}">
                    Profil Mahasiswa
                </a>
            </div>
        </div>

    </div>
</aside>