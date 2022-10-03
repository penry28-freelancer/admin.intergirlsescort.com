<?php

namespace App\Traits;

trait EscortAddProperty { 

    public function getIsIndependentAttribute()
    {
        return $this->isIndependent();
    }

    public function getHasVideoAttribute()
    {
        return $this->hasVideo() > 0;
    }

    public function getHasReviewAttribute()
    {
        return $this->hasReview();
    }

    public function getIsVerifiedAttribute()
    {
        return $this->verified();
    }

    public function getIsNewAttribute()
    {
        return $this->isNewComer();
    }

    public function getIsPornstarAttribute()
    {
        return $this->isPornstar();
    }

    public function getIsVipAttribute()
    {
        return $this->accountable->transactions->count() > 0;
    }
}