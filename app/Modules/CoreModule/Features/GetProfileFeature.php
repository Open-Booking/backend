<?php

namespace App\Modules\CoreModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\CoreModule\Jobs\GetProfileJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;

class GetProfileFeature extends Feature
{
    /**
     * Execute the feature.
     *
     * @return int
     */
    public function handle(): JsonResponse
    {
        $user = $this->run(new GetProfileJob());

        return JsonResponder::success('User profile has been retrieved successfully', $user);
    }
}
