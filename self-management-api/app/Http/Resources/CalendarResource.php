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
        $workDetails = collect();
        if ($this->dailyReport) {
            $this->dailyReport->each(function ($report) use ($workDetails) {
                // dd($report->workDetails);
                $workDetails->push($report->id, $report->workDetailCategory->name);
            });
            // $workDetails = WorkDetailResource::collection($workDetails);
            // $workDetails = new WorkDetailCollection($workDetails);
        }
        return [
            'data' => [
                'user_id' => $this->userId,
                'daily_report' => [
                    'id' => $this->dailyReport->value('id'),
                    'contents' => $workDetails,
                ],
            ],
            'links' => [
                'self' => 1,
            ]
        ];
    }
}
