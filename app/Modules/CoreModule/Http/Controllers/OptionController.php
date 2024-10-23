<?php

namespace App\Modules\CoreModule\Http\Controllers;

use App\Modules\CoreModule\Features\GetOptionFeature;
use App\Next\Core\Controller;

class OptionController extends Controller
{
    public function get($key)
    {
        return $this->serve(new GetOptionFeature($key));
    }
}
