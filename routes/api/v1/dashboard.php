<?php

use App\Modules\DashboardModule\Http\Controllers\BookingController;
use App\Modules\DashboardModule\Http\Controllers\CustomerController;
use App\Modules\DashboardModule\Http\Controllers\PackageController;
use App\Modules\DashboardModule\Http\Controllers\PackageSaleController;
use App\Modules\DashboardModule\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
|
| Register your module routes here.
|
*/

Route::group(['prefix' => '/v1/dashboard'], function () {

    Route::group(['middleware' => ['auth:sanctum', 'user.check']], function () {
        Route::group(['prefix' => 'services'], function () {
            Route::get('/', [ServiceController::class, 'index'])->middleware(['ability:index,Service']);
            Route::get('/{id}', [ServiceController::class, 'read'])->middleware(['ability:read,Service']);
            Route::post('/', [ServiceController::class, 'create'])->middleware(['ability:create,Service']);

            /* user information includes fil image upload,
             * multipart/form-data content type is needed to use for files upload
             * so, method post with /update postfix
             */
            Route::post('/{id}/update', [ServiceController::class, 'update'])->middleware(['ability:update,Service']);

            Route::delete('/{id}', [ServiceController::class, 'delete'])->middleware(['ability:delete,Service']);
        });

        Route::group(['prefix' => 'packages'], function () {
            Route::get('/', [PackageController::class, 'index'])->middleware(['ability:index,Package']);
            Route::get('/{id}', [PackageController::class, 'read'])->middleware(['ability:read,Package']);
            Route::post('/', [PackageController::class, 'create'])->middleware(['ability:create,Package']);

            /* user information includes fil image upload,
             * multipart/form-data content type is needed to use for files upload
             * so, method post with /update postfix
             */
            Route::post('/{id}/update', [PackageController::class, 'update'])->middleware(['ability:update,Package']);

            Route::delete('/{id}', [PackageController::class, 'delete'])->middleware(['ability:delete,Package']);
        });

        Route::group(['prefix' => 'customers'], function () {
            Route::get('/', [CustomerController::class, 'index'])->middleware(['ability:index,Customer']);
            Route::get('/{id}', [CustomerController::class, 'read'])->middleware(['ability:read,Customer']);

            Route::post('/', [CustomerController::class, 'create'])->middleware(['ability:create,Customer']);
            Route::put('/{id}', [CustomerController::class, 'update'])->middleware(['ability:update,Customer']);
            Route::delete('/{id}', [CustomerController::class, 'delete'])->middleware(['ability:delete,Customer']);
        });

        Route::group(['prefix' => 'bookings'], function () {
            Route::get('/', [BookingController::class, 'index'])->middleware(['ability:index,Booking']);
            Route::get('/{id}', [BookingController::class, 'read'])->middleware(['ability:read,Booking']);
            Route::post('/', [BookingController::class, 'create'])->middleware(['ability:create,Booking']);

            Route::put('/{id}', [BookingController::class, 'update'])->middleware(['ability:update,Booking']);
            Route::delete('/{id}', [BookingController::class, 'delete'])->middleware(['ability:delete,Booking']);
        });

        Route::group(['prefix' => 'package-sales'], function () {
            Route::get('/', [PackageSaleController::class, 'index'])->middleware(['ability:index,PackageSale']);
            Route::get('/{id}', [PackageSaleController::class, 'read'])->middleware(['ability:read,PackageSale']);
            Route::post('/', [PackageSaleController::class, 'create'])->middleware(['ability:create,PackageSale']);

            Route::put('/{id}', [PackageSaleController::class, 'update'])->middleware(['ability:update,PackageSale']);
            Route::delete('/{id}', [PackageSaleController::class, 'delete'])->middleware(['ability:delete,PackageSale']);
        });

    });

});
