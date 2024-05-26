<?php

namespace App\Repositories\MonthlyGoal;

interface MonthlyGoalRepositoryInterface
{
    public function getMonthlyGoalByRecordDate($yearMonthToSet, $userId);
}
