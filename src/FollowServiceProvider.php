<?php

namespace Ashmawi\LaravelFollow;

use Illuminate\Support\ServiceProvider;

class FollowServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/follow.php' => config_path('follow.php'),
        ], 'laravel-follow-config');
        $this->mergeConfigFrom(__DIR__.'/../config/follow.php', 'follow');

        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations')
        ], 'laravel-follow-migrations');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations/');
    }
}
