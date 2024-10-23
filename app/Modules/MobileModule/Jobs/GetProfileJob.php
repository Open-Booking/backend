<?php

namespace App\Modules\MobileModule\Jobs;

use App\Models\Customer;
use App\Next\Core\Job;

class GetProfileJob extends Job
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
        // Retrieve the authenticated user data
        return Customer::findOrFail(auth()->id());
    }
}
