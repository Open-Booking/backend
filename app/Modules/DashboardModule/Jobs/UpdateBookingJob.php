<?php

namespace App\Modules\DashboardModule\Jobs;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Service;
use App\Next\Core\Job;

class UpdateBookingJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private array $payload, private readonly int $bookingId)
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

        $booking = Booking::findOrFail($this->bookingId);

        $service_id = $payload['service_id'];
        $customer_id = $payload['customer_id'];
        $payload['service_name'] = Service::where('id', $service_id)->pluck('name')->first()['en'];
        $payload['customer_name'] = Customer::where('id', $customer_id)->pluck('full_name')->first();

        $booking->update($payload);

        return $booking;
    }
}
