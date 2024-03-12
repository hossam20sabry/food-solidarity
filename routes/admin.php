<?php

use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AnswerComplainsController;
use App\Http\Controllers\Admin\AuthType\AuthTypesController;
use App\Http\Controllers\Admin\AuthType\DistAuthTypesController;
use App\Http\Controllers\Admin\AwarenessArticle\AwarenessArticlesController;
use App\Http\Controllers\Admin\BenAnswerComplainsController;
use App\Http\Controllers\Admin\City\CitiesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DonationType\DonationTypesController;
use App\Http\Controllers\Admin\DryFoodType\DryFoodTypesController;
use App\Http\Controllers\Admin\FoodType\FoodTypesController;
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
        
        Route::get('/dashboard', [DashboardController::class, 'index'])
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


        Route::prefix('FoodTypes')->name('FoodTypes.')->group(function () {
            Route::get('/', [FoodTypesController::class, 'index'])->name('index');
            Route::post('/', [FoodTypesController::class, 'store'])->name('store');
            Route::get('/{dryFoodType}/edit', [FoodTypesController::class, 'edit'])->name('edit');
            Route::patch('/{dryFoodType}', [FoodTypesController::class, 'update'])->name('update');
            Route::delete('/{dryFoodType}', [FoodTypesController::class, 'destroy'])->name('destroy');
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

        Route::prefix('cities')->name('cities.')->group(function () {
            Route::get('/', [CitiesController::class, 'index'])->name('index');
            Route::get('/create', [CitiesController::class, 'create'])->name('create');
            Route::post('/', [CitiesController::class, 'store'])->name('store');
            Route::get('/{city}/edit', [CitiesController::class, 'edit'])->name('edit');
            Route::patch('/{city}', [CitiesController::class, 'update'])->name('update');
            Route::delete('/{city}', [CitiesController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('answersComplains')->name('answersComplains.')->group(function () {
            Route::get('/', [AnswerComplainsController::class, 'index'])->name('index');
            Route::get('/create/{answerComplain}', [AnswerComplainsController::class, 'create'])->name('create');
            Route::post('/{id}', [AnswerComplainsController::class, 'store'])->name('store');
        });

        Route::prefix('benAnswersComplains')->name('benAnswersComplains.')->group(function () {
            Route::get('/', [BenAnswerComplainsController::class, 'index'])->name('index');
            Route::get('/create/{answerComplain}', [BenAnswerComplainsController::class, 'create'])->name('create');
            Route::post('/{id}', [BenAnswerComplainsController::class, 'store'])->name('store');
        });
    });

    require __DIR__.'/adminAuth.php';

});




