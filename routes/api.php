<?php
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function (){
    Route::post('create', [UserController::class, 'createUser']);
    Route::put('confirm/email/{userUuid}', [UserController::class, 'confirmEmail'])->name('confirm.email');
});
