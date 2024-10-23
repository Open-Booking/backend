<?php

namespace App\Modules\DashboardModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\DashboardModule\Jobs\IndexPackageSaleJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class IndexPackageSaleFeature extends Feature
{
    /**
     * Execute the feature.
     */
    public function handle(Request $request): JsonResponse
    {
        $packageSales = $this->run(new IndexPackageSaleJob($request));

        return JsonResponder::success('Package sales has been successfully retrieved', $packageSales['data'], Arr::only($packageSales, ['current_page', 'per_page', 'total']));
    }
}
