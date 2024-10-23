<?php

namespace App\Modules\DashboardModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\DashboardModule\Jobs\ReadServiceJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;

class ReadServiceFeature extends Feature
{
    public function __construct(private readonly int $serviceId)
    {
    }

    /**
     * Execute the feature.
     */
    public function handle(): JsonResponse
    {
        $service = $this->run(new ReadServiceJob($this->serviceId));

        return JsonResponder::success('Service has been successfully retrieved', $service);
    }
}
