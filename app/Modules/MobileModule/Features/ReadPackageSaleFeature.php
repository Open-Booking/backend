<?php

namespace App\Modules\MobileModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\MobileModule\Jobs\ReadPackageSaleJob;
use App\Next\Core\Feature;
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
        $packageSale = $this->run(new ReadPackageSaleJob($this->packageSaleId));

        return JsonResponder::success('Package order has been successfully retrieved!', $packageSale);
    }
}
