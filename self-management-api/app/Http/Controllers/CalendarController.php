<?php

namespace App\Http\Controllers;

use App\Services\DailyReportService;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class CalendarController extends Controller
{
    protected $dailyReportService;

    public function __construct(
        DailyReportService $dailyReportService
    ) {
        $this->dailyReportService = $dailyReportService;
    }

    /**
     * 指定した日付のカレンダーの情報を返却する
     *
     * @param Request $request
     * @param Date $reportDate
     *
     * @return Json
     */
    public function show(Request $request, Date $reportDate)
    {
        $userId = 1;
        $dailyReport = $this->dailyReportService->getDailyReport();
        // リストとか使って、月間目標も取得する
    }
}
