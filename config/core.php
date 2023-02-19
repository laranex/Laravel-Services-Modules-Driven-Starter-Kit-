<?php

use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
use App\Helpers\Enum;

return [

    /**
     * This key will determine if the services of lucid application should be loaded from Database or not.
     * If false, the App\Providers\AppServiceProvider will register all the lucid services under config of
     * core.lucid_application_providers.
     *
     * if true, The App\Services\ApplicationService\Providers will take care of loading the services from database
     * depending on their active statuses (true).
     */
    'toggle_app_services' => env('TOGGLE_APP_SERVICES', true),

    /**
     * Define your service of lucid application here and re-run the Database\Seeders\ApplicationServiceSeeder
     */
    'lucid_application_providers' => [
        [
            'provider' => \App\Services\Auth\Providers\AuthServiceProvider::class,
            'description' => 'Application Core Authentication Service',
            'force_required' => true,
            'active' => true,
        ],
        [
            'provider' => \App\Services\Authorization\Providers\AuthorizationServiceProvider::class,
            'description' => 'Application Core Authorization Service',
            'force_required' => true,
            'active' => true,
        ],

    ],

    'roles' => Enum::make(RoleEnum::class)->values(),
    'permissions' => Enum::make(PermissionEnum::class)->values(),
];
