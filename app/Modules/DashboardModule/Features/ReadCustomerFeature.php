<?php

namespace App\Modules\DashboardModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\DashboardModule\Jobs\ReadCustomerJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;

class ReadCustomerFeature extends Feature
{
    public function __construct(private readonly int $customerId)
    {
    }

    /**
     * Execute the feature.
     */
    public function handle(): JsonResponse
    {
        $customer = $this->run(new ReadCustomerJob($this->customerId));

        return JsonResponder::success('Customer has been successfully retrieved', $customer);
    }
}
