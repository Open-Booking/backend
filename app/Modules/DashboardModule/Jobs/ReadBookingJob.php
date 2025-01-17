<?php

namespace App\Modules\DashboardModule\Jobs;

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
        $data = Booking::findOrFail($this->bookingId);

        return $data;
    }
}
