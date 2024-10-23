<?php

namespace App\Modules\DashboardModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\DashboardModule\Http\Requests\CreateServiceRequest;
use App\Modules\DashboardModule\Jobs\CreateServiceJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;

class CreateServiceFeature extends Feature
{
    /**
     * Execute the feature.
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function handle(CreateServiceRequest $request): JsonResponse
    {
        $service = $this->run(CreateServiceJob::class, ['payload' => $request->validated()]);

        return JsonResponder::success('Service has been successfully created', $service);
    }
}
