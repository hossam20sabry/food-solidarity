<?php

use App\Http\Controllers\Dist\ComplaintsController;
use App\Http\Controllers\Dist\HomeController as DistHomeController;
use App\Http\Controllers\Dist\HomeController;
use App\Http\Controllers\Dist\ProfileController as DistProfileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| distributor Routes
|--------------------------------------------------------------------------
*/

Route::prefix('dist')->name('dist.')->group(function () {

    Route::middleware('dist')->group(function () {

        
        
        Route::get('/', [HomeController::class, 'index'])->name('index');
        Route::get('notifications', [DistHomeController::class, 'notifications'])->name('notifications');

        Route::get('/profile', [DistProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile/{guard}', [DistProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [DistProfileController::class, 'destroy'])->name('profile.destroy');

        Route::prefix('donations')->name('donations.')->group(function () {
            Route::get('/', [DistHomeController::class, 'index'])->name('index');
            Route::get('/choose/{donation}', [DistHomeController::class, 'choose'])->name('choose');
            Route::get('/create/{donation}', [DistHomeController::class, 'create1'])->name('create1');
            Route::post('/store', [DistHomeController::class, 'store'])->name('store');
            Route::post('/dry', [DistHomeController::class, 'dry'])->name('dry');
            Route::post('/cooked', [DistHomeController::class, 'cooked'])->name('cooked');
            Route::post('/proteins', [DistHomeController::class, 'proteins'])->name('proteins');
            Route::get('/{donation}', [DistHomeController::class, 'show'])->name('show');

            Route::post('/donation-type', [DistHomeController::class, 'donationType'])->name('donationType');
            Route::post('/notifications', [DistHomeController::class, 'notifications'])->name('notifications');
            Route::post('/selectItem', [DistHomeController::class, 'selectItem'])->name('selectItem');
            Route::post('/dry-food', [DistHomeController::class, 'dryFood'])->name('dryFood');
        });

        Route::prefix('complaints')->name('complaints.')->group(function () {
            Route::get('/create', [ComplaintsController::class, 'create'])->name('create');
            Route::post('/store', [ComplaintsController::class, 'store'])->name('store');
        });

        
    });

    require __DIR__.'/distAuth.php';
    
});




