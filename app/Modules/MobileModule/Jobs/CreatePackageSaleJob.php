<?php

namespace App\Modules\MobileModule\Jobs;

use App\Enums\GeneralStatusEnum;
use App\Models\Package;
use App\Models\PackageSale;
use App\Models\PackageSaleService;
use App\Next\Core\Job;

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

        $customer = auth()->user();
        $payload['customer_id'] = $customer->id;
        $payload['customer_name'] = $customer->full_name;
        $payload['area_id'] = $customer->area_id;
        $payload['status'] = GeneralStatusEnum::PENDING->value;

        $packageSale = PackageSale::create($payload);

        $packageSaleServices = [];

        $packageId = $payload['package_id'];
        $packages = Package::with('services')->findOrFail($packageId);
        foreach ($packages->services as $service) {
            $packageSaleServices[] = [
                'package_sale_id' => $packageSale->id,
                'customer_id' => $customer->id,
                'customer_name' => $customer->full_name,
                'service_id' => $service->id,
                'service_name' => $service->name['en'],
                'sale_date' => $packageSale->sale_date,
                'frequency' => $service->pivot->frequency ?? null,
                'remaining_frequency' => $service->pivot->frequency ?? null,
            ];
        }
        PackageSaleService::insert($packageSaleServices);

        $packageSale['package_sale_services'] = $packageSaleServices;

        return $packageSale;

    }
}
