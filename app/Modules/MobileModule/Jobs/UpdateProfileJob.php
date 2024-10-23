<?php

namespace App\Modules\MobileModule\Jobs;

use App\Models\Customer;
use App\Next\Core\Job;

class UpdateProfileJob extends Job
{
    public function __construct(private array $payload, private readonly int $customerId)
    {
    }

    /**
     * Execute the job.
     *
     * @return Customer
     */
    public function handle()
    {
        $customer = Customer::with('area')->findOrFail($this->customerId);
        $customer->update($this->payload);

        return $customer;
    }
}
