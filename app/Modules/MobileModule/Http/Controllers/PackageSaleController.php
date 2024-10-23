<?php

namespace App\Modules\MobileModule\Http\Controllers;

use App\Modules\MobileModule\Features\CreatePackageSaleFeature;
use App\Modules\MobileModule\Features\IndexPackageSaleFeature;
use App\Modules\MobileModule\Features\ReadPackageSaleFeature;
use App\Next\Core\Controller;

class PackageSaleController extends Controller
{
    public function index()
    {
        return $this->serve(new IndexPackageSaleFeature());
    }

    public function create()
    {
        return $this->serve(new CreatePackageSaleFeature());
    }

    public function read($id)
    {
        return $this->serve(new ReadPackageSaleFeature($id));
    }
}
