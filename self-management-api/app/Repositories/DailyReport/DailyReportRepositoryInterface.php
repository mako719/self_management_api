<?php

namespace App\Repositories\DailyReport;

interface DailyReportRepositoryInterface
{
    public function getDailyReportByRecordDate($reportDate, $userId);

    public function getMonthlyGoalByRecordDate($yearMonthToSet, $userId);
}
