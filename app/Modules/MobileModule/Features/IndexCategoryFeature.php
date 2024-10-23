<?php

namespace App\Modules\MobileModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\MobileModule\Jobs\IndexCategoryJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class IndexCategoryFeature extends Feature
{
    /**
     * Execute the feature.
     *
     * @return int
     */
    public function handle(Request $request): JsonResponse
    {
        $categories = $this->run(new IndexCategoryJob($request));

        return JsonResponder::success('Categories have been successfully retrieved', $categories['data'], Arr::only($categories, ['current_page', 'per_page', 'total']));
    }
}
