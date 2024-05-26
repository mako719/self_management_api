<?php

namespace App\Repositories\DailyReport;

interface DailyReportRepositoryInterface
{
    public function getDailyReportByRecordDate($reportDate, $userId);
}
