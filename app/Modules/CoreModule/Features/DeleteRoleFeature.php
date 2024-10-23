<?php

namespace App\Modules\CoreModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\CoreModule\Jobs\DeleteRoleJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class DeleteRoleFeature extends Feature
{
    public function __construct(private readonly int $roleId)
    {
    }

    /**
     * Execute the feature.
     */
    public function handle(): JsonResponse
    {
        DB::beginTransaction();
        try {
            $this->run(new DeleteRoleJob($this->roleId));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return JsonResponder::internalServerError('Error deleting role: ' . $e->getMessage());
        }

        return JsonResponder::success('Role deleted successfully');
    }
}
