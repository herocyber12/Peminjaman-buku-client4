<?php

use Illuminate\Support\Facades\Route;

use App\Models\Buku;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriConstoller;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\ReservasiController;
use App\Models\Reservasi;
use App\Models\Review;

use Illuminate\Support\Facades\DB;

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

Route::get('/', function () {
    return redirect()->route('daftar');
});


Route::get('/guest/login',function (){
    return view('pages.login');
});

Route::get('/guest/register',function (){
    return view('pages.registrasi');
});

Route::controller(GuestController::class)->group(function(){
    Route::post('ceklogin','ceklogin')->name('guest.ceklogin');
    Route::get('guest/logout','logout')->name('guest.logout');
    Route::post('guest/create','create')->name('guest.create');
});


Route::controller(LandingController::class)->group(function(){
    Route::get('daftar-buku','index')->name('daftar');
    Route::get('detail-buku/{id}','details')->name('detail-buku');
    Route::post('komentar','komentar')->name('komentar');
    Route::post('pinjam','pinjam')->name('pengajuan');
});

Route::controller(AuthController::class)->group(function (){
    Route::get('login', 'login')->name('login');
    Route::post('cek','cek')->name('cek');

    Route::get('register','register')->name('register');
    Route::post('create','create')->name('create');
    Route::post('logout', 'logout')->name('logout');
});
Route::middleware('auth')->group( function () {
    
    Route::get('/profil',function(){
        return view('dashboard.profil');
    });

    Route::controller(HomeController::class)->prefix('home')->group(function(){
        Route::get('/','index')->name('home');
    });

    Route::controller(BukuController::class)->prefix('buku')->group(function (){
        Route::get('/','index')->name('buku');
        Route::post('simpan','simpan')->name('buku.simpan');
        Route::get('hapus/{id}','hapus')->name('buku.hapus');
        Route::post('update/{id}','update')->name('buku.update');
    });

    Route::controller(KategoriConstoller::class)->prefix('kategori')->group(function (){
        Route::post('simpan','simpan')->name('kategori.simpan');
        Route::get('hapus/{id}','hapus')->name('kategori.hapus');
    });

    Route::controller(PenggunaController::class)->prefix('pengguna')->group(function (){
        Route::get('/','index')->name('pengguna');
        Route::post('update/{id}','update')->name('pengguna.update');
        Route::get('hapus/{id}','hapus')->name('pengguna.hapus');
    });

    Route::controller(ReservasiController::class)->prefix('reservasi')->group(function(){
        Route::get('/','index')->name('reservasi');
        Route::post('update/{id}','update')->name('reservasi.update');
        Route::get('logreservasi','logreservasi')->name('reservasi.riwayat');
    });
});