<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\Localization;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\App;


Route::middleware(Localization::class)->group(function(){
    
    Route::get('/', function () {
        return view('welcome');
    });

    Route::middleware('admin:admin')->group(function(){
        Route::get('admin/login', [AdminController::class, 'loginForm']);
        Route::post('admin/login', [AdminController::class, 'store'])->name('admin.login');
    });
    
    Route::middleware([
        'auth:sanctum,admin',
        config('jetstream.auth_session'),
        'verified',
    ])->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('dashboard');
        })->name('dashboard')->middleware('auth:admin');
    });
    
    Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
    ])->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    });
    
    require __DIR__.'/jetstream.php';
});


