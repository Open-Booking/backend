<?php

namespace App\Modules\CoreModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\CoreModule\Http\Requests\CreateUserRequest;
use App\Modules\CoreModule\Jobs\CreateUserJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;

class CreateUserFeature extends Feature
{
    /**
     * Execute the feature.
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function handle(CreateUserRequest $request): JsonResponse
    {
        $user = $this->run(CreateUserJob::class, ['payload' => $request->validated()]);

        return JsonResponder::success('User has been successfully created', $user);
    }
}
