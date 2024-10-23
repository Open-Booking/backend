<?php

namespace App\Next\Core;

use App\Next\Bus\ServesFeature;
use Illuminate\Foundation\Validation\ValidatesRequests;

class Controller
{
    use ServesFeature, ValidatesRequests;
}
