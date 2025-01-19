<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ImageController;

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

// endpoints panel de administración
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
        Route::get('/{id}', [ConfigurationController::class, 'show']);
        Route::post('/', [ConfigurationController::class, 'store']);
        Route::put('/{id}', [ConfigurationController::class, 'update']);
        Route::delete('/{id}', [ConfigurationController::class, 'destroy']);
    });
   
    Route::group(['prefix'=>'/category'], function () {
        Route::get('/{id}', [CategoryController::class, 'show']);
        Route::post('/', [CategoryController::class, 'store']);
        Route::put('/{id}', [CategoryController::class, 'update']);
        Route::delete('/{id}', [CategoryController::class, 'destroy']);
    });
    
    Route::group(['prefix'=>'/product'], function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::get('/{id}', [ProductController::class, 'show']);
        Route::post('/', [ProductController::class, 'store']);
        Route::put('/{id}', [ProductController::class, 'update']);
        Route::delete('/{id}', [ProductController::class, 'destroy']);
    });

    Route::group(['prefix'=>'/image'], function () {
        Route::get('/product/{id}', [ImageController::class, 'index']);
        Route::get('/{id}', [ImageController::class, 'show']);
        Route::post('/', [ImageController::class, 'store']);
        Route::put('/{id}', [ImageController::class, 'update']);
        Route::delete('/{id}', [ImageController::class, 'destroy']);
    });
});


// endpoints tienda virtual
Route::group(["prefix" => "/v1"], function () {
    Route::group(['prefix'=>'/product'], function () {
        Route::get('/search/params', [ProductController::class, 'search']);
    });
    /* Route::group(['prefix'=>'/category'], function () {
         Route::get('/', [CategoryController::class, 'index']);
    }); */
    Route::get('/category/', function (Request $request) {
        return 'Health ...';
    });

    Route::group(['prefix'=>'/configuration'], function () {
        Route::get('/', [ConfigurationController::class, 'index']);
    });
});
