<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DemografiController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\PekerjaanController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

// Route::get('/welcome', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('dashboard', ["title" => "Dashboard"]);
});

Route::get('/daftar-kecamatan', [KecamatanController::class, 'index']);

Route::get('/demografi/agama', [DemografiController::class, 'indexAgama']);
Route::get('/demografi/golongan-darah', [DemografiController::class, 'indexGolonganDarah']);
Route::get('/demografi/jenis-kelamin', [DemografiController::class, 'indexJenisKelamin']);
Route::get('/demografi/pekerjaan', [DemografiController::class, 'indexPekerjaan']);
Route::get('/demografi/pendidikan', [DemografiController::class, 'indexPendidikan']);


Route::middleware(['guest'])->group(function () {
    Route::get('/login', [SessionController::class, 'index'])->name('login');;
    Route::post('/login', [SessionController::class, 'login'])->name('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin-dashboard', [AdminController::class, 'index']);

    Route::get('/admin-kecamatan', [KecamatanController::class, 'indexAdmin'])->name('kecamatan.index');
    Route::get('/admin-kecamatan/tambah', [KecamatanController::class, 'create']);
    Route::post('/admin-kecamatan/store', [KecamatanController::class, 'store'])->name('kecamatan.store');
    Route::get('/admin-kecamatan/{kode_kecamatan}/edit', [KecamatanController::class, 'edit'])->name('kecamatan.edit');
    Route::put('/admin-kecamatan/{kode_kecamatan}', [KecamatanController::class, 'update'])->name('kecamatan.update');
    Route::delete('/admin-kecamatan/{kode_kecamatan}', [KecamatanController::class, 'destroy'])->name('kecamatan.destroy');

    Route::get('/admin-jenis-pekerjaan', [PekerjaanController::class, 'indexAdmin']);
    Route::get('/admin-penduduk', [PendudukController::class, 'indexAdmin']);
    Route::post('/logout', [SessionController::class, 'logout'])->name('logout');
});
