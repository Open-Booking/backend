<?php

namespace App\Modules\DashboardModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\DashboardModule\Http\Requests\UpdateCustomerRequest;
use App\Modules\DashboardModule\Jobs\UpdateCustomerJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;

class UpdateCustomerFeature extends Feature
{
    public function __construct(private readonly int $customerId)
    {
    }

    /**
     * Execute the feature.
     */
    public function handle(UpdateCustomerRequest $request): JsonResponse
    {
        $customer = $this->run(new UpdateCustomerJob($request->validated(), $this->customerId));

        return JsonResponder::success('Customer has been updated successfully', $customer);
    }
}
