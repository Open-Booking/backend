<?php

namespace App\Modules\MobileModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\MobileModule\Http\Requests\CreatePackageSaleRequest;
use App\Modules\MobileModule\Jobs\CreatePackageSaleJob;
use App\Next\Core\Feature;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class CreatePackageSaleFeature extends Feature
{
    /**
     * Execute the feature.
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function handle(CreatePackageSaleRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $package_sale = $this->run(CreatePackageSaleJob::class, ['payload' => $request->validated()]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return JsonResponder::internalServerError('Error creating package order: ' . $e->getMessage());
        }

        return JsonResponder::success('Package order is successfully created!', $package_sale);
    }
}
