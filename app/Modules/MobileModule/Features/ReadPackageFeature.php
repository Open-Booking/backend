<?php

namespace App\Modules\MobileModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\MobileModule\Jobs\ReadPackageJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;

class ReadPackageFeature extends Feature
{
    public function __construct(private readonly int $packageId)
    {
    }

    /**
     * Execute the feature.
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function handle(): JsonResponse
    {
        $package = $this->run(new ReadPackageJob($this->packageId));

        return JsonResponder::success('Service has been successfully retrieved', $package);
    }
}
