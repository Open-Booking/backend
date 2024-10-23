<?php

namespace App\Modules\DashboardModule\Jobs;

use App\Models\Customer;
use App\Models\Package;
use App\Models\PackageSale;
use App\Models\PackageSaleService;
use App\Next\Core\Job;
use Exception;
use Illuminate\Support\Facades\DB;

class CreatePackageSaleJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private array $payload)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $payload = $this->payload;

        DB::beginTransaction();
        try {
            $customer = Customer::findOrFail($payload['customer_id']);
            $package = Package::findOrFail($payload['package_id']);

            $payload['customer_name'] = $customer->full_name;
            $payload['package_name'] = $package->name['en'];
            $packageSale = PackageSale::create($payload);

            $packageSaleServices = [];
            $packages = Package::with('services')->findOrFail($payload['package_id']);
            foreach ($packages->services as $service) {
                $packageSaleServices[] = [
                    'package_sale_id' => $packageSale->id,
                    'customer_id' => $customer->id,
                    'customer_name' => $customer->full_name,
                    'service_id' => $service->id,
                    'service_name' => $service->name['en'],
                    'sale_date' => $packageSale->sale_date,
                    'expired_date' => $packageSale->expired_date,
                    'frequency' => $service->pivot->frequency ?? null,
                    'remaining_frequency' => $service->pivot->frequency ?? null,
                ];
            }

            PackageSaleService::insert($packageSaleServices);
            DB::commit();

            $packageSale['package_sale_services'] = $packageSaleServices;

            return $packageSale;
        } catch (Exception $e) {
            throw new Exception('Error creating package sale: ' . $e->getMessage());
        }

    }
}
