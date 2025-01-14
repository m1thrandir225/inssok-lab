<?php

use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\YachtController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('yachts', YachtController::class);
Route::apiResource('reservations', ReservationController::class, ['only' => ['index', 'store', 'show']]);
Route::apiResource('reviews', ReviewController::class, ['except' => ['destroy', 'update']]);
Route::put("/reservations/{reservation}/confirm", [ReservationController::class, 'confirmReservation']);
Route::put("/reservations/{reservation}/cancel", [ReservationController::class, 'cancelReservation']);
