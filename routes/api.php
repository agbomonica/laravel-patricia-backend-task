<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SignUpController;

Route::prefix('v1')->group(static function(){
    Route::prefix('users')->group(static function(){
        Route::post('/signup', [SignUpController::class, 'store'])->name('signup');
        Route::post('/login', [LoginController::class, 'login'])->name('login');

        Route::middleware('auth:api')->name('users.')->group(static function(){
            Route::patch('/me', [UserController::class, 'update'])->name('update');
            Route::get('/me', [UserController::class, 'show'])->name('show');
            Route::delete('/me', [UserController::class, 'destroy'])->name('destroy');
        });
    });
});
