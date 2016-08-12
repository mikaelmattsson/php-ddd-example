<?php

namespace App\Infrastructure\Persistence;

interface DocumentInterface
{
    public function isDirty() : bool;
}