<?php

namespace App\Modules\DashboardModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\DashboardModule\Jobs\DeleteServiceJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;

class DeleteServiceFeature extends Feature
{
    public function __construct(private readonly int $serviceId)
    {
    }

    /**
     * Execute the feature.
     *
     * @return int
     */
    public function handle(): JsonResponse
    {

        $this->run(new DeleteServiceJob($this->serviceId));

        return JsonResponder::success('Service has been successfully deleted.');
    }
}
