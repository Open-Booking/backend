<?php

namespace App\Modules\DashboardModule\Jobs;

use App\Models\Booking;
use App\Next\Core\Job;
use Exception;

class DeleteBookingJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private readonly int $bookingId)
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
        try {
            $booking = Booking::findOrFail($this->bookingId);

            return $booking->delete();
        } catch (Exception $e) {
            throw new Exception('Error deleting booking: ' . $e->getMessage());
        }
    }
}
