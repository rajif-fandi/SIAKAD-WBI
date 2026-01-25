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

            <div data-accordion-button class="hidden">
                <a href="{{ route('akademik.dashboardAkademik') }}"
   class="block px-4 py-2.5 text-sm transition
   {{ request()->routeIs('akademik.dashboardAkademik')
        ? 'bg-[#3da76e]/20 border-l-4 border-green-400 font-semibold text-white'
        : 'pl-5 font-medium text-green-100/70 hover:text-white' }}">
    Beranda
</a>
<a href="{{ route('akademik.matakuliah.index') }}"
   class="block px-4 py-2.5 text-sm transition
   {{ request()->routeIs('akademik.matakuliah.index')
        ? 'bg-[#3da76e]/20 border-l-4 border-green-400 font-semibold text-white'
        : 'pl-5 font-medium text-green-100/70 hover:text-white' }}">
    Kelola MataKuliah
</a>
<a href="{{ route('akademik.kurikulum.index') }}"
   class="block px-4 py-2.5 text-sm transition
   {{ request()->routeIs('akademik.kurikulum.index')
        ? 'bg-[#3da76e]/20 border-l-4 border-green-400 font-semibold text-white'
        : 'pl-5 font-medium text-green-100/70 hover:text-white' }}">
    Kelola Kurikulum
</a>
<a href="{{ route('akademik.kelas.index') }}"
   class="block px-4 py-2.5 text-sm transition
   {{ request()->routeIs('akademik.kelas.index')
        ? 'bg-[#3da76e]/20 border-l-4 border-green-400 font-semibold text-white'
        : 'pl-5 font-medium text-green-100/70 hover:text-white' }}">
    Kelola Kelas
</a>
<a href="{{ route('akademik.jadwal.index') }}"
   class="block px-4 py-2.5 text-sm transition
   {{ request()->routeIs('akademik.jadwal.index')
        ? 'bg-[#3da76e]/20 border-l-4 border-green-400 font-semibold text-white'
        : 'pl-5 font-medium text-green-100/70 hover:text-white' }}">
    Kelola Jadwal
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
                el.previousElementSibling
                    .querySelector('svg')
                    .classList.remove('rotate-180');
            }
        });

        content.classList.toggle('hidden');
        button.querySelector('svg').classList.toggle('rotate-180');
    });
});
</script>

</aside>