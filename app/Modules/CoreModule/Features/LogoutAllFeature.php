<?php

namespace App\Modules\CoreModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\CoreModule\Jobs\LogoutAllSessionsJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LogoutAllFeature extends Feature
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
        $this->run(new LogoutAllSessionsJob(Auth::id()));

        return JsonResponder::success('Logged out of all sessions successfully');
    }
}
