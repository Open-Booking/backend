<?php

namespace App\Modules\MobileModule\Http\Controllers;

use App\Modules\MobileModule\Features\CreateBookingFeature;
use App\Modules\MobileModule\Features\IndexBookingFeature;
use App\Modules\MobileModule\Features\ReadBookingFeature;
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
}
