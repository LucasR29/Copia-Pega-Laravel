<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\CollectionItemController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

// Open Routes
Route::name('open')->group(function () {
    Route::apiResource('/users', UserController::class);
    Route::post('/login', [AuthController::class, 'login']);
    Route::apiResource('/collectionItems', CollectionItemController::class);
    Route::get('/collectionItems/{id}', [CollectionItemController::class, 'show']);
    Route::get('/collectionItems/{collectionId}/collection', [CollectionItemController::class, 'showByCollection']);
    Route::apiResource('/campaigns', CampaignController::class);
});

// Protected Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

// Admin Routes
Route::middleware([IsAdmin::class, 'auth:sanctum'])->group(function () {
    Route::apiResource('/collections', CollectionController::class);
});
