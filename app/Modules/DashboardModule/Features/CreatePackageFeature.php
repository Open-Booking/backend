<?php

namespace App\Modules\DashboardModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\DashboardModule\Http\Requests\CreatePackageRequest;
use App\Modules\DashboardModule\Jobs\CreatePackageJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class CreatePackageFeature extends Feature
{
    /**
     * Execute the feature.
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function handle(CreatePackageRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            $package = $this->run(CreatePackageJob::class, ['payload' => $request->validated()]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return JsonResponder::internalServerError('Error creating package: ' . $e->getMessage());
        }

        return JsonResponder::success('Package has been successfully created', $package);
    }
}
