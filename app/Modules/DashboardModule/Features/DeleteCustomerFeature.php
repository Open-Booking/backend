<?php

namespace App\Modules\DashboardModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\DashboardModule\Jobs\DeleteCustomerJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;

class DeleteCustomerFeature extends Feature
{
    public function __construct(private readonly int $customerId)
    {
    }

    /**
     * Execute the feature.
     *
     * @return int
     */
    public function handle(): JsonResponse
    {

        $this->run(new DeleteCustomerJob($this->customerId));

        return JsonResponder::success('Customer has been successfully deleted.');
    }
}
