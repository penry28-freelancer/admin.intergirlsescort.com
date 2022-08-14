<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class MajorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'subject_group' => $this->subject_group,
            'subject_combinations' => $this->subject_combinations ? collect($this->subject_combinations)->map(function($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name
                ];
            }) : null,
            'thpt_score' => $this->thpt_score,
            'hocba_score' => $this->hocba_score,
            'dgnl_score' => $this->dgnl_score,
            'university_id' => $this->university_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'university' => $this->university ? [
                'name' => $this->university->name,
            ] : null
        ];
    }
}
