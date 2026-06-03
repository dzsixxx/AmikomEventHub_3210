<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\CategoryController; // Pastikan ini ada

// ==========================================
// USER AREA ROUTES (Publik & Bebas Akses)
// ==========================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/event/{id}', [EventController::class, 'show'])->name('events.show');
Route::get('/checkout', [EventController::class, 'checkout'])->name('checkout');
Route::get('/my-ticket', [EventController::class, 'ticket'])->name('ticket');


// ==========================================
// ADMIN AREA ROUTES
// ==========================================
Route::prefix('admin')->name('admin.')->group(function () {
    
    // Mencegah error 404 jika admin hanya mengetik /admin di URL
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });
    
    // Rute Login & Logout (Tidak dilindungi middleware, agar admin bisa masuk)
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // MENGAMANKAN ROUTE ADMINISTRASI DI BALIK TEMBOK (Middleware)
    // Hanya yang sudah login ('auth') DAN role-nya admin ('admin') yang bisa mengakses rute di bawah ini
    Route::middleware(['auth', 'admin'])->group(function () {
        
        // Dashboard Admin
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Manajemen Event & Transaksi
        Route::resource('events', AdminEventController::class);
        Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
        
        // Manajemen Kategori 
        Route::resource('categories', CategoryController::class);

        // Manajemen Partner 
        Route::get('/partners', [PartnerController::class, 'index'])->name('partners.index');
        Route::post('/partners', [PartnerController::class, 'store'])->name('partners.store');
        Route::put('/partners/{partner}', [PartnerController::class, 'update'])->name('partners.update');
        Route::delete('/partners/{partner}', [PartnerController::class, 'destroy'])->name('partners.destroy');
    });
});