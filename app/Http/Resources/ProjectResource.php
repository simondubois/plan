<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'completion' => $this->completion,
            'estimated_time' => $this->estimated_time,
            'spent_time' => $this->spent_time,
            'start' => $this->start,
            'end' => $this->end,
        ];
    }
}
