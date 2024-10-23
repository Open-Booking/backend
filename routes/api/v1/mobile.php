<?php

use App\Modules\MobileModule\Http\Controllers\BookingController;
use App\Modules\MobileModule\Http\Controllers\CategoryController;
use App\Modules\MobileModule\Http\Controllers\CustomerController;
use App\Modules\MobileModule\Http\Controllers\OptionController;
use App\Modules\MobileModule\Http\Controllers\PackageController;
use App\Modules\MobileModule\Http\Controllers\PackageSaleController;
use App\Modules\MobileModule\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
|
| Register your module routes here.
|
*/

Route::group(['prefix' => '/v1/mobile'], function () {
    /* Authentication routes */
    Route::group(['prefix' => '/auth'], function () {
        Route::get('/app-key', [CustomerController::class, 'appKey']);
        Route::post('/request-otp/{channel}', [CustomerController::class, 'requestOtp']);
        Route::post('/register', [CustomerController::class, 'register']);
        Route::post('/login', [CustomerController::class, 'login']);
    });

    /* Resource routes without authentication */
    Route::get('/options/{key}', [OptionController::class, 'get']);
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/services', [ServiceController::class, 'index']);
    Route::get('/services/{id}', [ServiceController::class, 'read']);
    Route::get('/packages', [PackageController::class, 'index']);
    Route::get('/packages/{id}', [PackageController::class, 'read']);

    /* Resource routes with authentication */
    Route::group(['middleware' => ['auth:customer']], function () {

        Route::post('/auth/logout', [CustomerController::class, 'logout']);

        Route::get('/profile', [CustomerController::class, 'getProfile']);
        /* user information includes file/image upload,
        * frontend side needs to use [post] method by adding _method:PUT in payload
        * e.g formData.append('_method', 'PUT');
        * Laravel will correctly interpret the POST request as PUT because of the _method parameter
        */
        Route::put('profile', [CustomerController::class, 'updateProfile']);
        Route::delete('profile', [CustomerController::class, 'deleteProfile']);

        Route::group(['prefix' => '/my-bookings'], function () {
            Route::post('/', [BookingController::class, 'create']);
            Route::get('/', [BookingController::class, 'index']);
            Route::get('/{id}', [BookingController::class, 'read']);
        });

        Route::group(['prefix' => '/my-packages'], function () {
            Route::post('/', [PackageSaleController::class, 'create']);
            Route::get('/', [PackageSaleController::class, 'index']);
            Route::get('/{id}', [PackageSaleController::class, 'read']);
        });
    });
});
