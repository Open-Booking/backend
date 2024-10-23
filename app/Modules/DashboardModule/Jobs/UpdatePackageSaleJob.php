<?php

namespace App\Modules\DashboardModule\Jobs;

use App\Models\Customer;
use App\Models\Package;
use App\Models\PackageSale;
use App\Next\Core\Job;

class UpdatePackageSaleJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private array $payload, private readonly int $packageSaleId)
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

        $packageSale = PackageSale::findOrFail($this->packageSaleId);

        $package_id = $payload['package_id'];
        $customer_id = $payload['customer_id'];
        $payload['package_name'] = Package::where('id', $package_id)->pluck('name')->first()['en'];
        $payload['customer_name'] = Customer::where('id', $customer_id)->pluck('full_name')->first();

        $packageSale->update($payload);

        return $packageSale;
    }
}
