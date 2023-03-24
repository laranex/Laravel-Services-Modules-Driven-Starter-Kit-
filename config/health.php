<?php

return [

    /*
     * A result store is responsible for saving the results of the checks. The
     * `EloquentHealthResultStore` will save results in the database. You
     * can use multiple stores at the same time.
     */
    'result_stores' => [
        // Spatie\Health\ResultStores\EloquentHealthResultStore::class => [
        //     'model' => Spatie\Health\Models\HealthCheckResultHistoryItem::class,
        //     'keep_history_for_days' => 5,
        // ],

        Spatie\Health\ResultStores\CacheHealthResultStore::class => [
            'store' => 'file',
        ],

        // Spatie\Health\ResultStores\JsonFileHealthResultStore::class => [
        //     'disk' => 's3',
        //     'path' => 'health.json',
        // ],

        // Spatie\Health\ResultStores\InMemoryHealthResultStore::class,

    ],

    /*
     * You can get notified when specific events occur. Out of the box you can use 'mail' and 'slack'.
     * For Slack you need to install laravel/slack-notification-channel.
     */
    'notifications' => [
        /*
         * Notifications will only get sent if this option is set to `true`.
         */
        'enabled' => env('HEALTH_CHECK_NOTI_ENABLED', false),

        'notifications' => [
            Spatie\Health\Notifications\CheckFailedNotification::class => ['mail'],
        ],

        /*
         * Here you can specify the notifiable to which the notifications should be sent. The default
         * notifiable will use the variables specified in this config file.
         */
        'notifiable' => Spatie\Health\Notifications\Notifiable::class,

        /*
         * When checks start failing, you could potentially end up getting
         * a notification every minute.
         *
         * With this setting, notifications are throttled. By default, you'll
         * only get one notification per hour.
         */
        'throttle_notifications_for_minutes' => 60,
        'throttle_notifications_key' => 'health:latestNotificationSentAt:',

        'mail' => [
            'to' => env('HEALTH_CHECK_NOTI_MAIL_TO', 'your@example.com'),

            'from' => [
                'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
                'name' => env('MAIL_FROM_NAME', 'Example'),
            ],
        ],

        'slack' => [
            'webhook_url' => env('HEALTH_CHECK_SLACK_WEBHOOK_URL', ''),

            /*
             * If this is set to null the default channel of the webhook will be used.
             */
            'channel' => null,

            'username' => null,

            'icon' => null,
        ],
    ],

    /*
     * You can let Oh Dear monitor the results of all health checks. This way, you'll
     * get notified of any problems even if your application goes totally down. Via
     * Oh Dear, you can also have access to more advanced notification options.
     */
    'oh_dear_endpoint' => [
        'enabled' => false,

        /*
         * When this option is enabled, the checks will run before sending a response.
         * Otherwise, we'll send the results from the last time the checks have run.
         */
        'always_send_fresh_results' => true,

        /*
         * The secret that is displayed at the Application Health settings at Oh Dear.
         */
        'secret' => env('OH_DEAR_HEALTH_CHECK_SECRET'),

        /*
         * The URL that should be configured in the Application health settings at Oh Dear.
         */
        'url' => '/oh-dear-health-check-results',
    ],

    /*
     * You can set a theme for the local results page
     *
     * - light: light mode
     * - dark: dark mode
     */
    'theme' => 'dark',

    /*
     * When enabled,  completed `HealthQueueJob`s will be displayed
     * in Horizon's silenced jobs screen.
     */
    'silence_health_queue_job' => true,

    'enabled' => env('HEALTH_CHECK_ENABLED', true),
    'api_key' => env('HEALTH_CHECK_API_KEY', 'onenex'),

    'checks' => [
        'DatabaseCheck' => env('HEALTH_CHECK_ENABLED_DB', true),
        'CacheCheck' => env('HEALTH_CHECK_ENABLED_CACHE', true),
        'OptimizedAppCheck' => env('HEALTH_CHECK_ENABLED_APP', true),
        'DebugModeCheck' => env('HEALTH_CHECK_ENABLED_DEBUG', true),
        'EnvironmentCheck' => env('HEALTH_CHECK_ENABLED_ENV', true),
        'HorizonCheck' => env('HEALTH_CHECK_ENABLED_HORIZON', true),
        'QueueCheck' => env('HEALTH_CHECK_ENABLED_QUEUE', false),
        'ScheduleCheck' => env('HEALTH_CHECK_ENABLED_SCHEDULE', false),
        'RedisCheck' => env('HEALTH_CHECK_ENABLED_REDIS', true),
        'RedisMemoryUsageCheck' => env('HEALTH_CHECK_REDIS_MEMORY_MB', 0),
        'PingCheck' => env('HEALTH_CHECK_PING_URL', ''),
    ],
];
