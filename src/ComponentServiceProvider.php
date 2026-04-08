<?php

namespace anthonymacs\LaravelComponents;

use Illuminate\Support\ServiceProvider;

class ComponentServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Load views from the package
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'components');

        // Publish views so users can override them
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/components'),
        ], 'components-views');
    }

    public function register(): void
    {
        //
    }
}