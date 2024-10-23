<?php

namespace App\Modules\MobileModule\Jobs;

use App\Models\Package;
use App\Next\Core\Job;

class ReadPackageJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private readonly int $packageId)
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
        $data = Package::with('services')->findOrFail($this->packageId);

        return $data;
    }
}
