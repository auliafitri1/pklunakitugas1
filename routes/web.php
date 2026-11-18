<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaPropinsiController;
use App\Http\Controllers\AreaKabKotaController;

Route::get('/propinsi', [AreaPropinsiController::class, 'index']);
Route::get('/propinsi/load-more', [AreaPropinsiController::class, 'loadMore']);
Route::get('/propinsi/create', [AreaPropinsiController::class, 'create']);
Route::post('/propinsi', [AreaPropinsiController::class, 'store']);
Route::get('/propinsi/{id}/edit', [AreaPropinsiController::class, 'edit']);
Route::put('/propinsi/{id}', [AreaPropinsiController::class, 'update']);
Route::delete('/propinsi/{id}', [AreaPropinsiController::class, 'destroy']);

Route::get('/kabkota', [AreaKabKotaController::class, 'index']);
Route::get('/kabkota/load-more', [AreaKabKotaController::class, 'loadMore']);
Route::get('/kabkota/create', [AreaKabKotaController::class, 'create']);
Route::post('/kabkota', [AreaKabKotaController::class, 'store']);
Route::get('/kabkota/{id}/edit', [AreaKabKotaController::class, 'edit']);
Route::put('/kabkota/{id}', [AreaKabKotaController::class, 'update']);
Route::delete('/kabkota/{id}', [AreaKabKotaController::class, 'destroy']);