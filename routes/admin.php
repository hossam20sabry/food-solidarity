<?php

use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AuthType\AuthTypesController;
use App\Http\Controllers\Admin\AuthType\DistAuthTypesController;
use App\Http\Controllers\Admin\AwarenessArticle\AwarenessArticlesController;
use App\Http\Controllers\Admin\DonationType\DonationTypesController;
use App\Http\Controllers\Admin\DryFoodType\DryFoodTypesController;
use App\Http\Controllers\Admin\ProteinTypes\ProteinTypesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('admin')->group(function () {
        
        Route::get('/dashboard', function () { return view('admin.dashboard');})
            ->name('dashboard');

        Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile/{guard}', [AdminProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [AdminProfileController::class, 'destroy'])->name('profile.destroy');

        Route::prefix('authTypes')->name('authTypes.')->group(function () {
            Route::get('/', [AuthTypesController::class, 'index'])->name('index');
            Route::post('/', [AuthTypesController::class, 'store'])->name('store');
            Route::get('/{authType}/edit', [AuthTypesController::class, 'edit'])->name('edit');
            Route::patch('/{authType}', [AuthTypesController::class, 'update'])->name('update');
            Route::delete('/{authType}', [AuthTypesController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('distAuthTypes')->name('distAuthTypes.')->group(function () {
            Route::get('/', [DistAuthTypesController::class, 'index'])->name('index');
            Route::post('/', [DistAuthTypesController::class, 'store'])->name('store');
            Route::get('/{authType}/edit', [DistAuthTypesController::class, 'edit'])->name('edit');
            Route::patch('/{authType}', [DistAuthTypesController::class, 'update'])->name('update');
            Route::delete('/{authType}', [DistAuthTypesController::class, 'destroy'])->name('destroy');
        });


        Route::prefix('dryFoodTypes')->name('dryFoodTypes.')->group(function () {
            Route::get('/', [DryFoodTypesController::class, 'index'])->name('index');
            Route::post('/', [DryFoodTypesController::class, 'store'])->name('store');
            Route::get('/{dryFoodType}/edit', [DryFoodTypesController::class, 'edit'])->name('edit');
            Route::patch('/{dryFoodType}', [DryFoodTypesController::class, 'update'])->name('update');
            Route::delete('/{dryFoodType}', [DryFoodTypesController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('proteinTypes')->name('proteinTypes.')->group(function () {
            Route::get('/', [ProteinTypesController::class, 'index'])->name('index');
            Route::post('/store', [ProteinTypesController::class, 'store'])->name('store');
            Route::get('/{proteinType}/edit', [ProteinTypesController::class, 'edit'])->name('edit');
            Route::patch('/{proteinType}', [ProteinTypesController::class, 'update'])->name('update');
            Route::delete('/{proteinType}', [ProteinTypesController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('awarenessArticles')->name('awarenessArticles.')->group(function () {
            Route::get('/', [AwarenessArticlesController::class, 'index'])->name('index');
            Route::get('/create', [AwarenessArticlesController::class, 'create'])->name('create');
            Route::post('/', [AwarenessArticlesController::class, 'store'])->name('store');
            Route::get('/{awarenessArticle}/explore', [AwarenessArticlesController::class, 'explore'])->name('explore');
            Route::get('/{awarenessArticle}/edit', [AwarenessArticlesController::class, 'edit'])->name('edit');
            Route::patch('/{awarenessArticle}', [AwarenessArticlesController::class, 'update'])->name('update');
            Route::delete('/{awarenessArticle}', [AwarenessArticlesController::class, 'destroy'])->name('destroy');
        });

    });

    require __DIR__.'/adminAuth.php';
    
});




