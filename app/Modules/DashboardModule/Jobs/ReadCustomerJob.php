<?php

namespace App\Modules\DashboardModule\Jobs;

use App\Models\Customer;
use App\Next\Core\Job;

class ReadCustomerJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private readonly int $serviceId)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $data = Customer::findOrFail($this->serviceId);

        return $data;
    }
}
