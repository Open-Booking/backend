<?php

namespace App\Modules\DashboardModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\DashboardModule\Http\Requests\UpdateBookingRequest;
use App\Modules\DashboardModule\Jobs\UpdateBookingJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;

class UpdateBookingFeature extends Feature
{
    public function __construct(private readonly int $bookingId)
    {
    }

    /**
     * Execute the feature.
     */
    public function handle(UpdateBookingRequest $request): JsonResponse
    {
        $booking = $this->run(new UpdateBookingJob($request->validated(), $this->bookingId));

        return JsonResponder::success('Booking updated successfully', $booking);
    }
}
