<?php

// Web
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// API
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\TransactionApiController;

require __DIR__.'/auth.php';


// Web Routes
Route::get('/', function () {
    return redirect()->route('products.index');
});

Route::middleware('auth')->group(function () {

    // Dashboard redirect to products
    Route::get('/dashboard', function() {
        return redirect()->route('products.index');
    })->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Product CRUD routes
    Route::get('products', [ProductsController::class,'index'])->name('products.index');
    Route::get('products/create', [ProductsController::class,'create'])->name('products.create');
    Route::post('products', [ProductsController::class,'store'])->name('products.store');
    Route::get('products/{product}/edit', [ProductsController::class,'edit'])->name('products.edit');
    Route::put('products/{product}', [ProductsController::class,'update'])->name('products.update');
    Route::delete('products/{product}', [ProductsController::class,'destroy'])->name('products.destroy');

    // Purchase routes
    Route::get('products/{product}/purchase', [ProductsController::class,'purchaseForm'])->name('products.purchaseForm');
    Route::post('products/{product}/purchase', [ProductsController::class,'purchase'])->name('products.purchase');

    // Transactions
    Route::get('transactions', [TransactionController::class,'index'])->name('transactions.index');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout')->middleware('auth');



// API Routes
Route::prefix('api')->group(function () {
    // Public: login
    Route::post('login', [AuthController::class, 'login']);

    // Protected: JWT required
    Route::middleware('auth:api')->group(function () {
        Route::get('products', [ProductApiController::class, 'index']);
        Route::get('products/{product}', [ProductApiController::class, 'show']);
        Route::post('products/{product}/purchase', [ProductApiController::class, 'purchase']);
        Route::get('transactions', [TransactionApiController::class, 'index']); // Admin only
    });
});