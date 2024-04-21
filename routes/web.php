<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\CobaController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\DaftarHadirController;
use App\Http\Controllers\RekapHarianController;


Route::view('/', 'welcome');

Route::view('/absensi', 'siswa.absen.absen');

// Middleware Akun Login
Route::view('siswa', 'siswa.beranda')
    ->middleware(['auth', 'verified','siswa'])
    ->name('siswa');

Route::view('admin', 'admin.Beranda')
    ->middleware(['auth', 'verified','admin'])
    ->name('admin');

Route::view('guru', 'guru.Beranda')
    ->middleware(['auth', 'verified','guru'])
    ->name('guru');

Route::view('profile', 'master.profile')
    ->middleware(['auth'])
    ->name('profile');

// CRUD Akun Admin
Route::resource('/admin-akun', \App\Http\Controllers\AdminController::class);
Route::delete('/admin/{id}', [AdminController::class, 'destroy']);

// CRUD Akun Guru Pembimbing
Route::resource('/guru-akun', \App\Http\Controllers\GuruController::class);
Route::delete('/guru/{id}', [GuruController::class, 'destroy']);

// CRUD Akun Siswa
Route::resource('/siswa-akun', \App\Http\Controllers\SiswaController::class);
Route::delete('/siswa/{id}', [SiswaController::class, 'destroy']);

// CRUD Kelas
Route::resource('/kelas', \App\Http\Controllers\KelasController::class);

// CRUD Lokasi
Route::resource('/lokasi', \App\Http\Controllers\LokasiController::class);

// Rekap Harian
Route::resource('/rekap', RekapHarianController::class);
Route::get('/filter-rekap', [RekapHarianController::class, 'filterData'])->name('filter.rekap');
Route::get('export',  [RekapHarianController::class, 'export_excel']);
Route::get('pdf', [RekapHarianController::class, 'pdf_generator_get'])->name('export.pdf');

// Filter Daftar Hadir
Route::resource('/daftar', \App\Http\Controllers\DaftarHadirController::class);
Route::get('/filter-data', [DaftarHadirController::class, 'filterData'])->name('filter.data');
Route::get('/lihat/{id}',  [DaftarHadirController::class, 'showBukti'])->name('lihat');


// CRUD Kegiatan Guru Pembimbing
Route::resource('/kegiatan', \App\Http\Controllers\KegiatanController::class);

// zABsen
Route::get('absen', [AbsensiController::class, 'index'])->name('absen');
Route::post('/absensi', [AbsensiController::class, 'store'])->name('absensi.store');

Route::get('Izin',  [IzinController::class, 'index'])->name('izin');
Route::post('/izinn', [IzinController::class, 'store'])->name('Izinn.store');

Route::post('/konfirmasi', [KegiatanController::class, 'konfirmasi'])->name('konfirmasi');

Route::get('/lihat-bukti/{id}',  [KegiatanController::class, 'showBukti'])->name('lihat_bukti');


Route::group(['middleware' => ['auth', 'checkrole:1,2,3']], function() {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/redirect', [AuthController::class, 'cek']);
});

require __DIR__.'/auth.php';
