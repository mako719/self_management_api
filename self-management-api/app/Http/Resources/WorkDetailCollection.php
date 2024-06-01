<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class WorkDetailCollection extends ResourceCollection
{
    private $workDetails;

    /**
     * Create a new resource instance.
     *
     * @param  mixed  $resource
     * @return void
     */
    public function __construct($workDetails)
    {
        $this->workDetails = $workDetails;
    }
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'work_detail_id' => $this->workDetails->value('id'),
            'category_id' => $this->workDetails->pluck('workDetailCategory')->where('id', $this->workDetails->value('work_detail_category_id'))->value('id'),
            'category_name' => $this->workDetails->pluck('workDetailCategory')->where('id', $this->workDetails->value('work_detail_category_id'))->value('name'),
            'content' => $this->workDetails->value('content'),
            'work_time' => $this->workDetails->value('work_time'),
        ];
    }
}
