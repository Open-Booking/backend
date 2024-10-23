<?php

namespace App\Modules\MobileModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\MobileModule\Http\Requests\CustomerLoginRequest;
use App\Modules\MobileModule\Jobs\CustomerLoginJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;

class CustomerLoginFeature extends Feature
{
    /**
     * Execute the feature.
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function handle(CustomerLoginRequest $request): JsonResponse
    {
        [$is_valid, $customer, $message] = $this->run(new CustomerLoginJob($request->validated()));

        if (!$is_valid) {
            return JsonResponder::unauthorized($message);
        }

        return JsonResponder::success($message, $customer);
    }
}
