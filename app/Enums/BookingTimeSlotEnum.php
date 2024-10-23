<?php

namespace App\Enums;

enum BookingTimeSlotEnum: string
{
    case MORNING_8_11 = 'MORNING_8_11';
    case MORNING_9_12 = 'MORNING_9_12';
    case NOON_1_4 = 'NOON_1_4';
    case NOON_2_5 = 'NOON_2_5';
    case FULLDAY_9_5 = 'FULLDAY_9_5';

    public function getStartTime(): ?int
    {
        // Use a regular expression to extract the first number
        if (preg_match('/_(\d+)_/', $this->value, $matches)) {
            return (int) $matches[1];
        }

        return null;
    }
}
