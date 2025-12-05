<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplyRequestController;
use App\Http\Controllers\InspectionController;
use App\Http\Controllers\PropertyAcknowledgmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Dashboard routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Supply Request routes (available to all authenticated employees)
    Route::resource('supply-requests', SupplyRequestController::class);

    // Supply Officer only routes
    Route::middleware('supply.officer')->group(function () {
        Route::resource('products', ProductController::class);
        Route::resource('inspections', InspectionController::class);
        Route::resource('property-acknowledgments', PropertyAcknowledgmentController::class);

        // Supply officer routes for request approvals
        Route::patch('/supply-requests/{supplyRequest}/approve', [SupplyRequestController::class, 'approve'])->name('supply-requests.approve');
        Route::patch('/supply-requests/{supplyRequest}/reject', [SupplyRequestController::class, 'reject'])->name('supply-requests.reject');
    });
});

require __DIR__.'/auth.php';
