<?php

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

        Route::get('/profile', [DistProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile/{guard}', [DistProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [DistProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__.'/distAuth.php';
    
});




