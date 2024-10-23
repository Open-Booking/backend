<?php

namespace App\Modules\DashboardModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\DashboardModule\Http\Requests\UpdatePackageRequest;
use App\Modules\DashboardModule\Jobs\UpdatePackageJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;

class UpdatePackageFeature extends Feature
{
    public function __construct(private readonly int $packageId)
    {
    }

    /**
     * Execute the feature.
     */
    public function handle(UpdatePackageRequest $request): JsonResponse
    {
        $package = $this->run(new UpdatePackageJob($request->validated(), $this->packageId));

        return JsonResponder::success('Package updated successfully', $package);
    }
}
