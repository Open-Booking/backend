<?php

namespace App\Modules\MobileModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\MobileModule\Jobs\ReadServiceJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;

class ReadServiceFeature extends Feature
{
    public function __construct(private readonly int $serviceId)
    {
    }

    /**
     * Execute the feature.
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function handle(): JsonResponse
    {
        $service = $this->run(new ReadServiceJob($this->serviceId));

        return JsonResponder::success('Service has been successfully retrieved', $service, [
            'urgent_fee' => config('custom.booking.urgent_fee')
        ]);
    }
}
