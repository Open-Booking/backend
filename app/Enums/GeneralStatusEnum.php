<?php

namespace App\Enums;

enum GeneralStatusEnum: string
{
    case PENDING = 'PENDING';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
    case CANCELLED = 'CANCELLED';
}
