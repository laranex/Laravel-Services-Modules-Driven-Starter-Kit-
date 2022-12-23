<?php

namespace App\Enums;

enum PermissionEnum: string
{
    case INDEX_APPLICATION_SERVICE = "index-application-services";
    case SHOW_APPLICATION_SERVICE = "show-application-services";
    case UPDATE_APPLICATION_SERVICE = "update-application-services";
}
