<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware(['auth:sanctum'])->post('/logout', [AuthController::class, 'logout']);

Route::prefix('user')->middleware('auth:api')->group(function () {
    Route::post('group/add_group', [UserController::class, 'add_group']);
    Route::get('group/my_groups', [UserController::class, 'get_my_groups']);
    Route::post('group/leave_group', [UserController::class, 'leave_group']);
});

Route::prefix('admin')->middleware('auth:api')->group(function () {
    Route::post('member/add_member', [AdminController::class, 'add_member']);
    Route::post('member/delete_member', [AdminController::class, 'delete_member']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
