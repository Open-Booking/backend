<?php

namespace App\Modules\DashboardModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\DashboardModule\Jobs\DeletePackageJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class DeletePackageFeature extends Feature
{
    public function __construct(private readonly int $packageId)
    {
    }

    /**
     * Execute the feature.
     *
     * @return int
     */
    public function handle(): JsonResponse
    {

        DB::beginTransaction();

        try {
            $this->run(new DeletePackageJob($this->packageId));

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return JsonResponder::internalServerError('Error deleting package: ' . $e->getMessage());
        }

        return JsonResponder::success('Package has been successfully deleted.');
    }
}
