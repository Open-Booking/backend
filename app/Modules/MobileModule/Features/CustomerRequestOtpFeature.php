<?php

namespace App\Modules\MobileModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\MobileModule\Http\Requests\CustomerOtpRequest;
use App\Modules\MobileModule\Jobs\CustomerRequestOtpJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;

class CustomerRequestOtpFeature extends Feature
{
    /**
     * $channel accepts only 'email' or 'sms'.
     */
    public function __construct(private readonly string $channel)
    {
    }

    /**
     * Execute the feature.
     *
     * @return Illuminate\Http\JsonResponse;
     */
    public function handle(CustomerOtpRequest $request): JsonResponse
    {
        $response = $this->run(new CustomerRequestOtpJob($this->channel, $request->validated()));

        return JsonResponder::success('OTP request is successful.', $response);
    }
}
