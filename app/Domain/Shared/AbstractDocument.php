<?php

namespace App\Domain\Shared;

use App\Infrastructure\Persistence\DocumentInterface;

abstract class AbstractDocument implements DocumentInterface
{
    public function isDirty() : bool
    {
        return true;
    }
}