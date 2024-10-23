<?php

namespace App\Modules\CoreModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\CoreModule\Jobs\LogoutJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;

class LogoutFeature extends Feature
{
    /**
     * Execute the feature.
     *
     * @return int
     */
    public function handle(): JsonResponse
    {
        $this->run(new LogoutJob());

        return JsonResponder::success('Logged out successfully');
    }
}
