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

// Public routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/search', [SearchController::class, 'search'])->name('search');

// Auth routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Dashboard route
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Admin routes - use role middleware for admin access
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Users management
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::delete('/users/{id}', [AdminController::class, 'destroy'])->name('users.destroy');
    
    // Bus management
    Route::prefix('bus')->group(function () {
        Route::get('/', [BusController::class, 'index'])->name('bus.index');
        Route::get('/create', [BusController::class, 'create'])->name('bus.create');
        Route::post('/store', [BusController::class, 'store'])->name('bus.store');
        Route::get('/{id}/edit', [BusController::class, 'edit'])->name('bus.edit');
        Route::put('/{id}', [BusController::class, 'update'])->name('bus.update');
        Route::delete('/{id}', [BusController::class, 'destroy'])->name('bus.destroy');
    });

    // Bus Kelas management
    Route::get('/bus-kelas', [BusKelasController::class, 'index'])->name('bus-kelas.index');
    Route::get('/bus-kelas/create', [BusKelasController::class, 'create'])->name('bus-kelas.create');
    Route::post('/bus-kelas', [BusKelasController::class, 'store'])->name('bus-kelas.store');
    Route::delete('/bus-kelas/{id_bus}/{id_kelas}', [BusKelasController::class, 'destroy'])->name('bus-kelas.destroy');

    // Routes management
    Route::resource('bus-rute', BusRuteController::class)->parameters(['bus-rute' => 'id_bus_rute']);
    Route::delete('/bus-rute/{id_bus_rute}', [BusRuteController::class, 'destroy'])->name('bus_rute.destroy');

    // Other admin routes (example for Harga, Rute, Kelas)
    Route::resource('harga', HargaController::class);
    Route::resource('rute', RuteController::class);
    Route::resource('kelas', KelasController::class);
});

// Authenticated user routes
Route::middleware('auth')->group(function () {
    // Pemesanan (Booking) routes
    Route::resource('pemesanan', PemesananController::class);
    Route::resource('detail_pemesanan', DetailPemesananController::class)->except(['show', 'edit', 'update']);
    Route::get('detail_pemesanan/index/{id_pemesanan}', [DetailPemesananController::class, 'index'])->name('detail_pemesanan.index');
    Route::get('detail_pemesanan/create/{id_pemesanan}', [DetailPemesananController::class, 'create'])->name('detail_pemesanan.create');
    Route::post('detail_pemesanan/store/{id_pemesanan}', [DetailPemesananController::class, 'store'])->name('detail_pemesanan.store');
    
    // Kursi Bus routes
    Route::resource('kursibus', KursiBusController::class);
    
    // Jadwal (Schedule) routes
    Route::resource('jadwal', JadwalController::class);
    
    // Harga (Pricing) routes
    Route::resource('harga', HargaController::class);
    
    // Bus Rute routes
    Route::resource('bus-rute', BusRuteController::class);
    
    // Rute (Route) routes
    Route::resource('rute', RuteController::class);
    
    // Kelas routes
    Route::resource('kelas', KelasController::class);
});

Route::get('/get-harga/{id_kelas}', [DetailPemesananController::class, 'getHarga']);
