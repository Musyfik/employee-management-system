<?php

use App\Http\Controllers\Api\EmployeeApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Employee API endpoints (no auth required for portfolio demo)
Route::prefix('employees')->group(function () {
    Route::get('/', [EmployeeApiController::class, 'index']);
    Route::post('/', [EmployeeApiController::class, 'store']);
});
