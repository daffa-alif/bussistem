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

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home Page (Welcome Page)
Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Protected Routes (User Role-Based)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Ticket Booking Routes
    Route::resource('pemesanan', PemesananController::class);
    Route::get('detail_pemesanan/index/{id_pemesanan}', [DetailPemesananController::class, 'index'])->name('detail_pemesanan.index');
    Route::get('detail_pemesanan/create/{id_pemesanan}', [DetailPemesananController::class, 'create'])->name('detail_pemesanan.create');
    Route::post('detail_pemesanan/store/{id_pemesanan}', [DetailPemesananController::class, 'store'])->name('detail_pemesanan.store');
    Route::get('/get-harga/{id_kelas}', [DetailPemesananController::class, 'getHarga']);
});

/*
|--------------------------------------------------------------------------
| Admin-Only Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    // User Management
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::delete('/users/{id}', [AdminController::class, 'destroy'])->name('users.destroy');

    // Bus Management
    Route::prefix('bus')->group(function () {
        Route::get('/', [BusController::class, 'index'])->name('bus.index');
        Route::get('/create', [BusController::class, 'create'])->name('bus.create');
        Route::post('/store', [BusController::class, 'store'])->name('bus.store');
        Route::get('/{id}/edit', [BusController::class, 'edit'])->name('bus.edit');
        Route::put('/{id}', [BusController::class, 'update'])->name('bus.update');
        Route::delete('/{id}', [BusController::class, 'destroy'])->name('bus.destroy');
    });

    // Kelas Management
    Route::resource('kelas', KelasController::class);

    // Rute Management
    Route::resource('rute', RuteController::class);

    // Bus-Rute Management
    Route::resource('bus-rute', BusRuteController::class)->parameters(['bus-rute' => 'id_bus_rute']);

    // Kursi Bus Management
    Route::resource('kursibus', KursiBusController::class);

    // Harga Management
    Route::resource('harga', HargaController::class);

    // Jadwal Management
    Route::resource('jadwal', JadwalController::class);

    // Bus-Kelas Management
    Route::get('/bus-kelas', [BusKelasController::class, 'index'])->name('bus-kelas.index');
    Route::get('/bus-kelas/create', [BusKelasController::class, 'create'])->name('bus-kelas.create');
    Route::post('/bus-kelas', [BusKelasController::class, 'store'])->name('bus-kelas.store');
    Route::delete('/bus-kelas/{id_bus}/{id_kelas}', [BusKelasController::class, 'destroy'])->name('bus-kelas.destroy');
});

/*
|--------------------------------------------------------------------------
| Search Route (Open to Authenticated Users)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->get('/search', [SearchController::class, 'search'])->name('search');
