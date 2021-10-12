<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MuserController;

Route::group([
  'middleware' => ['auth:api'],
  'prefix' => 'auth'
], function ($router) {
  Route::post('register', [AuthController::class, 'register'])->withoutMiddleware(['auth:api']);
  Route::post('m_register', [AuthController::class, 'm_register'])->withoutMiddleware(['auth:api']);
  Route::post('login', [AuthController::class, 'login'])->withoutMiddleware(['auth:api']);
  Route::post('m_login', [AuthController::class, 'm_login'])->withoutMiddleware(['auth:api']);
  Route::post('logout', [AuthController::class, 'logout']);
  Route::post('refresh', [AuthController::class, 'refresh']);
  Route::get('user', [AuthController::class, 'me']);
  Route::get('muser', [AuthController::class, 'mme']);
});

Route::apiResource('/v1/like', LikeController::class);
Route::apiResource('/v1/reserve', ReserveController::class);
Route::apiResource('/v1/shop', ShopController::class);
Route::apiResource('/v1/user', UserController::class);
Route::apiResource('/v1/muser', MuserController::class);