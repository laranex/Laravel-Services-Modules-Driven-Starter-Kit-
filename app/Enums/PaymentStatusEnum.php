<?php

namespace App\Enums;

enum PaymentStatusEnum: string
{
    case PENDING = 'PENDING';
    case COMPLETED = 'COMPLETED';
}
