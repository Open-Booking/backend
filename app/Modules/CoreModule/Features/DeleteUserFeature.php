<?php

namespace App\Modules\CoreModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\CoreModule\Operations\DeleteUserOperation;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class DeleteUserFeature extends Feature
{
    public function __construct(private readonly int $userId)
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
            $this->run(new DeleteUserOperation($this->userId));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return JsonResponder::internalServerError('Error deleting user: ' . $e->getMessage());
        }

        return JsonResponder::success('User has been successfully deleted');
    }
}
