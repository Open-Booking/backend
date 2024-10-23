<?php

namespace App\Modules\DashboardModule\Jobs;

use App\Models\Customer;
use App\Next\Core\Job;

class DeleteCustomerJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private readonly int $customerId)
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
        $customer = Customer::findOrFail($this->customerId);

        return $customer->delete();
    }
}
