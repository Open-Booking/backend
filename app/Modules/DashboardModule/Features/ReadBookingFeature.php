<?php

namespace App\Modules\DashboardModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\DashboardModule\Jobs\ReadBookingJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;

class ReadBookingFeature extends Feature
{
    public function __construct(private readonly int $bookingId)
    {
    }

    /**
     * Execute the feature.
     */
    public function handle(): JsonResponse
    {
        $booking = $this->run(new ReadBookingJob($this->bookingId));

        return JsonResponder::success('Booking has been successfully retrieved', $booking);
    }
}
