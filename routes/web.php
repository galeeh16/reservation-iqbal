<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\Warehouse\ReservationController;


Route::get('/', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::post('/login', [AuthController::class, 'prosesLogin'])->name('login');

Route::get('/home', [HomeController::class, 'index']);

Route::get('/warehouse/material', [WarehouseController::class, 'index']);
Route::post('/warehouse/material/upload', [WarehouseController::class, 'upload']);
Route::post('/warehouse/material/get-list', [WarehouseController::class, 'getList']);

Route::get('/warehouse/reservation', [ReservationController::class, 'index']);
Route::post('/warehouse/reservation/get-list', [ReservationController::class, 'getList']);
