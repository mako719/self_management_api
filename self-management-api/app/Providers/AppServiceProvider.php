<?php

namespace App\Providers;

use App\Repositories\DailyReport\DailyReportRepositoryInterface;
use App\Repositories\DailyReport\EloquentDailyReportRepository;
use App\Repositories\MonthlyGoal\EloquentMonthlyGoalRepository;
use App\Repositories\MonthlyGoal\MonthlyGoalRepositoryInterface;
use App\Repositories\WorkDetail\EloquentWorkDetailCategoryRepository;
use App\Repositories\WorkDetail\EloquentworkDetailRepository;
use App\Repositories\WorkDetail\WorkDetailCategoryRepositoryInterface;
use App\Repositories\WorkDetail\WorkDetailRepositoryInterface;
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
        $this->app->bind(MonthlyGoalRepositoryInterface::class, function($app) {
            return $app->make(EloquentMonthlyGoalRepository::class);
        });
        $this->app->bind(WorkDetailRepositoryInterface::class, function($app) {
            return $app->make(EloquentworkDetailRepository::class);
        });
        $this->app->bind(WorkDetailCategoryRepositoryInterface::class, function($app) {
            return $app->make(EloquentWorkDetailCategoryRepository::class);
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
