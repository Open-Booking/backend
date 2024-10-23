<?php

namespace App\Modules\DashboardModule\Http\Controllers;

use App\Modules\DashboardModule\Features\CreateServiceFeature;
use App\Modules\DashboardModule\Features\DeleteServiceFeature;
use App\Modules\DashboardModule\Features\IndexServiceFeature;
use App\Modules\DashboardModule\Features\ReadServiceFeature;
use App\Modules\DashboardModule\Features\UpdateServiceFeature;
use App\Next\Core\Controller;

class ServiceController extends Controller
{
    public function index()
    {
        return $this->serve(new IndexServiceFeature());
    }

    public function create()
    {
        return $this->serve(new CreateServiceFeature());
    }

    public function read($id)
    {
        return $this->serve(new ReadServiceFeature($id));
    }

    public function update($id)
    {
        return $this->serve(new UpdateServiceFeature($id));
    }

    public function delete($id)
    {
        return $this->serve(new DeleteServiceFeature($id));
    }
}
