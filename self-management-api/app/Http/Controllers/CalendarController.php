<?php

namespace App\Http\Controllers;

use App\Http\Resources\CalendarResource;
use App\Services\CalendarService;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    protected $calendarService;
    public $user = 5;

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
        $key = 0;
        $dailyReport->each(function ($dailyReport) use (&$result, &$key) {
            $dailyReport->workDetails->each(function ($workDetail) use (&$result, &$key) {
                $key++;
                $result->push([
                    'work_detail_id' => $workDetail->id,
                    'category_id' => $workDetail->work_detail_category_id,
                    'category_name' => $workDetail->workDetailCategory->name,
                    'content' => $workDetail->content,
                    'work_time' => $workDetail->work_time,
                ]);
            });
        });

        $result = [0 => [
            "work_detail_id" => 51,
            "category_id" => 1,
            "category_name" => "category1",
            "content" => "文法",
            "work_time" => "02:00:00",
        ],
         1 => [
            "work_detail_id" => 52,
            "category_id" => 20,
            "category_name" => "Laravel",
            "content" => "Eloquent",
            "work_time" => "03:00:00",
          ]];

        $response = [
            'data' => [
                'user_id' => $userId,
                'daily_report' => [
                    'id' => 1,
                    'contents' => $result,
                    'memo' => 1,
                ],
                'monthly_goal_id' => $monthlyGoal->value('id'),
                'monthly_goal' => 1,
            ],
        ];

        $a = $prescriptions->map(function ($prescription) {
            $prescription = collect($prescription->item)->map(function ($item) use ($prescription) {
                $item = $item->variations->filter(function ($variation) {
                    return;
                });
                $item->push();
                return $item;
            });
            return $prescription;
        });
        // $response = json_encode($response,JSON_PRETTY_PRINT);
        // dd($response);
        // return response()->json($response);
        // return new CalendarResource($dailyReport, $monthlyGoal, $userId);
        return $response;

    }
}
