<?php

namespace App\Modules\MobileModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\MobileModule\Jobs\IndexPackageJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class IndexPackageFeature extends Feature
{
    /**
     * Execute the feature.
     *
     * @return int
     */
    public function handle(Request $request): JsonResponse
    {
        $packages = $this->run(new IndexPackageJob($request));

        return JsonResponder::success('Packages have been successfully retrieved', $packages['data'], Arr::only($packages, ['current_page', 'per_page', 'total']));
    }
}
