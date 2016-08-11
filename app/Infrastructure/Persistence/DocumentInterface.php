<?php

namespace App\Infrastructure\Persistence;

interface DocumentInterface
{
    public function getIndex() : string;

    public function getType() : string;
}