<?php

namespace App\Services;

use App\Repositories\DailyReport\DailyReportRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalendarService
{
    private $dailyReportRepo;

    public function __construct(DailyReportRepositoryInterface $dailyReportRepo)
    {
        $this->dailyReportRepo = $dailyReportRepo;
    }

    public function getcalendarContents(Request $request, string $recordDate = null)
    {
        if (is_null($recordDate)){
            $recordDate = today();
        } else {
            $recordDate = Carbon::parse($recordDate);
        }
        $userId = $request->header('personal-id');
        $dailyReport = $this->dailyReportRepo->getDailyReportByRecordDate($recordDate, $userId);
        $monthlyGoal = $this->dailyReportRepo->getMonthlyGoalByRecordDate($recordDate->format('Ym'), $userId);

        return $dailyReport->push($monthlyGoal);
    }
}
