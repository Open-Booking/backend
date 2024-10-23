<?php

namespace App\Modules\DashboardModule\Http\Controllers;

use App\Modules\DashboardModule\Features\CreateBookingFeature;
use App\Modules\DashboardModule\Features\DeleteBookingFeature;
use App\Modules\DashboardModule\Features\IndexBookingFeature;
use App\Modules\DashboardModule\Features\ReadBookingFeature;
use App\Modules\DashboardModule\Features\UpdateBookingFeature;
use App\Next\Core\Controller;

class BookingController extends Controller
{
    public function index()
    {
        return $this->serve(new IndexBookingFeature());
    }

    public function create()
    {
        return $this->serve(new CreateBookingFeature());
    }

    public function read($id)
    {
        return $this->serve(new ReadBookingFeature($id));
    }

    public function update($id)
    {
        return $this->serve(new UpdateBookingFeature($id));
    }

    public function delete($id)
    {
        return $this->serve(new DeleteBookingFeature($id));
    }
}
