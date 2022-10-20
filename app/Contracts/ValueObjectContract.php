<?php

namespace App\Contracts;

interface ValueObjectContract
{
    /**
     * @return array
     */
    public function toArray(): array;
}
