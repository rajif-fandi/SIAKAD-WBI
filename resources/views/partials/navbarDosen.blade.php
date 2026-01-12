<aside class="fixed bottom-0 left-0 top-[73px] z-40 h-[calc(100vh-73px)] w-64 -translate-x-full bg-[#1b4d36] transition-transform lg:translate-x-0 hidden lg:block overflow-y-auto">
    <div class="h-full px-4 py-6">
        <div class="overflow-hidden rounded-lg bg-[#245d43]/50">
              <button
        data-accordion-button
        class="flex w-full items-center justify-between bg-[#2d6a4f] px-4 py-3 text-sm font-bold text-white hover:bg-[#367c5d]">
        <span>PERKULIAHAN</span>
        <svg class="h-4 w-4 transition-transform" viewBox="0 0 24 24">
            <path d="M19 9l-7 7-7-7" fill="none" stroke="currentColor" stroke-width="2"/>
        </svg>
    </button>

            <div data-accordion-content class="">
                <a href="{{ route('dosen.dashboard') }}"
   class="block px-4 py-2.5 text-sm transition
   {{ request()->routeIs('dosen.dashboard')
        ? 'bg-[#3da76e]/20 border-l-4 border-green-400 font-semibold text-white'
        : 'pl-5 font-medium text-green-100/70 hover:text-white' }}">
    Beranda
</a>
<a href="{{ route('dosen.jadwal') }}"
   class="block px-4 py-2.5 text-sm transition
   {{ request()->routeIs('dosen.jadwal')
        ? 'bg-[#3da76e]/20 border-l-4 border-green-400 font-semibold text-white'
        : 'pl-5 font-medium text-green-100/70 hover:text-white' }}">
    Jadwal
</a>
<a href="{{ route('dosen.KRSMahasiswa') }}"
class="block px-4 py-2.5 text-sm transition
{{ request()->routeIs('dosen.KRSMahasiswa')
 ? 'bg-[#3da76e]/20 border-l-4 border-green-400 font-semibold text-white'
 : 'pl-5 font-medium text-green-100/70 hover:text-white' }}">
 KRS Mahasiswa
</a>
<a href="{{ route('dosen.penilaian') }}"
class="block px-4 py-2.5 text-sm transition
{{ request()->routeIs('dosen.penilaian')
 ? 'bg-[#3da76e]/20 border-l-4 border-green-400 font-semibold text-white'
 : 'pl-5 font-medium text-green-100/70 hover:text-white' }}">
 Penilaian
</a>


                <a href="{{ route('dosen.profilDosen')}}"
                class="block px-4 py-2.5 text-sm transition
                {{ request()->routeIs('dosen.profilDosen')
                 ? 'bg-[#3da76e]/20 border-l-4 border-green-400 font-semibold text-white'
                 : 'pl-5 font-medium text-green-100/70 hover:text-white'}}">
                    Profil Dosen
                </a>
            </div>

        
    </div>

            
        </div>
        

    </div>
    <script>
document.querySelectorAll('[data-accordion-button]').forEach((button) => {
    button.addEventListener('click', () => {
        const content = button.nextElementSibling;
        document.querySelectorAll('[data-accordion-content]').forEach((el) => {
            if (el !== content) {
                el.classList.add('hidden');
            }
        });

        content.classList.toggle('hidden');
        button.querySelector('svg').classList.toggle('rotate-180');
    });
});
</script>

</aside>