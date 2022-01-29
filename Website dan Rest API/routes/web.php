<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{DashboardController as DashAdmin,KelasController as KelasAdmin,MapelController as MapelAdmin, JadwalController as JadAdmin,GuruController as GuruAdmin};
use App\Http\Controllers\Guru\{DashboardController as DashGuru,MateriController as MatGuru,KelasController as KelasGuru,SiswaController as SiswaGuru, MapelController as MapelGuru, TugasController as TugasGuru,KuisController as KuisGuru};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/login');

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');
Route::group(['middleware' => ['web','auth','roles']],function() {

    /** ROLE:GURU */
    Route::group(['roles' => 'guru'], function () {
        Route::get('/guru/dashboard', [DashGuru::class, 'index'])->name('guru.dashboard');
        /** Materi */
        Route::get('/guru/materi', [MatGuru::class, 'index'])->name('guru.materi');
        /** Kelas */
        Route::get('/guru/kelas', [KelasGuru::class, 'index'])->name('guru.kelas');
        Route::get('/guru/{id}/kelas/siswa', [SiswaGuru::class, 'index'])->name('guru.siswa');

        /** Mapel */
        Route::get('/guru/mapel', [MapelGuru::class, 'index'])->name('guru.mapel');
        Route::get('/guru/tugas', [TugasGuru::class, 'index'])->name('guru.tugas');
        Route::get('/guru/kuis', [KuisGuru::class, 'index'])->name('guru.kuis');
    });



    /** ROLE: ADMIN */
    Route::group(['roles' => 'admin'], function () {

        Route::get('/admin/dashboard', [DashAdmin::class, 'index'])->name('admin.dashboard');

        /** Guru */
        Route::get('/admin/guru', [GuruAdmin::class, 'index'])->name('admin.guru');
        Route::post('/admin/guru', [GuruAdmin::class, 'save'])->name('admin.saveguru');
        Route::get('/admin/guru/add', [GuruAdmin::class, 'create'])->name('admin.addguru');

        /** Kelas */
        Route::get('/admin/kelas', [KelasAdmin::class, 'index'])->name('admin.kelas');
        Route::get('/admin/kelas/add', [KelasAdmin::class, 'create'])->name('admin.addkelas');
        Route::get('/admin/kelas/{id}/edit', [KelasAdmin::class, 'edit'])->name('admin.editkelas');
        Route::post('/admin/kelas', [KelasAdmin::class, 'save'])->name('admin.savekelas');
        Route::patch('/admin/kelas', [KelasAdmin::class, 'update'])->name('admin.updatekelas');
        Route::delete('/admin/kelas', [KelasAdmin::class, 'destroy'])->name('admin.deletekelas');

        /** Mata pelajaran */
        Route::get('/admin/matapelajaran', [MapelAdmin::class, 'index'])->name('admin.mapel');
        Route::post('/admin/matapelajaran', [MapelAdmin::class, 'save'])->name('admin.savemapel');
        Route::patch('/admin/matapelajaran', [MapelAdmin::class, 'update'])->name('admin.updatemapel');
        Route::delete('/admin/matapelajaran', [MapelAdmin::class, 'destroy'])->name('admin.deletemapel');
        Route::get('/admin/matapelajaran/{id}/edit', [MapelAdmin::class, 'edit'])->name('admin.editmapel');
        Route::get('/admin/matapelajaran/add', [MapelAdmin::class, 'create'])->name('admin.addmapel');

        /** Jadwal */
        Route::get('/admin/jadwal', [JadAdmin::class, 'index'])->name('admin.jadwal');
        Route::post('/admin/jadwal', [JadAdmin::class, 'save'])->name('admin.savejadwal');
        Route::patch('/admin/jadwal', [JadAdmin::class, 'update'])->name('admin.updatejadwal');
        Route::delete('/admin/jadwal', [JadAdmin::class, 'destroy'])->name('admin.deletejadwal');
        Route::get('/admin/jadwal/add', [JadAdmin::class, 'create'])->name('admin.addjadwal');
        Route::get('/admin/jadwal/{id}/edit', [JadAdmin::class, 'edit'])->name('admin.editjadwal');
    });
});

require __DIR__.'/auth.php';
