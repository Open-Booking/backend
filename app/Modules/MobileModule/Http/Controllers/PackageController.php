<?php

namespace App\Modules\MobileModule\Http\Controllers;

use App\Modules\MobileModule\Features\IndexPackageFeature;
use App\Modules\MobileModule\Features\ReadPackageFeature;
use App\Next\Core\Controller;

class PackageController extends Controller
{
    public function index()
    {
        return $this->serve(new IndexPackageFeature());
    }

    public function read($id)
    {
        return $this->serve(new ReadPackageFeature($id));
    }
}
