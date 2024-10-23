<?php

namespace App\Modules\CoreModule\Features;

use App\Exceptions\UnauthorizedException;
use App\Helpers\JsonResponder;
use App\Modules\CoreModule\Http\Requests\LoginRequest;
use App\Modules\CoreModule\Jobs\LoginJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;

class LoginFeature extends Feature
{
    /**
     * Execute the feature.
     */
    public function handle(LoginRequest $request): JsonResponse
    {
        try {
            $response = $this->run(new LoginJob($request->validated()));

            return JsonResponder::success('Logged in successfully', $response);
        } catch (UnauthorizedException $ue) {
            return JsonResponder::unauthorized('Wrong Credentials');
        }
    }
}
