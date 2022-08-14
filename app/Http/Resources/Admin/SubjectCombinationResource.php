<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class SubjectCombinationResource extends JsonResource
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
            'id'         => $this->id,
            'name'       => $this->name,
            'group_id'   => $this->group_id,
            'group'      => $this->group ? [
                'name' => $this->group->name
            ] : null,
            'subjects'   => $this->subjects ? ($this->subjects)->map(function($item) {
                return [
                    'id'   => $item->id,
                    'name' => $item->name
                ];
            }) : null,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
