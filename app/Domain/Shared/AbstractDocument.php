<?php

namespace App\Domain\Shared;

use App\Infrastructure\Persistence\DocumentInterface;

abstract class AbstractDocument implements DocumentInterface
{

    public function getIndex() : string
    {
        return str_replace('\\','_', strtolower(get_class($this)));
    }

    public function getType() : string
    {
        return str_replace('\\','_', strtolower(get_class($this)));
    }
}