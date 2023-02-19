<?php

namespace App\Enums;

enum BloodTypeEnum: string
{
    case A = 'A';
    case B = 'B';
    case O = 'O';
    case AB = 'AB';
    case A_MINUS = 'A-';
    case B_MINUS = 'B-';
    case AB_MINUS = 'AB-';
    case O_MINUS = 'O-';
}
