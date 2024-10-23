<?php

namespace App\Modules\MobileModule\Jobs;

use App\Next\Core\Job;
use Tymon\JWTAuth\Facades\JWTAuth;

class CustomerLogoutJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        JWTAuth::invalidate(JWTAuth::getToken());
        auth()->guard('customer')->logout();
    }
}
