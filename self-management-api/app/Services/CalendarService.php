<?php

namespace App\Services;

use App\Repositories\DailyReport\DailyReportRepositoryInterface;
use Carbon\Carbon;

class CalendarService
{
    private $dailyReportRepo;

    public function __construct(DailyReportRepositoryInterface $dailyReportRepo)
    {
        $this->dailyReportRepo = $dailyReportRepo;
    }

    public function getDailyReport(Carbon $recordDate, int $userId)
    {
        return $this->dailyReportRepo->getDailyReportByRecordDate($recordDate, $userId);
    }

    public function getMonthlyGoal($recordDate, $userId)
    {
        return $this->dailyReportRepo->getMonthlyGoalByRecordDate($recordDate->format('Y-m'), $userId);
    }
}
