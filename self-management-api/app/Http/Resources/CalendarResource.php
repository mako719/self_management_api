<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CalendarResource extends JsonResource
{
    private $dailyReport;
    private $monthlyGoal;
    private $userId;
    private $workDetailCollection;

    /**
     * Create a new resource instance.
     *
     * @param  mixed  $resource
     * @return void
     */
    public function __construct($dailyReport, $monthlyGoal, $userId)
    {
        $this->dailyReport = $dailyReport;
        $this->monthlyGoal = $monthlyGoal;
        $this->userId = $userId;
    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $result = collect();
        $key = 0;
        $this->dailyReport->each(function ($dailyReport) use (&$result, &$key) {
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
        return [
            'data' => [
                'user_id' => $this->userId,
                'daily_report' => [
                    'id' => $this->dailyReport->value('id'),
                    'contents' => $result,
                    'memo' => $this->dailyReport->value('memo'),
                ],
                'monthly_goal_id' => $this->monthlyGoal->value('id'),
                'monthly_goal' => $this->monthlyGoal->value('goal'),
            ],
            // 'links' => [
            //     'self' => ,
            // ]
        ];
    }
}
