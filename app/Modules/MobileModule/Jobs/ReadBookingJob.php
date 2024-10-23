<?php

namespace App\Modules\MobileModule\Jobs;

use App\Models\Booking;
use App\Next\Core\Job;

class ReadBookingJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private readonly int $bookingId)
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

        $data = Booking::where('customer_id', $customer_id)
            ->where('id', $this->bookingId)
            ->firstOrFail();

        return $data;
    }
}
