<?php

namespace App\Services;

use App\Repositories\DailyReport\DailyReportRepositoryInterface;
use App\Repositories\MonthlyGoal\MonthlyGoalRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalendarService
{
    private $dailyReportRepo;
    private $monthlyGoalRepo;

    public function __construct(DailyReportRepositoryInterface $dailyReportRepo, MonthlyGoalRepositoryInterface $monthlyGoalRepo)
    {
        $this->dailyReportRepo = $dailyReportRepo;
        $this->monthlyGoalRepo = $monthlyGoalRepo;
    }

    public function getcalendarContents(Request $request, string $recordDate = null)
    {
        if (is_null($recordDate)) {
            $recordDate = today();
        } else {
            $recordDate = Carbon::parse($recordDate);
        }
        $userId = $request->header('personal-id');
        $dailyReport = $this->dailyReportRepo->getDailyReportByRecordDate($recordDate, $userId);
        $monthlyGoal = $this->monthlyGoalRepo->getMonthlyGoalByRecordDate($recordDate->format('Ym'), $userId);

        return [$dailyReport, $monthlyGoal, $userId];
    }
}
