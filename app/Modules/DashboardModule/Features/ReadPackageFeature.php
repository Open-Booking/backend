<?php

namespace App\Modules\DashboardModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\DashboardModule\Jobs\ReadPackageJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;

class ReadPackageFeature extends Feature
{
    public function __construct(private readonly int $packageId)
    {
    }

    /**
     * Execute the feature.
     */
    public function handle(): JsonResponse
    {
        $package = $this->run(new ReadPackageJob($this->packageId));

        return JsonResponder::success('Package has been successfully retrieved', $package);
    }
}
