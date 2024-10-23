<?php

namespace App\Modules\CoreModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\CoreModule\Http\Requests\UpdateUserRequest;
use App\Modules\CoreModule\Jobs\UpdateUserJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;

class UpdateProfileFeature extends Feature
{
    /**
     * Execute the feature.
     */
    public function handle(UpdateUserRequest $request): JsonResponse
    {
        $user = $this->run(new UpdateUserJob($request->validated(), $request->user()->id));

        return JsonResponder::success('Profile information updated successfully', $user);
    }
}
