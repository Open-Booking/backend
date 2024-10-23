<?php

namespace App\Modules\MobileModule\Jobs;

use App\Models\Service;
use App\Next\Core\Job;

class ReadServiceJob extends Job
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
        $data = Service::findOrFail($this->serviceId);

        return $data;
    }
}
