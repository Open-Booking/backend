<?php

namespace App\Modules\MobileModule\Jobs;

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
        //
        $customer_id = auth()->id();

        $data = PackageSale::where('customer_id', $customer_id)
            ->where('id', $this->packageSaleId)
            ->firstOrFail();

        return $data;
    }
}
