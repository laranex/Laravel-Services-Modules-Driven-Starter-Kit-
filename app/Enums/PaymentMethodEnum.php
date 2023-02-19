<?php

namespace App\Enums;

enum PaymentMethodEnum: string
{
    case CASH = 'CASH';
    case WAVE = 'WAVE MONEY';
    case BANK_TRANSFER = 'BANK TRANSFER';
    case MPU_CARD = 'MPU CARD';
}
