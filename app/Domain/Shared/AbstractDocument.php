<?php

namespace App\Domain\Shared;

use App\Infrastructure\Persistence\DocumentInterface;
use Ramsey\Uuid\Uuid;

abstract class AbstractDocument implements DocumentInterface
{
    protected $uuid;

    public function isDirty() : bool
    {
        return true;
    }

    public function getUuid() : Uuid
    {
        return $this->uuid;
    }
}