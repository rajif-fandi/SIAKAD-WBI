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
use FontLib\Table\Type\name;

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
    Route::get('/dosen/profilDosen', [App\Http\Controllers\Dosen\ProfileController::class, 'index'])->name('dosen.profilDosen');
    Route::post('/dosen/profilDosen', [App\Http\Controllers\Dosen\ProfileController::class, 'update'])->name('dosen.profilDosen.update');
    Route::post('/dosen/profilDosen/password', [App\Http\Controllers\Dosen\ProfileController::class, 'changePassword'])->name('dosen.profilDosen.password');
});


// Admin Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboardAdmin', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('admin.dashboardAdmin');

    // Kelola Mahasiswa
    Route::get('/admin/mahasiswa', [App\Http\Controllers\Admin\AdminController::class, 'indexMahasiswa'])->name('admin.mahasiswa.mahasiswa');
    Route::get('/admin/mahasiswa/form', [App\Http\Controllers\Admin\AdminController::class, 'createMahasiswa'])->name('admin.mahasiswa.form');
    Route::post('/admin/mahasiswa/store', [App\Http\Controllers\Admin\AdminController::class, 'storeMahasiswa'])->name('admin.mahasiswa.store');
    Route::get('/admin/mahasiswa/{id}/edit', [App\Http\Controllers\Admin\AdminController::class, 'editMahasiswa'])->name('admin.mahasiswa.edit');
    Route::put('/admin/mahasiswa/{id}/update', [App\Http\Controllers\Admin\AdminController::class, 'updateMahasiswa'])->name('admin.mahasiswa.update');
    Route::delete('/admin/mahasiswa/{id}/delete', [App\Http\Controllers\Admin\AdminController::class, 'destroyMahasiswa'])->name('admin.mahasiswa.delete');
    Route::get('/admin/mahasiswa/aktivasiAkun', [App\Http\Controllers\Admin\AdminController::class, 'indexAktivasiAkun'])->name('admin.mahasiswa.aktivasiAkun');
    Route::post('/admin/mahasiswa/generate', [App\Http\Controllers\Admin\AdminController::class, 'generateAkun'])->name('admin.mahasiswa.generate');

    // Kelola Dosen
    Route::get('/admin/dosen', [App\Http\Controllers\Admin\AdminController::class, 'indexDosen'])->name('admin.dosen.index');
    Route::post('/admin/dosen/store', [App\Http\Controllers\Admin\AdminController::class, 'storeDosen'])->name('admin.dosen.store');
    Route::put('/admin/dosen/{id}', [App\Http\Controllers\Admin\AdminController::class, 'updateDosen'])->name('admin.dosen.update');
    Route::delete('/admin/dosen/{id}', [App\Http\Controllers\Admin\AdminController::class, 'destroyDosen'])->name('admin.dosen.delete');

    // Kelola Staf Akademik
    Route::get('/admin/akademik-staff', [App\Http\Controllers\Admin\AdminController::class, 'indexAkademikStaff'])->name('admin.akademik_staff.index');
    Route::post('/admin/akademik-staff/store', [App\Http\Controllers\Admin\AdminController::class, 'storeAkademikStaff'])->name('admin.akademik_staff.store');
    Route::put('/admin/akademik-staff/{id}', [App\Http\Controllers\Admin\AdminController::class, 'updateAkademikStaff'])->name('admin.akademik_staff.update');
    Route::delete('/admin/akademik-staff/{id}', [App\Http\Controllers\Admin\AdminController::class, 'destroyAkademikStaff'])->name('admin.akademik_staff.delete');

    // Admin Profile
    Route::get('/admin/profile', [App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('admin.profile');
    Route::post('/admin/profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('admin.profile.update');
    Route::post('/admin/profile/password', [App\Http\Controllers\Admin\ProfileController::class, 'changePassword'])->name('admin.profile.password');
});

//Akademik ROUTES
Route::middleware(['auth', 'role:akademik'])->group(function () {
    Route::get('/akademik/dashboardAkademik', [App\Http\Controllers\Akademik\AkademikController::class, 'dashboard'])->name('akademik.dashboardAkademik');

    //Kelola Ruangan
    Route::get('/akademik/ruangan', [App\Http\Controllers\Akademik\AkademikController::class, 'indexRuangan'])->name('akademik.ruangan.index');
    Route::post('/akademik/ruangan', [App\Http\Controllers\Akademik\AkademikController::class, 'storeRuangan'])->name('akademik.ruangan.store');
    Route::put('/akademik/ruangan/{id}', [App\Http\Controllers\Akademik\AkademikController::class, 'updateRuangan'])->name('akademik.ruangan.update');
    Route::delete('/akademik/ruangan/{id}', [App\Http\Controllers\Akademik\AkademikController::class, 'destroyRuangan'])->name('akademik.ruangan.delete');

    //Kelola Prodi
    Route::get('/akademik/prodi', [App\Http\Controllers\Akademik\AkademikController::class, 'indexProdi'])->name('akademik.prodi.index');
    Route::post('/akademik/prodi', [App\Http\Controllers\Akademik\AkademikController::class, 'storeProdi'])->name('akademik.prodi.store');
    Route::put('/akademik/prodi/{id}', [App\Http\Controllers\Akademik\AkademikController::class, 'updateProdi'])->name('akademik.prodi.update');
    Route::delete('/akademik/prodi/{id}', [App\Http\Controllers\Akademik\AkademikController::class, 'destroyProdi'])->name('akademik.prodi.delete');

    //kelola matkul
    Route::get('/akademik/matakuliah', [App\Http\Controllers\Akademik\AkademikController::class, 'indexMatakuliah'])->name('akademik.matakuliah.index');
    Route::post('/akademik/matakuliah', [App\Http\Controllers\Akademik\AkademikController::class, 'storeMatakuliah'])->name('akademik.matakuliah.store');
    Route::put('/akademik/matakuliah/{id}', [App\Http\Controllers\Akademik\AkademikController::class, 'updateMatakuliah'])->name('akademik.matakuliah.update');
    Route::delete('/akademik/matakuliah/{id}', [App\Http\Controllers\Akademik\AkademikController::class, 'destroyMatakuliah'])->name('akademik.matakuliah.delete');

    //kelola kurikulum
    Route::get('/akademik/kurikulum', [App\Http\Controllers\Akademik\AkademikController::class, 'indexKurikulum'])->name('akademik.kurikulum.index');
    Route::post('/akademik/kurikulum', [App\Http\Controllers\Akademik\AkademikController::class, 'storeKurikulum'])->name('akademik.kurikulum.store');
    Route::get('/akademik/kurikulum/{id}', [App\Http\Controllers\Akademik\AkademikController::class, 'showKurikulum'])->name('akademik.kurikulum.show');
    Route::put('/akademik/kurikulum/{id}', [App\Http\Controllers\Akademik\AkademikController::class, 'updateKurikulum'])->name('akademik.kurikulum.update');
    Route::delete('/akademik/kurikulum/{id}', [App\Http\Controllers\Akademik\AkademikController::class, 'destroyKurikulum'])->name('akademik.kurikulum.delete');
    Route::post('/akademik/kurikulum/{id}/attach', [App\Http\Controllers\Akademik\AkademikController::class, 'attachMatakuliah'])->name('akademik.kurikulum.attach');
    Route::delete('/akademik/kurikulum/{id}/detach/{matkul_id}', [App\Http\Controllers\Akademik\AkademikController::class, 'detachMatakuliah'])->name('akademik.kurikulum.detach');

    //Kelola Kelas
    Route::get('/akademik/kelas', [App\Http\Controllers\Akademik\AkademikController::class, 'indexKelas'])->name('akademik.kelas.index');
    Route::post('/akademik/kelas', [App\Http\Controllers\Akademik\AkademikController::class, 'storeKelas'])->name('akademik.kelas.store');
    Route::put('/akademik/kelas/{id}', [App\Http\Controllers\Akademik\AkademikController::class, 'updateKelas'])->name('akademik.kelas.update');
    Route::delete('/akademik/kelas/{id}', [App\Http\Controllers\Akademik\AkademikController::class, 'destroyKelas'])->name('akademik.kelas.delete');

    //Kelola Jadwal
    Route::get('/akademik/jadwal', [App\Http\Controllers\Akademik\AkademikController::class, 'indexJadwal'])->name('akademik.jadwal.index');
    Route::post('/akademik/jadwal', [App\Http\Controllers\Akademik\AkademikController::class, 'storeJadwal'])->name('akademik.jadwal.store');
    Route::put('/akademik/jadwal/{id}', [App\Http\Controllers\Akademik\AkademikController::class, 'updateJadwal'])->name('akademik.jadwal.update');
    Route::delete('/akademik/jadwal/{id}', [App\Http\Controllers\Akademik\AkademikController::class, 'destroyJadwal'])->name('akademik.jadwal.delete');

    // List Views (Read Only)
    Route::get('/akademik/dosen', [App\Http\Controllers\Akademik\AkademikController::class, 'listDosen'])->name('akademik.dosen.list');
    Route::get('/akademik/mahasiswa', [App\Http\Controllers\Akademik\AkademikController::class, 'listMahasiswa'])->name('akademik.mahasiswa.list');

    // Profile
    Route::get('/akademik/profile', [App\Http\Controllers\Akademik\ProfileController::class, 'index'])->name('akademik.profile');
    Route::post('/akademik/profile', [App\Http\Controllers\Akademik\ProfileController::class, 'update'])->name('akademik.profile.update');
    Route::post('/akademik/profile/password', [App\Http\Controllers\Akademik\ProfileController::class, 'changePassword'])->name('akademik.profile.password');
});