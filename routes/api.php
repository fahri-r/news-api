<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UploadController;
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


Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
    });

    Route::middleware('auth:api')->group(function () {
        Route::apiResource('news', NewsController::class)->except(['show', 'index'])->middleware(['can:store-news', 'can:update-news', 'can:destroy-news']);
        Route::apiResource('comments', CommentController::class)->except(['show', 'index', 'destroy', 'update'])->middleware(['can:store-comment']);
        Route::post('/uploads', [UploadController::class, 'store'])->middleware('can:upload');
    });

    Route::apiResource('news', NewsController::class)->only(['show', 'index']);
    Route::apiResource('comments', CommentController::class)->only(['show', 'index']);
});


Route::get('/', function (Request $request) {
    return response()->json(
        [
            'message' => 'Hello World'
        ],
        200
    );
});
