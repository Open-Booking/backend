<?php

namespace App\Modules\DashboardModule\Http\Controllers;

use App\Modules\DashboardModule\Features\CreateCustomerFeature;
use App\Modules\DashboardModule\Features\DeleteCustomerFeature;
use App\Modules\DashboardModule\Features\IndexCustomerFeature;
use App\Modules\DashboardModule\Features\ReadCustomerFeature;
use App\Modules\DashboardModule\Features\UpdateCustomerFeature;
use App\Next\Core\Controller;

class CustomerController extends Controller
{
    public function index()
    {
        return $this->serve(new IndexCustomerFeature());
    }

    public function read($id)
    {
        return $this->serve(new ReadCustomerFeature($id));
    }

    public function create()
    {
        return $this->serve(new CreateCustomerFeature());
    }

    public function update($id)
    {
        return $this->serve(new UpdateCustomerFeature($id));
    }

    public function delete($id)
    {
        return $this->serve(new DeleteCustomerFeature($id));
    }
}
