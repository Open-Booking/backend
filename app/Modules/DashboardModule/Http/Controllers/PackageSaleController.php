<?php

namespace App\Modules\DashboardModule\Http\Controllers;

use App\Modules\DashboardModule\Features\CreatePackageSaleFeature;
use App\Modules\DashboardModule\Features\DeletePackageSaleFeature;
use App\Modules\DashboardModule\Features\IndexPackageSaleFeature;
use App\Modules\DashboardModule\Features\ReadPackageSaleFeature;
use App\Modules\DashboardModule\Features\UpdatePackageSaleFeature;
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

    public function update($id)
    {
        return $this->serve(new UpdatePackageSaleFeature($id));
    }

    public function delete($id)
    {
        return $this->serve(new DeletePackageSaleFeature($id));
    }
}
