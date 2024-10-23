<?php

namespace App\Modules\MobileModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\MobileModule\Jobs\IndexBookingJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class IndexBookingFeature extends Feature
{
    /**
     * Execute the feature.
     *
     * @return Illuminate\Http\JsonResponse;
     */
    public function handle(Request $request): JsonResponse
    {
        $bookings = $this->run(new IndexBookingJob($request));

        return JsonResponder::success('Bookings have been successfully retrieved', $bookings['data'], Arr::only($bookings, ['current_page', 'per_page', 'total']));
    }
}
