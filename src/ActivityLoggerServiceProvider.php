<?php

namespace CodeHunger\LaravelActivityLogger;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;
use LaravelActivityLogger\Listeners\LogListener;
use LaravelActivityLogger\Commands\CleanupActivityLogs;

class ActivityLoggerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/activitylogger.php', 'activitylogger');

        $this->app->singleton('activity.logger', function () {
            return new ActivityLogger();
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/activitylogger.php' => config_path('activitylogger.php'),
        ], 'activitylogger-config');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        Event::listen(Login::class, [LogListener::class, 'handleLogin']);
        Event::listen(Logout::class, [LogListener::class, 'handleLogout']);
        Event::listen(Registered::class, [LogListener::class, 'handleRegistered']);

        if ($this->app->runningInConsole()) {
            $this->commands([
                CleanupActivityLogs::class,
            ]);
        }
    }
}
