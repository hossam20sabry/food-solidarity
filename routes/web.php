<?php

use App\Http\Controllers\Ben\HomeController as BenHomeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SelectAuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::middleware('guest:admin,dist,web')->group(function () {
    Route::get('select-Auth-login', [SelectAuthController::class, 'login'])->name('select.login');
    Route::get('select-Auth-register', [SelectAuthController::class, 'register'])->name('select.register');
});

Route::middleware('auth:web')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/{guard}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('needs')->name('needs.')->group(function () {
        Route::get('/', [BenHomeController::class, 'index'])->name('index');
        Route::get('/create', [BenHomeController::class, 'create'])->name('create');
        Route::post('/store', [BenHomeController::class, 'store'])->name('store');
        Route::get('/{need}', [BenHomeController::class, 'show'])->name('show');    
    });

});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/dist.php';

