<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\RuteController;
use App\Http\Controllers\BusRuteController;
use App\Http\Controllers\HargaController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KursiBusController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\DetailPemesananController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\BusKelasController;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/get-harga/{id_kelas}', [DetailPemesananController::class, 'getHarga']);

// Bus Kelas Routes
Route::get('/bus-kelas/create', [BusKelasController::class, 'create'])->name('bus-kelas.create');
Route::post('/bus-kelas', [BusKelasController::class, 'store'])->name('bus-kelas.store');
Route::get('/bus-kelas', [BusKelasController::class, 'index'])->name('bus-kelas.index');
Route::delete('/bus-kelas/{id_bus}/{id_kelas}', [BusKelasController::class, 'destroy'])->name('bus-kelas.destroy');

// Pemesanan Routes
Route::resource('pemesanan', PemesananController::class);
Route::resource('detail_pemesanan', DetailPemesananController::class)->except(['show', 'edit', 'update']);
Route::get('detail_pemesanan/index/{id_pemesanan}', [DetailPemesananController::class, 'index'])->name('detail_pemesanan.index');
Route::get('detail_pemesanan/create/{id_pemesanan}', [DetailPemesananController::class, 'create'])->name('detail_pemesanan.create');
Route::post('detail_pemesanan/store/{id_pemesanan}', [DetailPemesananController::class, 'store'])->name('detail_pemesanan.store');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Pemesanan Routes
    Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan.index');
    Route::get('/pemesanan/create', [PemesananController::class, 'create'])->name('pemesanan.create');
    Route::post('/pemesanan', [PemesananController::class, 'store'])->name('pemesanan.store');
    Route::get('/pemesanan/{id}/edit', [PemesananController::class, 'edit'])->name('pemesanan.edit');
    Route::put('/pemesanan/{id}', [PemesananController::class, 'update'])->name('pemesanan.update');
    Route::delete('/pemesanan/{id}', [PemesananController::class, 'destroy'])->name('pemesanan.destroy');

    // Kursi Bus Routes
    Route::get('/kursibus', [KursiBusController::class, 'index'])->name('kursibus.index');
    Route::get('/kursibus/create', [KursiBusController::class, 'create'])->name('kursibus.create');
    Route::post('/kursibus', [KursiBusController::class, 'store'])->name('kursibus.store');
    Route::get('/kursibus/{id}/edit', [KursiBusController::class, 'edit'])->name('kursibus.edit');
    Route::put('/kursibus/{id}', [KursiBusController::class, 'update'])->name('kursibus.update');
    Route::delete('/kursibus/{id}', [KursiBusController::class, 'destroy'])->name('kursibus.destroy');

    // Jadwal Routes
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
    Route::get('/jadwal/create', [JadwalController::class, 'create'])->name('jadwal.create');
    Route::post('/jadwal', [JadwalController::class, 'store'])->name('jadwal.store');
    Route::get('/jadwal/{id}/edit', [JadwalController::class, 'edit'])->name('jadwal.edit');
    Route::put('/jadwal/{id}', [JadwalController::class, 'update'])->name('jadwal.update');
    Route::delete('/jadwal/{id}', [JadwalController::class, 'destroy'])->name('jadwal.destroy');

    // Harga Routes
    Route::get('/harga', [HargaController::class, 'index'])->name('harga.index');
    Route::get('/harga/create', [HargaController::class, 'create'])->name('harga.create');
    Route::post('/harga', [HargaController::class, 'store'])->name('harga.store');
    Route::get('/harga/{id}/edit', [HargaController::class, 'edit'])->name('harga.edit');
    Route::put('/harga/{id}', [HargaController::class, 'update'])->name('harga.update');
    Route::delete('/harga/{id}', [HargaController::class, 'destroy'])->name('harga.destroy');
});

// Admin Routes (with role middleware)
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Bus Rute Routes
    Route::resource('bus-rute', BusRuteController::class)->parameters([
        'bus-rute' => 'id_bus_rute',
    ]);
    Route::get('/bus-rute/{id_bus_rute}/edit', [BusRuteController::class, 'edit'])->name('bus_rute.edit');
    Route::put('/bus-rute/{id_bus_rute}', [BusRuteController::class, 'update'])->name('bus_rute.update');
    Route::delete('/bus-rute/{id_bus_rute}', [BusRuteController::class, 'destroy'])->name('bus_rute.destroy');

    // Rute Routes
    Route::get('/rute', [RuteController::class, 'index'])->name('rute.index');
    Route::get('/rute/create', [RuteController::class, 'create'])->name('rute.create');
    Route::post('/rute', [RuteController::class, 'store'])->name('rute.store');
    Route::get('/rute/{id}/edit', [RuteController::class, 'edit'])->name('rute.edit');
    Route::put('/rute/{id}', [RuteController::class, 'update'])->name('rute.update');
    Route::delete('/rute/{id}', [RuteController::class, 'destroy'])->name('rute.destroy');

    // Kelas Routes
    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
    Route::get('/kelas/create', [KelasController::class, 'create'])->name('kelas.create');
    Route::post('/kelas', [KelasController::class, 'store'])->name('kelas.store');
    Route::get('/kelas/{id}/edit', [KelasController::class, 'edit'])->name('kelas.edit');
    Route::put('/kelas/{id}', [KelasController::class, 'update'])->name('kelas.update');
    Route::delete('/kelas/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');

    // Users Management Routes
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::delete('/users/{id}', [AdminController::class, 'destroy'])->name('users.destroy');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
