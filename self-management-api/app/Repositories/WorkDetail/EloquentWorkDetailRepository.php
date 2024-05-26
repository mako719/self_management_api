<?php

namespace App\Repositories\WorkDetail;

use App\Models\WorkDetail;

class EloquentWorkDetailRepository implements WorkDetailRepositoryInterface
{
    private $workDetail;

    public function __construct(WorkDetail $workDetail)
    {
        $this->workDetail = $workDetail;
    }

    /**
     * 日報の内容を作成する
     *
     * @param int $dailyReportId
     * @param int $categoryId
     * @param array $workDetail
     *
     */
    public function insertWorkDetail($dailyReportId, $categoryId, $workDetail)
    {
        $this->workDetail::create([
            'daily_report_id' => $dailyReportId,
            'work_detail_category_id' => $categoryId,
            'content' => $workDetail['category'],
            'work_time' => $workDetail['work_time'],
        ]);
    }
}
