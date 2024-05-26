<?php

namespace App\Repositories\MonthlyGoal;

use App\Models\MonthlyGoal;
use App\Repositories\MonthlyGoal\MonthGoalRepositoryInterface;

class EloquentMonthlyGoalRepository implements MonthlyGoalRepositoryInterface
{
    private $monthlyGoal;

    public function __construct(MonthlyGoal $monthlyGoal)
    {
        $this->monthlyGoal = $monthlyGoal;
    }
    public function getMonthlyGoalByRecordDate($yearMonthToSet, $userId)
    {
        return $this->monthlyGoal::where('user_id', $userId)
            ->where('year_month_to_set', $yearMonthToSet)
            ->get();
    }
}
