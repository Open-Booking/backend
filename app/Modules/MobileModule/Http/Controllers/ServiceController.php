<?php

namespace App\Modules\MobileModule\Http\Controllers;

use App\Modules\MobileModule\Features\IndexServiceFeature;
use App\Modules\MobileModule\Features\ReadServiceFeature;
use App\Next\Core\Controller;

class ServiceController extends Controller
{
    public function index()
    {
        return $this->serve(new IndexServiceFeature());
    }

    public function read($id)
    {
        return $this->serve(new ReadServiceFeature($id));
    }
}
