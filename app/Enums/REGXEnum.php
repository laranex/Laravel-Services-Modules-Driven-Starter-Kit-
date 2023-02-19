<?php

namespace App\Enums;

enum REGXEnum: string
{
    case COUNTRY_CODE = "/^\+(?:[0-9]{1,3} ?)$/";
    case MOBILE_NUMBER = '/^[1-9]{1}+[0-9]{7,9}$/';
    case NRC = "/^([0-9]{1,2})\/([A-Z]{5,12})\(([N,P,E,C])\)([0-9]{6})$/";
    case PASSPORT = '/^[A-Z0-9<]{9}[0-9]{1}[A-Z]{3}[0-9]{7}[A-Z]{1}[0-9]{7}[A-Z0-9<]{14}[0-9]{2}$/';
    case PREPAID_PACKAGE_MEMBER_CODE = "/[P]{1}\d{3,}/";
    case SUBSCRIPTION_MEMBER_CODE = "/[M]{1}\d{3,}/";
    case COLOR_CODE = "/(?:#|0x)(?:[a-f,A-F,0-9]{3}|[a-f,A-F,0-9]{6})\b|(?:rgb|hsl)a?\([^\)]*\)/";
}
