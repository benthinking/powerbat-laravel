
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\DeviceController;

Route::controller(SiteController::class)->middleware('client')->group(function () {
    Route::get('/sites', 'index');
    Route::post('/sites', 'store');
    Route::get('/sites/{id}', 'show');
    Route::put('/sites/{id}', 'update');
    Route::delete('/sites/{id}', 'destroy');
});

Route::controller(GroupController::class)->group(function () {
    Route::get('/groups', 'index');
    Route::post('/groups', 'store');
    Route::get('/groups/{id}', 'show');
    Route::put('/groups/{id}', 'update');
    Route::delete('/groups/{id}', 'destroy');
});

Route::controller(PointController::class)->group(function () {
    Route::get('/points', 'index');
    Route::post('/points', 'store');
    Route::get('/points/{id}', 'show');
    Route::put('/points/{id}', 'update');
    Route::delete('/points/{id}', 'destroy');
});

Route::controller(DataController::class)->group(function () {
    Route::get('/data', 'index');
    Route::post('/data', 'store');
    Route::get('/data/{id}', 'show');
    Route::put('/data/{id}', 'update');
    Route::delete('/data/{id}', 'destroy');
});

Route::controller(DeviceController::class)->group(function () {
    Route::get('/devices', 'index');
    Route::post('/devices', 'store');
    Route::get('/devices/{id}', 'show');
    Route::put('/devices/{id}', 'update');
    Route::delete('/devices/{id}', 'destroy');
});

