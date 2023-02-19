<?php

namespace App\Enums;

enum PermissionEnum: string
{
    // Authorization
    case MANAGE_ROLE = 'manage-role';
    case MANAGE_PERMISSION = 'manage-permission';
}
