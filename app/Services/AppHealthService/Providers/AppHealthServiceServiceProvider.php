<?php

namespace App\Services\AppHealthService\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Health\Facades\Health;

class AppHealthServiceServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap migrations and factories for:
     * - `php artisan migrate` command.
     * - factory() helper.
     *
     * Previous usage:
     * php artisan migrate --path=src/Services/AppHealthService/database/migrations
     * Now:
     * php artisan migrate
     *
     * @return void
     */
    public function boot()
    {
        $this->configureHealthCheck();
    }

    private function configureHealthCheck()
    {
        $healthChecks = [
            'DatabaseCheck',
            'CacheCheck',
            'OptimizedAppCheck',
            'DebugModeCheck',
            'EnvironmentCheck',
            'HorizonCheck',
            'QueueCheck',
            'ScheduleCheck',
            'RedisCheck',
        ];

        $healthCheckArray = [];

        foreach ($healthChecks as $checkModule) {
            if (config('health.checks.'.$checkModule)) {
                $module = '\\Spatie\\Health\\Checks\\Checks\\'.$checkModule;
                $healthCheckArray[] = $module::new();
            }
        }

        $redisMemoryUsageLimit = config('health.checks.RedisMemoryUsageCheck');
        if ($redisMemoryUsageLimit > 0) {
            $healthCheckArray[] = \Spatie\Health\Checks\Checks\RedisMemoryUsageCheck::new()->failWhenAboveMb($redisMemoryUsageLimit);
        }

        $pingCheckUrl = config('health.checks.PingCheck');
        if ($pingCheckUrl != '') {
            $healthCheckArray[] = \Spatie\Health\Checks\Checks\PingCheck::new()->url($pingCheckUrl);
        }

        if (count($healthCheckArray)) {
            Health::checks($healthCheckArray);
        }
    }

    /**
     * Register the AppHealthService service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
