<?php

namespace App\Modules\MobileModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\MobileModule\Jobs\IndexPackageSaleJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class IndexPackageSaleFeature extends Feature
{
    /**
     * Execute the feature.
     *
     * @return Illuminate\Http\JsonResponse;
     */
    public function handle(Request $request): JsonResponse
    {
        $package_sales = $this->run(new IndexPackageSaleJob($request));

        return JsonResponder::success('Package orders have been successfully retrieved', $package_sales['data'], Arr::only($package_sales, ['current_page', 'per_page', 'total']));
    }
}
