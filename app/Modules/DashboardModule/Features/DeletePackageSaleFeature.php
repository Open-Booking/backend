<?php

namespace App\Modules\DashboardModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\DashboardModule\Jobs\DeletePackageSaleJob;
use App\Next\Core\Feature;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class DeletePackageSaleFeature extends Feature
{
    public function __construct(private readonly int $packageSaleId)
    {
    }

    /**
     * Execute the feature.
     *
     * @return int
     */
    public function handle(): JsonResponse
    {

        try {
            $this->run(new DeletePackageSaleJob($this->packageSaleId));

        } catch (ModelNotFoundException $me) {
            return JsonResponder::notFound('Package sale is not found.');
        } catch (\Exception $e) {
            return JsonResponder::internalServerError('Error deleting package sale: ' . $e->getMessage());
        }

        return JsonResponder::success('Package sale has been successfully deleted.');
    }
}
