<?php

namespace App\Modules\DashboardModule\Jobs;

use App\Models\PackageSale;
use App\Next\Core\Job;

class ReadPackageSaleJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private readonly int $packageSaleId)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = PackageSale::with('services')->findOrFail($this->packageSaleId);

        return $data;
    }
}
