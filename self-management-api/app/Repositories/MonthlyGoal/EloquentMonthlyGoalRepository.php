<?php

namespace App\Repositories\MonthlyGoal;

use App\Models\MonthlyGoal;
use App\Repositories\MonthlyGoal\MonthGoalRepositoryInterface;

class EloquentMonthlyGoalRepository implements MonthlyGoalRepositoryInterface
{
    public function getMonthlyGoalByRecordDate($yearMonthToSet, $userId)
    {
        return MonthlyGoal::where('user_id', $userId)
            ->where('year_month_to_set', $yearMonthToSet)
            ->get();
    }
}
