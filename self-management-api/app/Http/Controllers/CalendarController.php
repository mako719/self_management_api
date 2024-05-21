<?php

namespace App\Http\Controllers;

use App\Services\CalendarService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    protected $calendarService;

    public function __construct(
        CalendarService $calendarService
    ) {
        $this->calendarService = $calendarService;
    }

    /**
     * 指定した日付のカレンダーの情報を返却する
     *
     * @param Request $request
     * @param String $reportDate
     *
     * @return Json
     */
    public function show(Request $request, string $recordDate = null)
    {
        $recordDate = Carbon::parse($recordDate);
        $userId = $request->header('personal-id');
        $dailyReport = $this->calendarService->getDailyReport($recordDate, $userId);
        $monthlyGoal = $this->calendarService->getMonthlyGoal($recordDate, $userId);
    }
}
