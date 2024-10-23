<?php

namespace App\Modules\DashboardModule\Jobs;

use App\Enums\BookingStatusEnum;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Service;
use App\Next\Core\Job;
use Exception;
use Illuminate\Support\Facades\DB;

class CreateBookingJob extends Job
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
            $service = Service::findOrFail($payload['service_id']);
            $payload['service_name'] = $service->name['en'];
            $payload['customer_id'] = $customer->id;
            $payload['customer_name'] = $customer->full_name;
            // $payload['area_id'] = $customer->area_id; // area_id will be included
            $payload['status'] = BookingStatusEnum::BOOKED->value;
            $booking = Booking::create($payload);

            DB::commit();

            return $booking;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Error creating booking.' . $e->getMessage());
        }
    }
}
