<?php

namespace App\Http\Resources\FE\v1;

use App\Http\Resources\CMS\v1\AgencyResource;
use App\Http\Resources\CMS\v1\MemberResource;
use App\Models\Agency;
use App\Models\Club;
use App\Models\Escort;
use App\Models\Member;
use Illuminate\Http\Resources\Json\JsonResource;

class UserAuthResource extends JsonResource
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
            'id'    => $this->id,
            'email' => $this->email,
            'name'  => $this->name,
            'gold'  => $this->gold,
            'type'  => $this->type,
            'profile' => $this->_getProfile()
        ];
    }

    private function _getProfile()
    {
        switch ($this->accountable_type) {
            case Escort::class:
                return new EscortResource(Escort::find($this->accountable_id));
            case Agency::class:
                return new AgencyResource(Agency::find($this->accountable_id));
            case Club::class:
                return new ClubResource(Club::find($this->accountable_id));
            case Member::class:
                return new MemberResource(Member::find($this->accountable_id));
            default:
                return null;
                break;
        }
    }
}
