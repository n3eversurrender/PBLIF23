<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\DataPengguna;
use App\Http\Controllers\PaymentController;

// // API route group
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/test', function () {
    return response()->json(['message' => 'Hello, World!']);
});

// Route manual untuk DataPengguna
Route::get('/pengguna/index', [DataPengguna::class, 'index']);
Route::get('/pengguna/show/{id}', [DataPengguna::class, 'show']);
Route::post('/pengguna/store', [DataPengguna::class, 'store'])->name('pengguna.store');
Route::put('/pengguna/update/{id}', [DataPengguna::class, 'update']);
Route::delete('/pengguna/destroy/{id}', [DataPengguna::class, 'destroy']);

Route::post('/payment/notification', [PaymentController::class, 'handleNotification']);

