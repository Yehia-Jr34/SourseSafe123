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

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

Route::prefix('API')->middleware('auth:api')->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);
});

Route::prefix('groups')->middleware('auth:api')->group(function () {
    Route::post('group/add', [UserController::class, 'create_group']);
});

Route::prefix('user')->middleware('auth:api')->group(function () {
    Route::get('groups/get_my_groups',[UserController::class, 'get_my_groups']);
    Route::post('groups/leave', [UserController::class,'leave_group']);

});

Route::prefix('admin')->middleware('auth:api')->group(function () {
    Route::get('get_my_groups', [AdminController::class, 'view_my_groups']);

    Route::post('member/add_member', [AdminController::class, 'add_member']);
    Route::post('member/delete_member', [AdminController::class, 'delete_member']);

//    Route::post('file/upload_file',[AdminController::class, 'upload_file']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
