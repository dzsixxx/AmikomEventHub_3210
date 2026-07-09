<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\MidtransWebhookController; // Controller Baru Webhook
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\CategoryController; 

// ==========================================
// USER AREA ROUTES (Publik & Bebas Akses)
// ==========================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

// RUTE CHECKOUT & PEMBAYARAN 
Route::get('/checkout/{event}', [CheckoutController::class, 'create'])->name('checkout.create');
Route::post('/checkout/{event}', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/payment/{order_id}', [CheckoutController::class, 'payment'])->name('checkout.payment');
Route::get('/success/{order_id}', [CheckoutController::class, 'success'])->name('checkout.success');

// PENTING: Rute Webhook Midtrans (Dipanggil oleh server Midtrans, bukan user)
Route::post('/midtrans/callback', [MidtransWebhookController::class, 'handle']);

Route::get('/my-ticket', [EventController::class, 'ticket'])->name('ticket');

// ==========================================
// ADMIN AREA ROUTES
// ==========================================
Route::prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/', function () { return redirect()->route('admin.dashboard'); });
    
    // Rute Login & Logout
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // MENGAMANKAN ROUTE ADMINISTRASI DI BALIK TEMBOK (Middleware)
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Manajemen Event, Transaksi, Kategori, Partner
        Route::resource('events', AdminEventController::class);
        Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
        Route::resource('categories', CategoryController::class);
        Route::get('/partners', [PartnerController::class, 'index'])->name('partners.index');
        Route::post('/partners', [PartnerController::class, 'store'])->name('partners.store');
        Route::put('/partners/{partner}', [PartnerController::class, 'update'])->name('partners.update');
        Route::delete('/partners/{partner}', [PartnerController::class, 'destroy'])->name('partners.destroy');
    });
});