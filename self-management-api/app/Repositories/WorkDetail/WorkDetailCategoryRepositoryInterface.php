<?php

namespace App\Repositories\WorkDetail;

interface WorkDetailCategoryRepositoryInterface
{
    public function insertCategory($categoryName, $userId);
}
