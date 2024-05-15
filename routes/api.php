<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\DocumentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
   return $request->user();
});

Route::prefix('auth')->group(function () {
   Route::post('register', [AuthController::class, 'register']);
   Route::post('login', [AuthController::class, 'login']);
   Route::post('logout', [AuthController::class, 'logout']);
   Route::post('refresh', [AuthController::class, 'refresh']);
   Route::post('me', [AuthController::class, 'me']);
});

Route::group(['middleware' => 'auth.jwt'], function () {
   // Protected routes here
   Route::apiResource('bookings', BookingController::class);
   Route::apiResource('countries', CountryController::class);
   Route::post('document', [DocumentController::class, 'store']);
});
