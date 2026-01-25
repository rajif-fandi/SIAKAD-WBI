@extends('layouts.app')

@section('content')

@include('partials.credential_alert')

{{-- Header Section --}}
<div class="relative bg-gradient-to-br from-[#1F653F] via-[#2F8054] to-[#47AF76] text-white p-8 rounded-3xl mb-8 shadow-2xl overflow-hidden">
    <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full -ml-24 -mb-24 blur-2xl"></div>
    
    <div class="relative z-10 flex items-center justify-between">
        <div>
            <div class="flex items-center gap-3 mb-3">
                <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
                    </svg>
                </div>
                <h2 class="text-3xl font-extrabold tracking-tight">Kelola Staf Akademik</h2>
            </div>
            <p class="text-emerald-100 text-base">Manajemen akun petugas bagian akademik</p>
        </div>
        <button onclick="openAddModal()" class="flex items-center gap-3 bg-white text-[#1F653F] px-8 py-4 rounded-2xl font-bold text-base hover:scale-105 hover:shadow-2xl transition-all shadow-xl active:scale-95 group">
            <div class="w-8 h-8 bg-[#1F653F] rounded-lg flex items-center justify-center group-hover:rotate-90 transition-transform duration-300">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
            </div>
            Tambah Staf
        </button>
    </div>
</div>

{{-- Table Section --}}
<div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gradient-to-r from-[#1F653F] via-[#2F8054] to-[#47AF76] text-white">
                    <th class="px-6 py-5 text-left text-sm font-bold uppercase tracking-wider">No</th>
                    <th class="px-6 py-5 text-left text-sm font-bold uppercase tracking-wider">Nama Staf</th>
                    <th class="px-6 py-5 text-left text-sm font-bold uppercase tracking-wider">Email/Username</th>
                    <th class="px-6 py-5 text-center text-sm font-bold uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($staffs as $index => $staff)
                <tr class="hover:bg-gray-50 transition-all group">
                    <td class="px-6 py-5 text-sm text-gray-600 font-medium text-center">{{ $index + 1 }}</td>
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center text-emerald-700 font-bold">
                                {{ substr($staff->name, 0, 1) }}
                            </div>
                            <span class="font-bold text-gray-900">{{ $staff->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-5 text-sm text-gray-700 font-mono">{{ $staff->email }}</td>
                    <td class="px-6 py-5">
                        <div class="flex items-center justify-center gap-2">
                            <button onclick='openEditModal(@json($staff))' class="p-2.5 bg-emerald-50 text-emerald-600 rounded-xl hover:bg-[#1F653F] hover:text-white transition-all shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <form action="{{ route('admin.akademik_staff.delete', $staff->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus staf ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2.5 bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition-all shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Modal --}}
<div id="staff-modal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm" onclick="closeModal()"></div>
        <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-lg overflow-hidden transform transition-all">
            <div class="bg-gradient-to-r from-[#1F653F] to-[#2F8054] p-6 text-white">
                <h3 class="text-xl font-bold" id="modal-title">Tambah Staf Akademik</h3>
            </div>
            <form id="staff-form" action="{{ route('admin.akademik_staff.store') }}" method="POST" class="p-6">
                @csrf
                <div id="method-container"></div>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="nama" required class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 focus:border-[#1F653F] focus:outline-none transition-all">
                    </div>
                    <div id="email-group">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Email/Username</label>
                        <input type="email" name="email" id="email-field" class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 focus:border-[#1F653F] focus:outline-none transition-all disabled:bg-gray-50" placeholder="Otomatis: nama.staf@wbi.ac.id">
                        <p id="email-hint" class="text-[10px] text-blue-600 mt-1 italic">Akan digenerate otomatis berdasarkan nama.</p>
                    </div>
                    <div id="password-group">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Password</label>
                        <input type="password" name="password" id="password-field" class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 focus:border-[#1F653F] focus:outline-none transition-all">
                        <p id="password-hint" class="text-xs text-blue-600 mt-1 italic">Default: 12345678</p>
                    </div>
                </div>
                <div class="mt-8 flex gap-3">
                    <button type="button" onclick="closeModal()" class="flex-1 px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-xl font-bold hover:bg-gray-50 transition-all">Batal</button>
                    <button type="submit" class="flex-1 px-6 py-3 bg-[#1F653F] text-white rounded-xl font-bold hover:bg-[#2F8054] transition-all shadow-lg">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function openAddModal() {
        document.getElementById('modal-title').textContent = 'Tambah Staf Akademik';
        document.getElementById('staff-form').action = "{{ route('admin.akademik_staff.store') }}";
        document.getElementById('method-container').innerHTML = '';
        
        // Hide/Setup fields for creation
        document.getElementById('email-field').required = false;
        document.getElementById('email-field').disabled = true;
        document.getElementById('email-field').placeholder = "Otomatis: nama.staf@wbi.ac.id";
        document.getElementById('email-hint').classList.remove('hidden');
        
        document.getElementById('password-field').required = false;
        document.getElementById('password-group').classList.add('hidden');
        
        document.getElementById('staff-modal').classList.remove('hidden');
    }

    function openEditModal(staff) {
        document.getElementById('modal-title').textContent = 'Edit Staf Akademik';
        document.getElementById('staff-form').action = `/admin/akademik-staff/${staff.id}`;
        document.getElementById('method-container').innerHTML = '@method("PUT")';
        
        // Show/Setup fields for edit
        document.getElementById('email-field').required = true;
        document.getElementById('email-field').disabled = false;
        document.getElementById('email-field').placeholder = "";
        document.getElementById('email-hint').classList.add('hidden');
        
        document.getElementById('password-group').classList.remove('hidden');
        document.getElementById('password-field').required = false;
        document.getElementById('password-hint').textContent = "Biarkan kosong jika tidak ingin mengubah password";
        document.getElementById('password-hint').classList.remove('hidden');
        
        const form = document.getElementById('staff-form');
        form.nama.value = staff.name;
        form.email.value = staff.email;

        document.getElementById('staff-modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('staff-modal').classList.add('hidden');
    }
</script>
@endpush
