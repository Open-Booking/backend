<?php

namespace App\Modules\DashboardModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\DashboardModule\Jobs\IndexCustomerJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class IndexCustomerFeature extends Feature
{
    /**
     * Execute the feature.
     */
    public function handle(Request $request): JsonResponse
    {
        $customers = $this->run(new IndexCustomerJob($request));

        return JsonResponder::success('Customers have been successfully retrieved', $customers['data'], Arr::only($customers, ['current_page', 'per_page', 'total']));
    }
}
