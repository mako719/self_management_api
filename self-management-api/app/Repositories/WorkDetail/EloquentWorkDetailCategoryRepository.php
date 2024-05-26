<?php

namespace App\Repositories\WorkDetail;

use App\Models\WorkDetailCategory;

class EloquentWorkDetailCategoryRepository implements WorkDetailCategoryRepositoryInterface
{
    private $workDetailCategory;

    public function __construct(WorkDetailCategory $workDetailCategory)
    {
        $this->workDetailCategory = $workDetailCategory;
    }
    /**
     * 日報の内容のカテゴリーを作成する
     *
     * @param string $categoryName
     * @param int $userId
     *
     * @return int $categoryId
     */
    public function insertCategory($categoryName, $userId)
    {
        return $this->workDetailCategory::insertGetId([
            'user_id' => $userId,
            'name' => $categoryName,
        ]);
    }
}
