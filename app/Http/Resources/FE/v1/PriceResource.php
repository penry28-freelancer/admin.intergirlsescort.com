<?php

namespace App\Http\Resources\FE\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class PriceResource extends JsonResource
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
            'currency_id' => $this->currency_id,
            'currency' => new CurrencyResource($this->currency),
            'price' => $this->price,
            'gold' => $this->gold,
            'you_save' => $this->you_save,
            'is_popular' => $this->is_popular,
            'is_best' => $this->is_best,
        ];
    }
}
