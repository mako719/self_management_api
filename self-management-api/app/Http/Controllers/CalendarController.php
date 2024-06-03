<?php

namespace App\Http\Controllers;

use App\Http\Resources\CalendarResource;
use App\Services\CalendarService;
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
        list($dailyReport, $monthlyGoal, $userId) = $this->calendarService->getCalendarContents($request, $recordDate);

        $result = collect();
        $dailyReport->each(function ($dailyReport) use (&$result) {
            $dailyReport->workDetails->each(function ($workDetail) use (&$result) {
                $result->push([
                    'work_detail_id' => $workDetail->id,
                    'category_id' => $workDetail->work_detail_category_id,
                    'category_name' => $workDetail->workDetailCategory->name,
                    'content' => $workDetail->content,
                    'work_time' => $workDetail->work_time,
                ]);
            });
        });

        return [
            'data' => [
                'user_id' => 1,
                'daily_report' => [
                    'id' => 1,
                    'contents' => $result->toArray(),
                    'memo' => 1,
                ],
                'monthly_goal_id' => 1,
                'monthly_goal' => 1,
            ],
        ];
        // return new CalendarResource($dailyReport, $monthlyGoal, $userId);
    }
}
