<?php

namespace App\Enums;

enum TokenUseCaseEnum: string
{
    case CUSTOMER_REGISTRATION = 'CUSTOMER_REGISTRATION';
    case CUSTOMER_LOGIN = 'CUSTOMER_LOGIN';
}
