<?php

namespace App\Services;

use App\Models\WorkDetailCategory;
use App\Repositories\DailyReport\DailyReportRepositoryInterface;
use App\Repositories\WorkDetail\WorkDetailCategoryRepositoryInterface;
use App\Repositories\WorkDetail\WorkDetailRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DailyReportService
{
    private $dailyReportRepo;
    private $workDetailCategoryRepo;
    private $workDetailRepo;

    public function __construct(DailyReportRepositoryInterface $dailyReportRepo, WorkDetailCategoryRepositoryInterface $workDetailCategoryRepo, WorkDetailRepositoryInterface $workDetailRepo)
    {
        $this->dailyReportRepo = $dailyReportRepo;
        $this->workDetailCategoryRepo = $workDetailCategoryRepo;
        $this->workDetailRepo = $workDetailRepo;
    }

    /**
     * 日報を作成する
     *
     * @param Request $request
     *
     * @return int $dailyReportId
     */
    public function createDailyReport(Request $request)
    {
        $userId = $request->header('personal-id');

        try {
            DB::beginTransaction();
            $dailyReportId = $this->dailyReportRepo->insertDailyReport($userId, request('record-date'), $request->memo);

            collect($request->work_details)->each(function ($workDetail) use ($userId, $dailyReportId) {
                // if (is_null($workDetail['category_id'])) {
                //     $categoryId = $this->workDetailCategoryRepo->insertCategory($workDetail['category_name'], $userId);
                // } else {
                //     $categoryId = $workDetail['category_id'];
                // }
                $categoryId = $workDetail['category_id'] ?? $this->workDetailCategoryRepo->insertCategory($workDetail['category_name'], $userId);
                $this->workDetailRepo->insertWorkDetail($dailyReportId, $categoryId, $workDetail);
            });

            return $dailyReportId;
        } catch (\Exception $e) {
            report($e);
            Log::info('Insert Daily Report Error.');
        }
    }
}
