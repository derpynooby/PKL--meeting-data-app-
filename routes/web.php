<?php

use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ZoomController;
use App\Http\Controllers\ZoomParticipant;
use App\Http\Controllers\StatusController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Operator;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
    Route::controller(ZoomParticipant::class)->group(function () {
        Route::get('/zoom-participant', 'index')->name('zoom-participant.index');
        Route::post('/zoom-participant', 'store')->name('zoom-participant.store');
        Route::get('/zoom-participant/history', 'history')->name('zoom-participant.history');
        Route::get('/zoom-participant/export-history', 'exportHistory')->name('zoom-participant.export-history');
        Route::delete('/zoom-participant/{usersZoom}', 'destroy')->name('zoom-participant.destroy');
        Route::get('/zoom-participant/{usersZoom}', 'details')->name('zoom-participant.details');
        Route::get('/zoom-participant/{usersZoom}/export', 'export')->name('zoom-participant.export');
    });
    Route::middleware(Operator::class.':admin,operator')->group(function () {
        Route::controller(ZoomController::class)->group(function () {
            Route::get('/zoom', 'index')->name('zoom.index');
            Route::post('/zoom', 'store')->name('zoom.store');
            Route::patch('/zoom/{zoom}', 'update')->name('zoom.update');
            Route::delete('/zoom/{zoom}', 'destroy')->name('zoom.destroy');
        });
        Route::middleware(Admin::class.':admin')->group(function () {
            Route::controller(LocationController::class)->group(function () {
                Route::get('/location', 'index')->name('location.index');
                Route::post('/location', 'store')->name('location.store');
                Route::patch('/location/{location}', 'update')->name('location.update');
                Route::delete('/location/{location}', 'destroy')->name('location.destroy');
            });
            Route::controller(RoleController::class)->group(function () {
                Route::get('/role', 'index')->name('role.index');
                Route::post('/role', 'store')->name('role.store');
                Route::patch('/role/{role}', 'update')->name('role.update');
                Route::delete('/role/{role}', 'destroy')->name('role.destroy');
            });
            Route::controller(StatusController::class)->group(function () {
                Route::get('/status', 'index')->name('status.index');
                Route::patch('/status/{user}', 'update')->name('status.update');
            });
        });
    });
});

require __DIR__ . '/auth.php';
