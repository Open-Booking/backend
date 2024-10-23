<?php

namespace App\Modules\CoreModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\CoreModule\Http\Requests\UpdateRoleRequest;
use App\Modules\CoreModule\Jobs\UpdateRoleJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class UpdateRoleFeature extends Feature
{
    public function __construct(private readonly int $roleId)
    {
    }

    /**
     * Execute the feature.
     */
    public function handle(UpdateRoleRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $role = $this->run(new UpdateRoleJob($request->validated(), $this->roleId));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return JsonResponder::internalServerError('Error updating role: ' . $e->getMessage());
        }

        return JsonResponder::success('Role updated successfully', $role);
    }
}
