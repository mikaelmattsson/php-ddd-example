<?php

namespace App\Infrastructure\Persistence\Hibernate;

class Result
{
    /**
     * @var array
     */
    private $data;

    /**
     * @var MapperInterface
     */
    private $mapper;

    /**
     * Result constructor.
     * @param array $data
     * @param MapperInterface $mapper
     */
    public function __construct(array $data, MapperInterface $mapper)
    {
        $this->data = $data;
        $this->mapper = $mapper;
    }

    public function getDocuments()
    {
        $list = [];
        foreach ($this->data['hits']['hits'] as $hit) {
            $list[] = $this->mapper->deserialize($hit['_source']);
        }

        return $list;
    }
}