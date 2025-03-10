<?php

namespace Azmolla\MaintenanceMode;

use Azmolla\MaintenanceMode\Commands\PublishCommand;
use Azmolla\MaintenanceMode\Http\Middleware\CheckMaintenanceMode;
use Illuminate\Support\ServiceProvider;

class MaintenanceModeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Load routes
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        // Load migrations
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        // Load views
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'maintenance-mode');

        // Register middleware
        $this->app['router']->aliasMiddleware('maintenance-mode', CheckMaintenanceMode::class);

        // Register commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                PublishCommand::class,
            ]);

            // Publish resources
            $this->publishes([
                __DIR__ . '/resources/views' => resource_path('views/vendor/maintenance-mode'),
            ], 'maintenance-mode-views');

            $this->publishes([
                __DIR__ . '/config/maintenance-mode.php' => config_path('maintenance-mode.php'),
            ], 'maintenance-mode-config');

            $this->publishes([
                __DIR__ . '/resources/assets' => public_path('vendor/maintenance-mode'),
            ], 'maintenance-mode-assets');
        }
    }

    public function register()
    {
        // Merge config
        $this->mergeConfigFrom(
            __DIR__ . '/config/maintenance-mode.php', 'maintenance-mode'
        );
    }
}
