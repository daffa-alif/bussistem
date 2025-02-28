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

// Routes for BusKelas
Route::get('/bus-kelas/create', [BusKelasController::class, 'create'])->name('bus-kelas.create');
Route::post('/bus-kelas', [BusKelasController::class, 'store'])->name('bus-kelas.store');
Route::get('/bus-kelas', [BusKelasController::class, 'index'])->name('bus-kelas.index');
Route::delete('/bus-kelas/{id_bus}/{id_kelas}', [BusKelasController::class, 'destroy'])->name('bus-kelas.destroy');

// Search and Harga Routes
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/get-harga/{id_kelas}', [DetailPemesananController::class, 'getHarga']);

// Pemesanan Routes
Route::resource('pemesanan', PemesananController::class);
Route::resource('detail_pemesanan', DetailPemesananController::class)->except(['show', 'edit', 'update']);
Route::get('detail_pemesanan/index/{id_pemesanan}', [DetailPemesananController::class, 'index'])->name('detail_pemesanan.index');
Route::get('detail_pemesanan/create/{id_pemesanan}', [DetailPemesananController::class, 'create'])->name('detail_pemesanan.create');
Route::post('detail_pemesanan/store/{id_pemesanan}', [DetailPemesananController::class, 'store'])->name('detail_pemesanan.store');

// Authenticated Routes for Pemesanan
Route::middleware('auth')->group(function () {
    Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan.index');
    Route::get('/pemesanan/create', [PemesananController::class, 'create'])->name('pemesanan.create');
    Route::post('/pemesanan', [PemesananController::class, 'store'])->name('pemesanan.store');
    Route::get('/pemesanan/{id}/edit', [PemesananController::class, 'edit'])->name('pemesanan.edit');
    Route::put('/pemesanan/{id}', [PemesananController::class, 'update'])->name('pemesanan.update');
    Route::delete('/pemesanan/{id}', [PemesananController::class, 'destroy'])->name('pemesanan.destroy');
});

// Routes for KursiBus
Route::middleware('auth')->group(function () {
    Route::get('/kursibus', [KursiBusController::class, 'index'])->name('kursibus.index');
    Route::get('/kursibus/create', [KursiBusController::class, 'create'])->name('kursibus.create');
    Route::post('/kursibus', [KursiBusController::class, 'store'])->name('kursibus.store');
    Route::get('/kursibus/{id}/edit', [KursiBusController::class, 'edit'])->name('kursibus.edit');
    Route::put('/kursibus/{id}', [KursiBusController::class, 'update'])->name('kursibus.update');
    Route::delete('/kursibus/{id}', [KursiBusController::class, 'destroy'])->name('kursibus.destroy');
});

// Routes for Jadwal
Route::middleware('auth')->group(function () {
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
    Route::get('/jadwal/create', [JadwalController::class, 'create'])->name('jadwal.create');
    Route::post('/jadwal', [JadwalController::class, 'store'])->name('jadwal.store');
    Route::get('/jadwal/{id}/edit', [JadwalController::class, 'edit'])->name('jadwal.edit');
    Route::put('/jadwal/{id}', [JadwalController::class, 'update'])->name('jadwal.update');
    Route::delete('/jadwal/{id}', [JadwalController::class, 'destroy'])->name('jadwal.destroy');
});

// Routes for Harga
Route::middleware('auth')->group(function () {
    Route::get('/harga', [HargaController::class, 'index'])->name('harga.index');
    Route::get('/harga/create', [HargaController::class, 'create'])->name('harga.create');
    Route::post('/harga', [HargaController::class, 'store'])->name('harga.store');
    Route::get('/harga/{id}/edit', [HargaController::class, 'edit'])->name('harga.edit');
    Route::put('/harga/{id}', [HargaController::class, 'update'])->name('harga.update');
    Route::delete('/harga/{id}', [HargaController::class, 'destroy'])->name('harga.destroy');
});

// Routes for BusRute with consistent parameter naming
Route::resource('bus-rute', BusRuteController::class)->parameters([
    'bus-rute' => 'id_bus_rute',
]);

// Routes for BusRute operations
Route::middleware('auth')->group(function () {
    Route::get('/bus-rute', [BusRuteController::class, 'index'])->name('bus_rute.index');
    Route::get('/bus-rute/create', [BusRuteController::class, 'create'])->name('bus_rute.create');
    Route::post('/bus-rute', [BusRuteController::class, 'store'])->name('bus_rute.store');
    Route::put('/bus-rute/{id_bus_rute}', [BusRuteController::class, 'update'])->name('bus_rute.update');
    Route::delete('/bus-rute/{id_bus_rute}', [BusRuteController::class, 'destroy'])->name('bus_rute.destroy');
});

// Routes for Rute
Route::middleware('auth')->group(function () {
    Route::get('/rute', [RuteController::class, 'index'])->name('rute.index');
    Route::get('/rute/create', [RuteController::class, 'create'])->name('rute.create');
    Route::post('/rute', [RuteController::class, 'store'])->name('rute.store');
    Route::get('/rute/{id}/edit', [RuteController::class, 'edit'])->name('rute.edit');
    Route::put('/rute/{id}', [RuteController::class, 'update'])->name('rute.update');
    Route::delete('/rute/{id}', [RuteController::class, 'destroy'])->name('rute.destroy');
});

// Routes for Kelas
Route::middleware('auth')->group(function () {
    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
    Route::get('/kelas/create', [KelasController::class, 'create'])->name('kelas.create');
    Route::post('/kelas', [KelasController::class, 'store'])->name('kelas.store');
    Route::get('/kelas/{id}/edit', [KelasController::class, 'edit'])->name('kelas.edit');
    Route::put('/kelas/{id}', [KelasController::class, 'update'])->name('kelas.update');
    Route::delete('/kelas/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');
});

// Routes for Users and Admin only
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::delete('/users/{id}', [AdminController::class, 'destroy'])->name('users.destroy');
});

// Routes for Bus (Admin)
Route::prefix('bus')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [BusController::class, 'index'])->name('bus.index');
    Route::get('/create', [BusController::class, 'create'])->name('bus.create');
    Route::post('/store', [BusController::class, 'store'])->name('bus.store');
    Route::get('/{id}/edit', [BusController::class, 'edit'])->name('bus.edit');
    Route::put('/{id}', [BusController::class, 'update'])->name('bus.update');
    Route::delete('/{id}', [BusController::class, 'destroy'])->name('bus.destroy');
});

// Route for Dashboard (Admin only)
Route::middleware(['auth', 'role:admin'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Route for Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Home Route (Welcome Page)
Route::get('/', function () {
    return view('welcome');
});
