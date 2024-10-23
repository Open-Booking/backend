<?php

namespace App\Modules\DashboardModule\Jobs;

use App\Models\Customer;
use App\Next\Core\Job;

class UpdateCustomerJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private array $payload, private readonly int $customerId)
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
        $customer = Customer::findOrFail($this->customerId);

        $customer->update($payload);

        return $customer;
    }
}
