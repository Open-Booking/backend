<?php

namespace App\Modules\MobileModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\MobileModule\Http\Requests\CreateBookingRequest;
use App\Modules\MobileModule\Jobs\CreateBookingJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;

class CreateBookingFeature extends Feature
{
    /**
     * Execute the feature.
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function handle(CreateBookingRequest $request): JsonResponse
    {
        $booking = $this->run(CreateBookingJob::class, ['payload' => $request->validated()]);

        return JsonResponder::success('Booking is successfully created!', $booking);
    }
}
