<?php

namespace App\Repositories\DailyReport;

use App\Models\DailyReport;
use App\Models\MonthlyGoal;
use App\Repositories\DailyReport\DailyReportRepositoryInterface;

class EloquentDailyReportRepository implements DailyReportRepositoryInterface
{
    public function __construct()
    {

    }

    public function getDailyReportByRecordDate($recordDate, $userId)
    {
        return DailyReport::with('workDetails.workDetailCategory')
            ->where('user_id', $userId)
            ->where('record_date', $recordDate)
            ->get();
    }

    public function getMonthlyGoalByRecordDate($yearMonthToSet, $userId)
    {
        return MonthlyGoal::where('user_id', $userId)
            ->where('year_month_to_set', $yearMonthToSet)
            ->get();
    }
}
