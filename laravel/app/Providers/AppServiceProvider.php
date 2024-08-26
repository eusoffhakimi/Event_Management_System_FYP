<?php

namespace App\Providers;

use App\Services\CollaborativeFilteringRecommenderSystem;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CollaborativeFilteringRecommenderSystem::class, function ($app) {
            return new CollaborativeFilteringRecommenderSystem;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
