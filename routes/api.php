<?php

use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;

Route::prefix('authentication')->group(function (){
   Route::post('/signIn', [AuthenticationController::class, 'login']);
   Route::post('/logout', [AuthenticationController::class, 'logout']);
});
