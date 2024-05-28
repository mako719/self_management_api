<?php

namespace App\Http\Controllers;

use App\Services\DailyReportService;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;

class DailyReportController extends Controller
{
    protected $dailyReportService;

    public function __construct(
        DailyReportService $dailyReportService
    ) {
        $this->dailyReportService = $dailyReportService;
    }

    /**
     * 日報を作成する
     *
     * @param Request $request
     *
     * @return Json
     */
    public function store(Request $request)
    {
        $dailyReportId = $this->dailyReportService->createDailyReport($request);

        return response()->json(['daily_report_id' => $dailyReportId, 'record_time' => request('record-date')]);
    }

    /**
     * 日報を更新する
     *
     * @param Request $request
     *
     * @return Json
     */
    public function update(Request $request, int $dailyReportId)
    {
        $dailyReportId = $this->dailyReportService->updateDailyReport($request, $dailyReportId);

        return response()->json(['daily_report_id' => $dailyReportId, 'record_time' => request('record-date')]);
    }
}
