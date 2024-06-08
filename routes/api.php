<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DenominacionController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\TipoController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



// Rutas para la autenticación
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas por Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::get('/denominacion', [DenominacionController::class, 'index']);
Route::post('/denominacion', [DenominacionController::class, 'store']);
Route::put('/denominacion/{id}', [DenominacionController::class, 'update']);
Route::delete('/denominmacion/{id}', [DenominacionController::class, 'destroy']);

Route::get('/tipo', [TipoController::class, 'index']);
Route::post('/tipo', [TipoController::class, 'store']);
Route::put('/tipo/{id}', [TipoController::class, 'update']);
Route::delete('/tipo/{id}', [TipoController::class, 'destroy']);

//Route::apiResource('producto', ProductoController::class);
Route::put('/producto/{id}', [ProductoController::class, 'update']);
Route::get('/producto/', [ProductoController::class, 'index']);
