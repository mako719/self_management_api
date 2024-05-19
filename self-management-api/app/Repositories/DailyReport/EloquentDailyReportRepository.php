<?php

namespace App\Repositories\DailyReport;

use App\Repositories\DailyReport\DailyReportRepositoryInterface;

class EloquentDailyReportRepository implements DailyReportRepositoryInterface
{
    public function __construct()
    {

    }

    public function getDailyReportByRecordDate()
    {
        return 1;
    }
}
