<?php

namespace App\Modules\MobileModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\MobileModule\Http\Requests\UpdateProfileRequest;
use App\Modules\MobileModule\Jobs\UpdateProfileJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;

class UpdateProfileFeature extends Feature
{
    /**
     * Execute the feature.
     */
    public function handle(UpdateProfileRequest $request): JsonResponse
    {
        $profile = $this->run(new UpdateProfileJob($request->validated(), $request->user()->id));

        return JsonResponder::success('Profile information updated successfully', $profile);
    }
}
