<?php

namespace App\Modules\MobileModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\MobileModule\Jobs\IndexServiceJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class IndexServiceFeature extends Feature
{
    /**
     * Execute the feature.
     *
     * @return Illuminate\Http\JsonResponse;
     */
    public function handle(Request $request): JsonResponse
    {
        $services = $this->run(new IndexServiceJob($request));

        return JsonResponder::success('Services have been successfully retrieved', $services['data'], Arr::only($services, ['current_page', 'per_page', 'total']));
    }
}
