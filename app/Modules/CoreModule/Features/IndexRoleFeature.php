<?php

namespace App\Modules\CoreModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\CoreModule\Jobs\IndexRoleJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class IndexRoleFeature extends Feature
{
    /**
     * Execute the feature.
     */
    public function handle(Request $request): JsonResponse
    {
        $roles = $this->run(new IndexRoleJob($request));

        return JsonResponder::success('Roles have been successfully retrieved', $roles['data'], Arr::only($roles, ['current_page', 'per_page', 'total']));
    }
}
