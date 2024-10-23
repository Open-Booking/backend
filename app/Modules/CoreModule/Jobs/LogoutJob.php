<?php

namespace App\Modules\CoreModule\Jobs;

use App\Next\Core\Job;
use Illuminate\Support\Facades\Auth;

class LogoutJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Auth::user()->currentAccessToken()->delete();
    }
}
