<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Mahasiswa\DashboardController;
use App\Http\Controllers\Mahasiswa\JadwalController;
use App\Http\Controllers\Mahasiswa\KrsController;
use App\Http\Controllers\Mahasiswa\KeberhasilanStudiController;
use App\Http\Controllers\Mahasiswa\KehadiranController;
use App\Http\Controllers\Mahasiswa\KonsultasiNilaiController;
use App\Http\Controllers\Mahasiswa\ProfileController;

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Mahasiswa Routes
Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    
    // Jadwal
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
    Route::post('/jadwal/join', [JadwalController::class, 'joinKelas'])->name('jadwal.join');

    // KRS
    Route::get('KRS', [KrsController::class, 'index'])->name('KRS.index');
    Route::get('KRS/create', [KrsController::class, 'create'])->name('KRS.create');
    Route::post('KRS', [KrsController::class, 'store'])->name('KRS.store');
    Route::get('KRS/{id}', [KrsController::class, 'show'])->name('KRS.show');

    // Keberhasilan Studi
    Route::get('keberhasilanStudi', [KeberhasilanStudiController::class, 'index'])->name('keberhasilanStudi.index');
    Route::get('keberhasilanStudi/export', [KeberhasilanStudiController::class, 'exportPdf'])->name('keberhasilanStudi.export');

    // Konsultasi Nilai
    Route::get('konsultasiNilai', [KonsultasiNilaiController::class, 'index'])->name('konsultasiNilai.index');
    
    // Kehadiran
    Route::get('kehadiran', [KehadiranController::class, 'index'])->name('kehadiran.index');

    // Profil
    Route::get('profilMahasiswa', [ProfileController::class, 'index'])->name('profilMahasiswa.index');
    Route::post('profilMahasiswa', [ProfileController::class, 'update'])->name('profilMahasiswa.update');
    Route::post('profilMahasiswa/password', [ProfileController::class, 'changePassword'])->name('profilMahasiswa.password');

    // Remaining student views
    Route::get('kuliahMahasiswa', [App\Http\Controllers\Mahasiswa\KuliahMahasiswaController::class, 'index'])->name('kuliahMahasiswa.index');
    Route::get('nilaiTransfer', function () { return view('nilaiTransfer.index'); })->name('nilaiTransfer.index');
    Route::get('pengajuanJudul', function () { return view('pengajuanJudul.index'); })->name('pengajuanJudul.index');

    // Arsip Nilai
    Route::get('arsip-nilai', [App\Http\Controllers\Mahasiswa\ArsipNilaiController::class, 'index'])->name('arsip-nilai.index');
    Route::get('arsip-nilai/{khs}', [App\Http\Controllers\Mahasiswa\ArsipNilaiController::class, 'show'])->name('arsip-nilai.show');
    Route::get('arsip-nilai/{khs}/export-pdf', [App\Http\Controllers\Mahasiswa\ArsipNilaiController::class, 'exportPdf'])->name('arsip-nilai.export');

    // Notifikasi
    Route::get('notifikasi', [App\Http\Controllers\Mahasiswa\NotifikasiController::class, 'index'])->name('notifikasi.index');
    Route::post('notifikasi/read-all', [App\Http\Controllers\Mahasiswa\NotifikasiController::class, 'markAllAsRead'])->name('notifikasi.readAll');
    Route::get('notifikasi/{id}/read', [App\Http\Controllers\Mahasiswa\NotifikasiController::class, 'read'])->name('notifikasi.read');
});

// Dosen Routes
Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('/dosen/dashboard', [App\Http\Controllers\Dosen\DashboardController::class, 'index'])->name('dosen.dashboard');
    Route::get('/dosen/jadwal', [App\Http\Controllers\Dosen\JadwalController::class, 'index'])->name('dosen.jadwal');
    Route::get('/dosen/jadwal/{id}/peserta', [App\Http\Controllers\Dosen\JadwalController::class, 'peserta'])->name('dosen.jadwal.peserta');
    Route::get('/dosen/jadwal/export-pdf', [App\Http\Controllers\Dosen\JadwalController::class, 'exportPdf'])->name('dosen.jadwal.pdf');
    Route::get('/dosen/pertemuan', [App\Http\Controllers\Dosen\PertemuanController::class, 'index'])->name('dosen.pertemuan.index');
    Route::get('/dosen/pertemuan/{pertemuan_id}/export-pdf', [App\Http\Controllers\Dosen\PertemuanController::class, 'exportPdf'])->name('dosen.pertemuan.export-pdf');
    Route::post('/dosen/pertemuan/{jadwal_id}/mulai', [App\Http\Controllers\Dosen\PertemuanController::class, 'mulaiKelas'])->name('dosen.pertemuan.mulai');
    Route::get('/dosen/pertemuan/{pertemuan_id}/presensi', [App\Http\Controllers\Dosen\PertemuanController::class, 'presensi'])->name('dosen.pertemuan.presensi');
    Route::post('/dosen/pertemuan/presensi/simpan', [App\Http\Controllers\Dosen\PertemuanController::class, 'simpanPresensi'])->name('dosen.pertemuan.presensi.simpan');
    Route::get('/dosen/KRSMahasiswa', [App\Http\Controllers\Dosen\KrsMahasiswaController::class, 'index'])->name('dosen.KRSMahasiswa');
    Route::post('/dosen/KRSMahasiswa/{id}/approve', [App\Http\Controllers\Dosen\KrsMahasiswaController::class, 'approve'])->name('dosen.KRSMahasiswa.approve');
    Route::post('/dosen/KRSMahasiswa/{id}/reject', [App\Http\Controllers\Dosen\KrsMahasiswaController::class, 'reject'])->name('dosen.KRSMahasiswa.reject');
    Route::get('/dosen/penilaian', [App\Http\Controllers\Dosen\PenilaianController::class, 'index'])->name('dosen.penilaian');
    Route::get('/dosen/penilaian/kelas/{id}', [App\Http\Controllers\Dosen\PenilaianController::class, 'kelas'])->name('dosen.penilaian.kelas');
    Route::post('/dosen/penilaian/kelas/{id}/weights', [App\Http\Controllers\Dosen\PenilaianController::class, 'updateWeights'])->name('dosen.penilaian.weights.update');
    Route::post('/dosen/penilaian/simpan', [App\Http\Controllers\Dosen\PenilaianController::class, 'store'])->name('dosen.penilaian.store');
    Route::get('/dosen/profilDosen', function () { return view('dosen.profilDosen'); })->name('dosen.profilDosen');
});
