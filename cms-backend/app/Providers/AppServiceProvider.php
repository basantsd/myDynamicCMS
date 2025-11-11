<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Ensure critical directories exist
        $this->ensureDirectoriesExist();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Set custom lang path
        $this->app->useLangPath(base_path('cms-backend/resources/lang'));
    }

    /**
     * Ensure all required directories exist
     */
    protected function ensureDirectoriesExist(): void
    {
        $directories = [
            base_path('database'),
            base_path('storage/framework/cache/data'),
            base_path('storage/framework/sessions'),
            base_path('storage/framework/views'),
            base_path('storage/logs'),
            base_path('storage/app/public'),
            base_path('bootstrap/cache'),
            base_path('cms-backend/resources/views'),
            base_path('cms-backend/resources/lang/en'),
        ];

        foreach ($directories as $directory) {
            if (!is_dir($directory)) {
                @mkdir($directory, 0755, true);
            }
        }
    }
}
