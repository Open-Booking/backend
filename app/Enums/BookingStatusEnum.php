<?php

namespace App\Enums;

enum BookingStatusEnum: string
{
    case BOOKED = 'BOOKED';
    case ACKNOWLEDGED = 'ACKNOWLEDGED';
    case CONFIRMED = 'CONFIRMED';
    case COMPLETED = 'COMPLETED';
    case CANCELLED = 'CANCELLED';
}
