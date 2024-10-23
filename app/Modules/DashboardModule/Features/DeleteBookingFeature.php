<?php

namespace App\Modules\DashboardModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\DashboardModule\Jobs\DeleteBookingJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;

class DeleteBookingFeature extends Feature
{
    public function __construct(private readonly int $bookingId)
    {
    }

    /**
     * Execute the feature.
     *
     * @return int
     */
    public function handle(): JsonResponse
    {
        try {
            $this->run(new DeleteBookingJob($this->bookingId));
        } catch (\Exception $e) {
            return JsonResponder::internalServerError($e->getMessage());
        }

        return JsonResponder::success('Booking has been successfully deleted.');
    }
}
