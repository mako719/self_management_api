<?php

namespace App\Providers;

use App\Repositories\DailyReport\DailyReportRepositoryInterface;
use App\Repositories\DailyReport\EloquentDailyReportRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(DailyReportRepositoryInterface::class, function($app) {
            return $app->make(EloquentDailyReportRepository::class);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
