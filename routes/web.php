<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GeoJsonController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\DemografiController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\PekerjaanController;
use App\Http\Controllers\PublicHomeController;

// Route::get('/welcome', function () {
//     return view('welcome');
// });

Route::get('/', [PublicHomeController::class, 'index']);
Route::get('/api/geojson/tanggetada', [GeoJsonController::class, 'getTanggetada']);
Route::get('/desa/{objectId}', [PublicHomeController::class, 'show'])->name('desa.show');
Route::get('/api/geojson/desa/{objectId}', [GeoJsonController::class, 'getDesa']);

Route::get('/daftar-desa', [KecamatanController::class, 'index']);

Route::get('/demografi/agama', [DemografiController::class, 'indexAgama']);
Route::get('/demografi/golongan-darah', [DemografiController::class, 'indexGolonganDarah']);
Route::get('/demografi/jenis-kelamin', [DemografiController::class, 'indexJenisKelamin']);
Route::get('/demografi/pekerjaan', [DemografiController::class, 'indexPekerjaan']);
Route::get('/demografi/pendidikan', [DemografiController::class, 'indexPendidikan']);


Route::middleware(['guest'])->group(function () {
    Route::get('/login', [SessionController::class, 'index'])->name('login');
    Route::post('/login', [SessionController::class, 'login'])->name('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin-dashboard', [AdminController::class, 'index']);

    Route::get('/admin-desa', [KecamatanController::class, 'indexAdmin'])->name('desa.index');
    Route::get('/admin-desa/tambah', [KecamatanController::class, 'create']);
    Route::post('/admin-desa/store', [KecamatanController::class, 'store'])->name('desa.store');
    Route::get('/admin-desa/{kode_desa}/edit', [KecamatanController::class, 'edit'])->name('desa.edit');
    Route::put('/admin-desa/{kode_desa}', [KecamatanController::class, 'update'])->name('desa.update');
    Route::delete('/admin-desa/{kode_desa}', [KecamatanController::class, 'destroy'])->name('desa.destroy');

    Route::get('/admin-jenis-pekerjaan', [PekerjaanController::class, 'indexAdmin'])->name('pekerjaan.index');
    Route::get('/admin-jenis-pekerjaan/tambah', [PekerjaanController::class, 'create']);
    Route::post('/admin-jenis-pekerjaan/store', [PekerjaanController::class, 'store'])->name('pekerjaan.store');
    Route::get('/admin-jenis-pekerjaan/{id}/edit', [PekerjaanController::class, 'edit'])->name('pekerjaan.edit');
    Route::put('/admin-jenis-pekerjaan/{id}', [PekerjaanController::class, 'update'])->name('pekerjaan.update');
    Route::delete('/admin-jenis-pekerjaan/{id}', [PekerjaanController::class, 'destroy'])->name('pekerjaan.destroy');

    Route::get('/families/search', [KeluargaController::class, 'search'])->name('families.search'); // ajax search
    Route::post('/families', [KeluargaController::class, 'store'])->name('families.store'); // ajax store (modal)

    Route::get('/admin-penduduk', [PendudukController::class, 'indexAdmin'])->name('penduduk.index');
    Route::get('/penduduk/create', [PendudukController::class, 'create'])->name('penduduk.create');
    Route::get('/penduduk/by-family/{id}', [PendudukController::class, 'byFamily']);
    Route::post('/penduduk', [PendudukController::class, 'store'])->name('penduduk.store');
    Route::get('/admin-penduduk/{penduduk}/edit', [PendudukController::class, 'edit'])->name('penduduk.edit');
    Route::put('/admin-penduduk/{penduduk}', [PendudukController::class, 'update'])->name('penduduk.update');
    Route::delete('/admin-penduduk/{penduduk}', [PendudukController::class, 'destroy'])->name('penduduk.destroy');

    Route::get('/api/pekerjaan', function () {
        return \App\Models\Pekerjaan::select('id', 'nama_pekerjaan as nama')->get();
    });

    Route::get('/admin-profile', [UserController::class, 'index'])->name('admin-profile.index');
    Route::put('/admin-profile/update-password', [UserController::class, 'updatePassword'])->name('admin-profile.updatePassword');
    Route::post('/logout', [SessionController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin-acc-manage', [UserController::class, 'indexAccManage'])->name('admin-acc-manage.index');
    Route::get('/admin-acc-manage/create', [UserController::class, 'createAcc'])->name('admin-acc-manage.create');
    Route::post('/admin-acc-manage/store', [UserController::class, 'storeAcc'])->name('admin-acc-manage.store');
    // Route::get('/admin-acc-manage/{users}/edit', [UserController::class, 'editAcc'])->name('admin-acc-manage.edit');
    // Route::put('/admin-acc-manage/{users}', [UserController::class, 'updateAcc'])->name('admin-acc-manage.update');
    Route::delete('/admin-acc-manage/{user}', [UserController::class, 'destroyAcc'])->name('admin-acc-manage.destroy');
});
