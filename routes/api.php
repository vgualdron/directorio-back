<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\CompanyController;

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


Route::get('/health', function (Request $request) {
    return 'Health ...';
});

Route::post('v1/login', [LoginController::class, 'login']);

Route::group(["prefix" => "/v1", "middleware" => ["auth:sanctum"]], function () {
    Route::group(['prefix'=>'/user'], function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/{id}', [UserController::class, 'show']);
        Route::post('/', [UserController::class, 'store']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::put('/change-password/{id}', [UserController::class, 'changePassword']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
        Route::post('/change-image-profile', [UserController::class, 'changeImageProfile']);
    });
    
    Route::group(['prefix'=>'/configuration'], function () {
        Route::get('/', [ConfigurationController::class, 'index']);
        Route::get('/{id}', [ConfigurationController::class, 'show']);
        Route::post('/', [ConfigurationController::class, 'store']);
        Route::put('/{id}', [ConfigurationController::class, 'update']);
        Route::delete('/{id}', [ConfigurationController::class, 'destroy']);
    });
   
    Route::group(['prefix'=>'/category'], function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::get('/{id}', [CategoryController::class, 'show']);
        Route::post('/', [CategoryController::class, 'store']);
        Route::put('/{id}', [CategoryController::class, 'update']);
        Route::delete('/{id}', [CategoryController::class, 'destroy']);
    });
    
    Route::group(['prefix'=>'/plan'], function () {
        Route::get('/', [PlanController::class, 'index']);
        Route::get('/{id}', [PlanController::class, 'show']);
        Route::post('/', [PlanController::class, 'store']);
        Route::put('/{id}', [PlanController::class, 'update']);
        Route::delete('/{id}', [PlanController::class, 'destroy']);
    });
    
    Route::group(['prefix'=>'/company'], function () {
        Route::get('/', [CompanyController::class, 'index']);
        Route::get('/{id}', [CompanyController::class, 'show']);
        Route::post('/', [CompanyController::class, 'store']);
        Route::put('/{id}', [CompanyController::class, 'update']);
        Route::delete('/{id}', [CompanyController::class, 'destroy']);
        Route::post('/change-logo/{id}', [CompanyController::class, 'changeLogo']);
    });
});
