
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\TicketStatusController;

Route::post('register' , [AuthController::class , 'register']);
Route::post('login' , [AuthController::class , 'login']);

Route::controller(SiteController::class)->middleware('client')->group(function () {
    Route::get('/sites', 'index');
    Route::post('/sites', 'store');
    Route::get('/sites/{id}', 'show');
    Route::put('/sites/{id}', 'update');
    Route::delete('/sites/{id}', 'destroy');
});

Route::controller(GroupController::class)->middleware('client')->group(function () {
    Route::get('/groups', 'index');
    Route::post('/groups', 'store');
    Route::get('/groups/{id}', 'show');
    Route::put('/groups/{id}', 'update');
    Route::delete('/groups/{id}', 'destroy');
});

Route::controller(PointController::class)->middleware('client')->group(function () {
    Route::get('/points', 'index');
    Route::post('/points', 'store');
    Route::get('/points/{id}', 'show');
    Route::put('/points/{id}', 'update');
    Route::delete('/points/{id}', 'destroy');
});

Route::controller(DataController::class)->middleware('client')->group(function () {
    Route::get('/data', 'index');
    Route::post('/data', 'store');
    Route::get('/data/{id}', 'show');
    Route::put('/data/{id}', 'update');
    Route::delete('/data/{id}', 'destroy');
});

Route::controller(DeviceController::class)->middleware('client')->group(function () {
    Route::get('/devices', 'index');
    Route::post('/devices', 'store');
    Route::get('/devices/{id}', 'show');
    Route::put('/devices/{id}', 'update');
    Route::delete('/devices/{id}', 'destroy');
});

Route::controller(OrderController::class)->middleware('client')->group(function () {
    Route::get('/orders', 'index');
    Route::post('/orders', 'store');
    Route::get('/orders/{id}', 'show');
    Route::put('/orders/{id}', 'update');
    Route::delete('/orders/{id}', 'destroy');
});


Route::controller(TicketStatusController::class)->middleware('client')->group(function () {
    Route::get('/ticket/statuses', 'index');
    Route::get('/ticket/statuses/{value}', 'show');
});

