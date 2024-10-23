<?php

namespace App\Modules\MobileModule\Jobs;

use App\Enums\BookingStatusEnum;
use App\Enums\BookingTimeSlotEnum;
use App\Models\Booking;
use App\Next\Core\Job;

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

        $customer = auth()->user();
        $payload['customer_id'] = $customer->id;
        $payload['customer_name'] = $customer->full_name;
        // $payload['area_id'] = $customer->area_id; // area_id will be included
        $payload['status'] = BookingStatusEnum::BOOKED->value;

        if (array_key_exists('time_slot', $payload) && !is_null($payload['time_slot'])) {
            $startTime = $this->getStartTimeFromPayload();
            if($startTime == 1) { // 1 PM to convert to 13, 24 hours format
                $startTime = 13;
            }
            if($startTime == 2) {// 2 PM to convert to 14, 24 hours format
                $startTime = 14;
            }
            $payload['booking_time'] = $startTime . ':00';
        }

        return Booking::create($payload);
    }

    function getStartTimeFromPayload(): ?int
    {
        $timeSlot = $this->payload['time_slot'] ?? null;

        if (!$timeSlot) {
            return null;
        }

        // Check if the time slot exists in the enum
        foreach (BookingTimeSlotEnum::cases() as $enumCase) {
            if ($enumCase->value === $timeSlot) {
                // If a match is found, extract the start time
                return $enumCase->getStartTime();
            }
        }

        return null; // Return null if no match is found
    }
}
