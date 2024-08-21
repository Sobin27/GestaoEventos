<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('jwt')->group(function (){
    Route::prefix('user')->group(function (){
        Route::post('create', [UserController::class, 'createUser'])->withoutMiddleware('jwt');
        Route::put('confirm/email/{userUuid}', [UserController::class, 'confirmEmail'])->name('confirm.email')->withoutMiddleware('jwt');
        Route::put('update', [UserController::class, 'updateUser'])->name('update.user');
    });
    Route::prefix('authentication')->group(function (){
        Route::post('login', [LoginController::class, 'login'])->name('login')->withoutMiddleware('jwt');
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    });
});
