@if(session('credentials'))
    <div class="mb-8 bg-gradient-to-br from-indigo-600 to-blue-700 rounded-3xl p-8 text-white shadow-2xl relative overflow-hidden animate-fade-in group">
        {{-- Decorative Elements --}}
        <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16 blur-2xl"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/10 rounded-full -ml-12 -mb-12 blur-xl"></div>
        
        <div class="relative z-10">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center border border-white/30">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-black tracking-tight">Akun Berhasil Dibuat!</h3>
                    <p class="text-indigo-100 text-sm font-medium">Berikan kredensial berikut kepada <strong>{{ session('credentials')['name'] }}</strong></p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-white/10 backdrop-blur-sm border border-white/20 p-5 rounded-2xl group/item hover:bg-white/20 transition-all">
                    <p class="text-xs font-bold text-indigo-200 uppercase tracking-widest mb-1.5">Email Login</p>
                    <div class="flex items-center justify-between gap-3">
                        <code class="text-lg font-black font-mono tracking-wider">{{ session('credentials')['email'] }}</code>
                        <button onclick="copyToClipboard('{{ session('credentials')['email'] }}')" class="p-2 hover:bg-white/20 rounded-lg transition-colors" title="Salin Email">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="bg-white/10 backdrop-blur-sm border border-white/20 p-5 rounded-2xl group/item hover:bg-white/20 transition-all">
                    <p class="text-xs font-bold text-indigo-200 uppercase tracking-widest mb-1.5">Password Default</p>
                    <div class="flex items-center justify-between gap-3">
                        <code class="text-lg font-black font-mono tracking-wider">{{ session('credentials')['password'] }}</code>
                        <button onclick="copyToClipboard('{{ session('credentials')['password'] }}')" class="p-2 hover:bg-white/20 rounded-lg transition-colors" title="Salin Password">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="mt-6 flex items-center gap-2 text-[10px] font-bold text-indigo-200 uppercase tracking-[0.2em] animate-pulse">
                <div class="w-1.5 h-1.5 bg-green-400 rounded-full"></div>
                Catat informasi ini sebelum menutup halaman
            </div>
        </div>
    </div>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Berhasil disalin!',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true
                });
            });
        }
    </script>
@endif
