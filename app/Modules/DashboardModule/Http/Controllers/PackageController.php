<?php

namespace App\Modules\DashboardModule\Http\Controllers;

use App\Modules\DashboardModule\Features\CreatePackageFeature;
use App\Modules\DashboardModule\Features\DeletePackageFeature;
use App\Modules\DashboardModule\Features\IndexPackageFeature;
use App\Modules\DashboardModule\Features\ReadPackageFeature;
use App\Modules\DashboardModule\Features\UpdatePackageFeature;
use App\Next\Core\Controller;

class PackageController extends Controller
{
    public function index()
    {
        return $this->serve(new IndexPackageFeature());
    }

    public function create()
    {
        return $this->serve(new CreatePackageFeature());
    }

    public function read($id)
    {
        return $this->serve(new ReadPackageFeature($id));
    }

    public function update($id)
    {
        return $this->serve(new UpdatePackageFeature($id));
    }

    public function delete($id)
    {
        return $this->serve(new DeletePackageFeature($id));
    }
}
