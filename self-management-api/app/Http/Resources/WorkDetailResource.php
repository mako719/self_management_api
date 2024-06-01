<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        dd($this);
        return [
            'work_detail_id' => $this->value('id'),
            'category_id' => $this->pluck('workDetailCategory')->where('id', $this->value('work_detail_category_id'))->value('id'),
            'category_name' => $this->pluck('workDetailCategory')->where('id', $this->value('work_detail_category_id'))->value('name'),
            'content' => $this->value('content'),
            'work_time' => $this->value('work_time'),
        ];
    }
}
