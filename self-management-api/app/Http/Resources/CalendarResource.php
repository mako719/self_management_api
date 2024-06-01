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
        // $workDetails = collect();
        // if ($this->dailyReport) {
        //     $this->dailyReport->each(function ($report) use ($workDetails) {
        //         $workDetails->push($report->workDetails);
        //     });
        //     $workDetails = WorkDetailResource::collection($this->dailyReport->pluck('workDetails'));
        // }
        return [
            'data' => [
                'user_id' => $this->userId,
                'daily_report' => [
                    'id' => $this->dailyReport->value('id'),
                    'contents' => WorkDetailResource::collection($this->dailyReport->pluck('workDetails')),
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
