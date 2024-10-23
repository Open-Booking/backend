<?php

namespace App\Modules\DashboardModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\DashboardModule\Http\Requests\UpdateServiceRequest;
use App\Modules\DashboardModule\Jobs\UpdateServiceJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;

class UpdateServiceFeature extends Feature
{
    public function __construct(private readonly int $serviceId)
    {
    }

    /**
     * Execute the feature.
     */
    public function handle(UpdateServiceRequest $request): JsonResponse
    {
        $service = $this->run(new UpdateServiceJob($request->validated(), $this->serviceId));

        return JsonResponder::success('Service updated successfully', $service);
    }
}
