<?php

namespace App\Services;

use App\Repositories\DailyReport\DailyReportRepositoryInterface;

class DailyReportService
{
    private $dailyReportRepo;

    public function __construct(DailyReportRepositoryInterface $dailyReportRepo)
    {
        $this->dailyReportRepo = $dailyReportRepo;
    }

    public function getDailyReport()
    {
        $dailyReport = $this->dailyReportRepo->getDailyReportByRecordDate();
        dd($dailyReport);
    }
}
