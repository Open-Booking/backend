<?php

use App\Modules\CoreModule\Http\Controllers\AuthController;
use App\Modules\CoreModule\Http\Controllers\OptionController;
use App\Modules\CoreModule\Http\Controllers\RoleController;
use App\Modules\CoreModule\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
|
| Register your module routes here.
|
*/

Route::group(['prefix' => '/v1/core'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/login', [AuthController::class, 'login']);
        Route::group(['middleware' => ['auth:sanctum', 'user.check']], function () {
            Route::post('logout', [AuthController::class, 'logout']);
            Route::post('logout-all-sessions', [AuthController::class, 'logoutAll']);
            Route::get('profile', [UserController::class, 'getProfile']);

            /* user information includes file/image upload,
             * frontend side needs to use [post] method by adding _method:PUT in payload
             * e.g formData.append('_method', 'PUT');
             * Laravel will correctly interpret the POST request as PUT because of the _method parameter
             */
            Route::put('profile', [UserController::class, 'updateProfile']);
        });
    });

    Route::group(['middleware' => ['auth:sanctum', 'user.check']], function () {
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', [UserController::class, 'index'])->middleware(['ability:index,User']);
            Route::get('/{id}', [UserController::class, 'read'])->middleware(['ability:read,User']);
            Route::post('/', [UserController::class, 'create'])->middleware(['ability:create,User']);

            /* user information includes file/image upload,
             * multipart/form-data content type is needed to use for files upload
             * so, method post with /update postfix
             */
            Route::post('/{id}/update', [UserController::class, 'update'])->middleware(['ability:update,User']);

            Route::delete('/{id}', [UserController::class, 'delete'])->middleware(['ability:delete,User']);
        });

        Route::group(['prefix' => 'roles'], function () {
            Route::get('/', [RoleController::class, 'index'])->middleware(['ability:index,User']);
            Route::get('/{id}', [RoleController::class, 'read'])->middleware(['ability:read,User']);
            Route::post('/', [RoleController::class, 'create'])->middleware(['ability:create,User']);
            Route::put('/{id}', [RoleController::class, 'update'])->middleware(['ability:update,User']);
            Route::delete('/{id}', [RoleController::class, 'delete'])->middleware(['ability:delete,User']);
        });

        Route::get('/options/{key}', [OptionController::class, 'get']); //should perform authorization in case inside job
    });

});
