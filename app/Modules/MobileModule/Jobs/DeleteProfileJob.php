<?php

namespace App\Modules\MobileModule\Jobs;

use App\Enums\UserStatusEnum;
use App\Models\Customer;
use App\Next\Core\Job;

class DeleteProfileJob extends Job
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
        $id = auth()->id();
        $customer = Customer::findOrFail($id);
        $customer->update([
            'status' => UserStatusEnum::INACTIVE->value,
        ]);

        return true;
    }
}
