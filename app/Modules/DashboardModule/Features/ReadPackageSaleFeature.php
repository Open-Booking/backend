<?php

namespace App\Modules\DashboardModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\DashboardModule\Jobs\ReadPackageSaleJob;
use App\Next\Core\Feature;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class ReadPackageSaleFeature extends Feature
{
    public function __construct(private readonly int $packageSaleId)
    {
    }

    /**
     * Execute the feature.
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function handle(): JsonResponse
    {
        try {
            $packageSale = $this->run(new ReadPackageSaleJob($this->packageSaleId));
        } catch (ModelNotFoundException $me) {
            return JsonResponder::notFound('Package sale is not found.');
        } catch (Exception $e) {
            return JsonResponder::internalServerError('Error fetching Package sale: ' . $e->getMessage());
        }

        return JsonResponder::success('Package sale has been successfully retrieved!', $packageSale);
    }
}
