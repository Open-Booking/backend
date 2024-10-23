<?php

namespace App\Modules\CoreModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\CoreModule\Jobs\ReadRoleJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;

class ReadRoleFeature extends Feature
{
    public function __construct(private readonly int $roleId)
    {
    }

    /**
     * Execute the feature.
     *
     * @return int
     */
    public function handle(): JsonResponse
    {
        $role = $this->run(new ReadRoleJob($this->roleId));

        return JsonResponder::success('Role has been successfully retrieved', $role);
    }
}
