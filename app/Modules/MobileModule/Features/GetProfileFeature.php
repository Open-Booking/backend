<?php

namespace App\Modules\MobileModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\MobileModule\Jobs\GetProfileJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;

class GetProfileFeature extends Feature
{
    /**
     * Execute the feature.
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function handle(): JsonResponse
    {
        $profile = $this->run(new GetProfileJob());

        return JsonResponder::success('Profile has been successfully retrieved', $profile);
    }
}
