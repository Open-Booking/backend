<?php

namespace App\Next\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Laranex\NextLaravel\NextLaravel
 */
class NextLaravel extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Next\NextLaravel::class;
    }
}
