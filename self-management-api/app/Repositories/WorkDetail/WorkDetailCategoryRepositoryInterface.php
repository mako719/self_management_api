<?php

namespace App\Repositories\WorkDetail;

interface WorkDetailCategoryRepositoryInterface
{
    public function categoryExistenceCheck($categoryName);

    public function insertCategory($categoryName, $userId);
}
