<?php

use Illuminate\Support\Facades\Route;

/* halaman login */
Route::get('/', function () {
    return view('login');
});


Route::post('/login', function () {
    return redirect('/dashboard');
});

// dashboard
Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');

// jadwal
Route::get('/jadwal', function () {
    return view('jadwal.index');
})->name('jadwal.index');

// KRS
Route::get('KRS', function () {
    return view('KRS.index');
})->name('KRS.index');

//Keberhasilan Studi
Route::get('keberhasilanStudi', function () {
    return view(('keberhasilanStudi.index'));
})->name('keberhasilanStudi.index');

// Konsultasi Nilai
Route::get('konsultasiNilai', function () {
    return view(('konsultasiNilai.index'));
})->name('konsultasiNilai.index');

// Kehadiran
Route::get('kehadiran', function () {
    return view(('kehadiran.index'));
})->name('kehadiran.index');

// profil Mahaiswa
Route::get('profilMahasiswa', function () {
    return view(('profilMahasiswa.index'));
})->name('profilMahasiswa.index');