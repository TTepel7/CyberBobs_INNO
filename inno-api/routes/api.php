<?php

use App\Http\Controllers\AuthController;
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
Route::get('/verify_password/',[AuthController::class,'verify'])->name('verify');
Route::post('/startups',[\App\Http\Controllers\StartupController::class,'index'])->middleware(['api','auth:api']);
Route::get('/directions',[\App\Http\Controllers\DirectionController::class,'index'])->middleware(['api','auth:api']);
Route::get('/certs',[\App\Http\Controllers\CertTypeController::class,'index'])->middleware(['api','auth:api']);
Route::get('/transport',[\App\Http\Controllers\TransportTypeController::class,'index'])->middleware(['api','auth:api']);
Route::get('/project_stages',[\App\Http\Controllers\ProjectStageController::class,'index'])->middleware(['api','auth:api']);
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    Route::post('/restore',[AuthController::class,'restorePassword']);
});
