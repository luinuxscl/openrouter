<?php

namespace Luinuxscl\OpenRouter\Providers;

use Illuminate\Support\ServiceProvider;
use Luinuxscl\OpenRouter\Services\OpenRouterService;

class OpenRouterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/openrouter.php', 'openrouter'
        );

        $this->app->singleton(OpenRouterService::class, function ($app) {
            return new OpenRouterService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../config/openrouter.php' => config_path('openrouter.php'),
            ], 'openrouter-config');
        }
    }
} 