<?php

namespace App\Modules\DashboardModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\DashboardModule\Http\Requests\UpdatePackageSaleRequest;
use App\Modules\DashboardModule\Jobs\UpdatePackageSaleJob;
use App\Next\Core\Feature;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class UpdatePackageSaleFeature extends Feature
{
    public function __construct(private readonly int $packageSaleId)
    {
    }

    /**
     * Execute the feature.
     */
    public function handle(UpdatePackageSaleRequest $request): JsonResponse
    {
        try {
            $packageSale = $this->run(new UpdatePackageSaleJob($request->validated(), $this->packageSaleId));
        } catch (ModelNotFoundException $me) {
            return JsonResponder::notFound('Package sale is not found.');
        } catch (Exception $e) {
            return JsonResponder::internalServerError('Error updating package sale: ' . $e->getMessage());
        }

        return JsonResponder::success('Package sale updated successfully', $packageSale);
    }
}
