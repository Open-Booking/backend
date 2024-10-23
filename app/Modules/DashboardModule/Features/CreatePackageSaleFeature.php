<?php

namespace App\Modules\DashboardModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\DashboardModule\Http\Requests\CreatePackageSaleRequest;
use App\Modules\DashboardModule\Jobs\CreatePackageSaleJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;

class CreatePackageSaleFeature extends Feature
{
    /**
     * Execute the feature.
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function handle(CreatePackageSaleRequest $request): JsonResponse
    {
        try {
            $packageSale = $this->run(CreatePackageSaleJob::class, ['payload' => $request->validated()]);
        } catch (\Exception $e) {
            return JsonResponder::internalServerError($e->getMessage());
        }

        return JsonResponder::success('Package sale has been successfully created', $packageSale);
    }
}
