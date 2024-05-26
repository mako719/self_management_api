<?php

namespace App\Repositories\DailyReport;

use App\Models\DailyReport;
use App\Repositories\DailyReport\DailyReportRepositoryInterface;

class EloquentDailyReportRepository implements DailyReportRepositoryInterface
{
    public function getDailyReportByRecordDate($recordDate, $userId)
    {
        return DailyReport::with('workDetails.workDetailCategory')
            ->where('user_id', $userId)
            ->where('record_date', $recordDate)
            ->get();
    }
}
