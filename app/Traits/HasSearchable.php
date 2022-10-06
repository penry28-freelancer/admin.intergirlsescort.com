<?php

namespace App\Traits;

trait HasSearchable
{
    public function search($query)
    {
        return $this->__builder
            ->where('email', 'LIKE', "%$query%")
            ->orWhere('phone', 'LIKE', "%$query%");
    }
}
