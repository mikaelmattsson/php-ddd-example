<?php

namespace App\Infrastructure\Persistence\Hibernate;

use App\Infrastructure\Persistence\DocumentInterface;

interface MapperInterface
{
    public function serialize(DocumentInterface $document) : array;

    public function deserialize(array $data) : DocumentInterface;

    public function getIndex() : string;

    public function getType() : string;
}