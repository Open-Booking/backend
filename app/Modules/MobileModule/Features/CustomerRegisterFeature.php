<?php

namespace App\Modules\MobileModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\MobileModule\Http\Requests\CustomerRegisterRequest;
use App\Modules\MobileModule\Jobs\CustomerRegisterJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;

class CustomerRegisterFeature extends Feature
{
    /**
     * Execute the feature.
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function handle(CustomerRegisterRequest $request): JsonResponse
    {
        [$is_valid, $customer] = $this->run(new CustomerRegisterJob($request->validated()));
        if (!$is_valid) {
            return JsonResponder::unauthorized('OTP is invalid!');
        }

        return JsonResponder::success('Registered successfully', $customer);
    }
}
