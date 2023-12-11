<?php

use App\Models\Keluhan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\SkpdController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\FuzzyController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\HalamanController;
use App\Http\Controllers\KeluhanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DataMasukController;
use App\Http\Controllers\IndikatorController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\GantiPasswordController;
use App\Http\Controllers\LaporanAnggotaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\NomorController;
use App\Http\Controllers\PengamananController;

Route::get('/', [LoginController::class, 'index']);
Route::get('/login', [LoginController::class, 'showlogin'])->name('login');
Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/tentangsipadu', [HalamanController::class, 'tentangsipadu']);
Route::get('/profilsatpol', [HalamanController::class, 'profilsatpol']);
Route::get('/kontaksatpol', [HalamanController::class, 'kontaksatpol']);

Route::group(['middleware' => ['auth', 'role:superadmin']], function () {
    Route::get('/beranda', [BerandaController::class, 'index']);
    Route::post('/beranda/url/update', [BerandaController::class, 'updateurl']);

    Route::get('/slideshow', [SlideController::class, 'index']);
    Route::get('/slideshow/edit/{id}', [SlideController::class, 'edit']);
    Route::post('/slideshow/edit/{id}', [SlideController::class, 'update']);

    Route::get('/link', [LinkController::class, 'index']);
    Route::get('/link/edit/{id}', [LinkController::class, 'edit']);
    Route::post('/link/edit/{id}', [LinkController::class, 'update']);

    Route::get('/profil', [HalamanController::class, 'profil']);
    Route::post('/profil', [HalamanController::class, 'updateProfil']);
    Route::get('/tentang', [HalamanController::class, 'tentang']);
    Route::post('/tentang', [HalamanController::class, 'updateTentang']);
    Route::get('/kontak', [HalamanController::class, 'kontak']);
    Route::post('/kontak', [HalamanController::class, 'updateKontak']);

    Route::get('/kategori', [KategoriController::class, 'kategori']);
    Route::get('/kategori/create', [KategoriController::class, 'kategoricreate']);
    Route::post('/kategori/create', [KategoriController::class, 'kategoristore']);
    Route::get('/kategori/edit/{id}', [KategoriController::class, 'kategoriedit']);
    Route::post('/kategori/edit/{id}', [KategoriController::class, 'kategoriupdate']);
    Route::get('/kategori/delete/{id}', [KategoriController::class, 'kategoridelete']);


    Route::get('/berita', [BeritaController::class, 'berita']);
    Route::get('/berita/create', [BeritaController::class, 'beritacreate']);
    Route::post('/berita/create', [BeritaController::class, 'beritastore']);
    Route::get('/berita/edit/{id}', [BeritaController::class, 'beritaedit']);
    Route::post('/berita/edit/{id}', [BeritaController::class, 'beritaupdate']);
    Route::get('/berita/delete/{id}', [BeritaController::class, 'beritadelete']);

    Route::get('/nomor', [NomorController::class, 'index']);
    Route::get('/nomor/create', [NomorController::class, 'create']);
    Route::post('/nomor/create', [NomorController::class, 'store']);
    Route::get('/nomor/edit/{id}', [NomorController::class, 'edit']);
    Route::post('/nomor/edit/{id}', [NomorController::class, 'update']);
    Route::get('/nomor/delete/{id}', [NomorController::class, 'delete']);

    Route::get('/pengamanan', [PengamananController::class, 'index']);
    Route::get('/pengamanan/create', [PengamananController::class, 'create']);
    Route::post('/pengamanan/create', [PengamananController::class, 'store']);
    Route::get('/pengamanan/edit/{id}', [PengamananController::class, 'edit']);
    Route::post('/pengamanan/edit/{id}', [PengamananController::class, 'update']);
    Route::get('/pengamanan/delete/{id}', [PengamananController::class, 'delete']);

    Route::get('/pegawai', [PegawaiController::class, 'pegawai']);
    Route::get('/pegawai/create', [PegawaiController::class, 'pegawaicreate']);
    Route::post('/pegawai/create', [PegawaiController::class, 'pegawaistore']);
    Route::get('/pegawai/edit/{id}', [PegawaiController::class, 'pegawaiedit']);
    Route::post('/pegawai/edit/{id}', [PegawaiController::class, 'pegawaiupdate']);
    Route::get('/pegawai/delete/{id}', [PegawaiController::class, 'pegawaidelete']);
    Route::get('/pegawai/akun/{id}', [PegawaiController::class, 'pegawaiakun']);
    Route::get('/pegawai/reset/{id}', [PegawaiController::class, 'pegawaireset']);

    Route::get('/laporananggota', [LaporanAnggotaController::class, 'index']);
    Route::get('/laporananggota/delete/{id}', [LaporanAnggotaController::class, 'delete']);

    Route::get('/data/masuk', [DataMasukController::class, 'index']);
    Route::get('/laporan', [LaporanController::class, 'index']);
    Route::get('/data/keluhanwa', [KeluhanController::class, 'keluhanwa']);
    Route::post('/data/keluhanwa/uploadbukti', [KeluhanController::class, 'uploadbukti']);
    Route::get('/data/keluhanwa/delete/{id}', [KeluhanController::class, 'delete']);
    Route::get('/data/keluhanwa/ubahstatusbaru/{id}', [KeluhanController::class, 'baru']);
    Route::get('/data/keluhanwa/ubahstatusdiproses/{id}', [KeluhanController::class, 'diproses']);
    Route::get('/data/keluhanwa/ubahstatusselesai/{id}', [KeluhanController::class, 'selesai']);

    Route::get('/data/masuk/kirim/{id}', [DataMasukController::class, 'kirim']);
    Route::get('/data/masuk/delete/{id}', [DataMasukController::class, 'delete']);
});

Route::group(['middleware' => ['auth', 'role:pegawai']], function () {
    Route::get('/pegawaisatpol', [BerandaController::class, 'pegawai']);
    Route::get('/pegawaisatpol/selesaikantugas/{id}', [BerandaController::class, 'finishTask']);
    Route::post('/pegawaisatpol/selesaikantugas/{id}', [BerandaController::class, 'selesaiTask']);
});


Route::group(['middleware' => ['auth', 'role:masyarakat']], function () {
    Route::get('/masyarakat', [BerandaController::class, 'masyarakat']);
    Route::get('/masyarakat/keluhan', [MasyarakatController::class, 'pilihkec']);
    Route::get('/masyarakat/keluhan/kecamatan', [MasyarakatController::class, 'pilihkel']);
    Route::post('/masyarakat/keluhan/kecamatan', [MasyarakatController::class, 'store']);
});

Route::group(['middleware' => ['auth', 'role:masyarakat|superadmin|pegawai']], function () {
    Route::get('/logout', [LogoutController::class, 'logout']);
    Route::get('/gantipassword', [GantiPasswordController::class, 'index']);
    Route::post('/gantipassword', [GantiPasswordController::class, 'update']);
});
