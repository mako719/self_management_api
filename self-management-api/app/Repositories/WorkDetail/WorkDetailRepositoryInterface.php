<?php

namespace App\Repositories\WorkDetail;

interface WorkDetailRepositoryInterface
{
    public function insertWorkDetail($dailyReportId, $categoryId, $workDetail);
}
