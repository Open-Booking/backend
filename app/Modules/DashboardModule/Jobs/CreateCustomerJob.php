<?php

namespace App\Modules\DashboardModule\Jobs;

use App\Models\Customer;
use App\Next\Core\Job;

class CreateCustomerJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private array $payload)
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
        $payload = $this->payload;
        $customer = Customer::create($payload);

        return $customer;
    }
}
