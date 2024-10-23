<?php

namespace App\Modules\DashboardModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\DashboardModule\Http\Requests\CreateCustomerRequest;
use App\Modules\DashboardModule\Jobs\CreateCustomerJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;

class CreateCustomerFeature extends Feature
{
    /**
     * Execute the feature.
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function handle(CreateCustomerRequest $request): JsonResponse
    {
        $customer = $this->run(CreateCustomerJob::class, ['payload' => $request->validated()]);

        return JsonResponder::success('Customer has been successfully created', $customer);
    }
}
