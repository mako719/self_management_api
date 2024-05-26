<?php

namespace App\Repositories\DailyReport;

use App\Models\DailyReport;
use App\Repositories\DailyReport\DailyReportRepositoryInterface;

class EloquentDailyReportRepository implements DailyReportRepositoryInterface
{
    private $dailyReport;

    public function __construct(DailyReport $dailyReport)
    {
        $this->dailyReport = $dailyReport;
    }

    /**
     * 記録日の日報を取得する
     *
     * @param Carbon $recordDate
     * @param int $userId
     *
     * @return Collection
     */
    public function getDailyReportByRecordDate($recordDate, $userId)
    {
        return $this->dailyReport::with('workDetails.workDetailCategory')
            ->where('user_id', $userId)
            ->where('record_date', $recordDate)
            ->get();
    }

    /**
     * 日報を作成する
     *
     * @param int $userId
     * @param string $recordDate
     * @param string $memo
     *
     * @return int id
     */
    public function insertDailyReport($userId, $recordDate, $memo)
    {
        return $this->dailyReport->insertGetId([
            'user_id' => $userId,
            'record_date' => $recordDate,
            'memo' => $memo
        ]);
    }
}
