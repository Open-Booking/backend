<?php

namespace App\Modules\DashboardModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\DashboardModule\Http\Requests\CreateBookingRequest;
use App\Modules\DashboardModule\Jobs\CreateBookingJob;
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

        try {
            $package = $this->run(CreateBookingJob::class, ['payload' => $request->validated()]);
        } catch (\Exception $e) {
            return JsonResponder::internalServerError($e->getMessage());
        }

        return JsonResponder::success('Booking has been successfully created', $package);
    }
}
