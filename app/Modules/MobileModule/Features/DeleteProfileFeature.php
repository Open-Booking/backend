<?php

namespace App\Modules\MobileModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\MobileModule\Jobs\DeleteProfileJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;

class DeleteProfileFeature extends Feature
{
    /**
     * Execute the feature.
     */
    public function handle(): JsonResponse
    {
        $this->run(new DeleteProfileJob());

        return JsonResponder::success('Your account is deleted successfully');
    }
}
