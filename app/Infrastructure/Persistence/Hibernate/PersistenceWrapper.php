<?php

namespace App\Infrastructure\Persistence\Hibernate;

use App\Infrastructure\Persistence\DocumentInterface;

class PersistenceWrapper
{
    /**
     * @var DocumentInterface
     */
    private $document;
    /**
     * @var MapperInterface
     */
    private $mapper;

    /**
     * PersistanceWrapper constructor.
     * @param DocumentInterface $document
     * @param MapperInterface $mapper
     */
    public function __construct(DocumentInterface $document, MapperInterface $mapper)
    {

        $this->document = $document;
        $this->mapper = $mapper;
    }

    /**
     * @return DocumentInterface
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * @return MapperInterface
     */
    public function getMapper()
    {
        return $this->mapper;
    }
}