<?php

namespace App\Modules\MobileModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\MobileModule\Jobs\CustomerLogoutJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;

class CustomerLogoutFeature extends Feature
{
    /**
     * Execute the feature.
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function handle(): JsonResponse
    {
        $this->run(new CustomerLogoutJob());

        return JsonResponder::success('Logged out successfully');
    }
}
