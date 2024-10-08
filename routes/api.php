<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('jwt')->group(function (){
    Route::prefix('user')->group(function (){
        Route::post('create', [UserController::class, 'createUser'])->withoutMiddleware('jwt');
        Route::put('confirm/email/{userUuid}', [UserController::class, 'confirmEmail'])->name('confirm.email')->withoutMiddleware('jwt');
        Route::put('update', [UserController::class, 'updateUser'])->name('update.user');
        Route::get('list', [UserController::class, 'listingUser'])->name('list.user');
    });
    Route::prefix('authentication')->group(function (){
        Route::post('login', [LoginController::class, 'login'])->name('login')->withoutMiddleware('jwt');
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    });
    Route::prefix('event')->group(function (){
        Route::post('create', [EventController::class, 'createEvent'])->name('create.event');
        Route::post('to-participate/{eventId}', [EventController::class, 'toParticipateEvent'])->name('to-participate.eventId');
        Route::put('update', [EventController::class, 'updateEvent'])->name('update.event');
        Route::get('list', [EventController::class, 'listEvent'])->name('list.event');
        Route::get('details/{eventId}', [EventController::class, 'detailsEvent'])->name('details.event');
        Route::delete('stop-participating/{eventId}', [EventController::class, 'eventStopParticipating'])->name('stop-participating.eventId');
        Route::get('my-events', [EventController::class, 'myEventsList'])->name('my-events');
        Route::post('cancel/{eventId}', [EventController::class, 'cancelEvent'])->name('cancel.event');
        Route::post('participate-private/{eventId}/{userId}', [EventController::class, 'participateToPrivateEvent'])->name('participate-private-event')->withoutMiddleware('jwt');
    });
});
