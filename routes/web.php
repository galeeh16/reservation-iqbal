<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\Approval\ApprovalController;
use App\Http\Controllers\Requester\RequesterController;
use App\Http\Controllers\Warehouse\ReservationController;
use App\Http\Controllers\Requester\StatusReservationController;


Route::get('/', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::post('/login', [AuthController::class, 'prosesLogin'])->name('login');

Route::get('/home', [HomeController::class, 'index']);

// Requester 
Route::get('/requester/list-material', [RequesterController::class, 'getListMaterial']);
Route::get('/requester/get-material/{id_material}', [RequesterController::class, 'findMaterial']);
Route::post('/requester/search-code-item', [RequesterController::class, 'searchCodeItem']);
Route::post('/requester/add-material', [RequesterController::class, 'addMaterial']);
Route::put('/requester/edit-material/{id_material}', [RequesterController::class, 'updateMaterial']);
Route::delete('/requester/delete-material/{id_material}', [RequesterController::class, 'deleteMaterial']);
Route::post('/requester/add-reservation', [RequesterController::class, 'addReservation']);
// Requester - Status Reservation
Route::get('/requester/status-reservation', [StatusReservationController::class, 'index']);
Route::post('/requester/status-reservation/get-list', [StatusReservationController::class, 'getList']);


// Warehouse
Route::get('/warehouse/material', [WarehouseController::class, 'index']);
Route::post('/warehouse/material/upload', [WarehouseController::class, 'upload']);
Route::post('/warehouse/material/get-list', [WarehouseController::class, 'getList']);

Route::get('/warehouse/reservation', [ReservationController::class, 'index']);
Route::post('/warehouse/reservation/get-list', [ReservationController::class, 'getList']);
Route::post('/warehouse/reservation/complete', [ReservationController::class, 'complete']);


// Approval
Route::post('/approval/material/get-list', [ApprovalController::class, 'getList']);
Route::post('/approval/material/approve-or-reject', [ApprovalController::class, 'approveOrReject']);
Route::get('/approval/detail/{no_reseration}', [ApprovalController::class, 'show']);
Route::get('/approval/detail/pdf/{no_reseration}', [ApprovalController::class, 'downloadPdf']);