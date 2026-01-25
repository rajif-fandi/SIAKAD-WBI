<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dosen;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $dosen = Dosen::with('prodi')->where('user_id', $user->id)->first();

        if (!$dosen) {
            return redirect('/dosen/dashboard')->with('error', 'Data profil tidak ditemukan.');
        }

        return view('dosen.profilDosen', compact('dosen', 'user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $dosen = Dosen::where('user_id', $user->id)->first();

        if (!$dosen) {
            return back()->with('error', 'Data tidak ditemukan.');
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:150',
            'gelar_depan' => 'nullable|string|max:50',
            'gelar_belakang' => 'nullable|string|max:50',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'nik' => 'nullable|string|max:20',
            'agama' => 'nullable|string|max:20',
            'status_perkawinan' => 'nullable|string|max:20',
            'no_hp' => 'nullable|string|max:30',
            'alamat_detail' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($dosen->foto) {
                Storage::disk('public')->delete($dosen->foto);
            }
            $path = $request->file('foto')->store('dosen/foto', 'public');
            $validated['foto'] = $path;
        }

        $dosen->update($validated);
        
        // Also update name in User table
        $user->update(['name' => $request->nama]);

        return back()->with('success', 'Profil Anda telah berhasil diperbarui.');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        Auth::user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Kata sandi berhasil diperbarui.');
    }
}
