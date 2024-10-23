<?php

namespace App\Modules\CoreModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\CoreModule\Jobs\IndexUserJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class IndexUserFeature extends Feature
{
    /**
     * Execute the feature.
     */
    public function handle(Request $request): JsonResponse
    {
        $users = $this->run(new IndexUserJob($request));

        return JsonResponder::success('Users have been successfully retrieved', $users['data'], Arr::only($users, ['current_page', 'per_page', 'total']));
    }
}
