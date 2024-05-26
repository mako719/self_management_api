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
        dd($this->workDetails);
    }
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'work_detail_id' => $this->id,
            'category_id' => 14,
            'category_name' => 14,
            'content' => 14,
            'work_time' => 1,
        ];
    }
}
