<?php

namespace App\Repositories\DailyReport;

interface DailyReportRepositoryInterface
{
    public function getDailyReportByRecordDate($reportDate, $userId);

    public function insertDailyReport($userId, $recordDate, $memo);

    public function updateDailyReportMemo($dailyReportId, $memo);
}
