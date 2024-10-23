<?php

use Illuminate\Support\Facades\Route;
use Laravel\Telescope\Telescope;

Route::get('/', fn () => view('welcome'));
Route::middleware(['web', \App\Http\Middleware\DisableOctane::class])
    ->group(function () {
        Telescope::routes();
    });
