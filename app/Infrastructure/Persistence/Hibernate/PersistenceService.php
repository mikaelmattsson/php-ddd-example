<?php

namespace App\Infrastructure\Persistence\Hibernate;

use App\Infrastructure\Persistence\DocumentInterface;
use Elasticsearch\Client;

class PersistenceService
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var PersistenceWrapper[]
     */
    protected $persisting = [];

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param DocumentInterface $document
     * @param MapperInterface $repository
     * @return PersistenceService
     */
    public function persist(DocumentInterface $document, MapperInterface $repository) : PersistenceService
    {
        $key = spl_object_hash($document);

        if (!isset($this->persisting[$key])) {
            $this->persisting[$key] = new PersistenceWrapper($document, $repository);
        }

        return $this;
    }

    /**
     * @param DocumentInterface[] $documents
     * @param MapperInterface $mapper
     * @return PersistenceService
     */
    public function persistMultiple(array $documents, MapperInterface $mapper) : PersistenceService
    {
        foreach ($documents as $document) {
            $this->persist($document, $mapper);
        }

        return $this;
    }

    public function save()
    {
        $body = [];
        $i = 0;
        foreach ($this->persisting as $wrapper) {

            if (!$wrapper->getDocument()->isDirty()) {
                continue;
            }

            $body[] = [
                'index' => [
                    '_index' => $wrapper->getMapper()->getIndex(),
                    '_type' => $wrapper->getMapper()->getType(),
                ]
            ];

            $body[] = $wrapper->getMapper()->serialize($wrapper->getDocument());

            if (++$i % 1000 == 0) {
                $this->client->bulk(['body' => $body]);
                $body = [];
            }
        }

        if ($body) {
            $this->client->bulk(['body' => $body]);
        }
    }

    public function get($params, MapperInterface $mapper) : Result
    {
        return new Result($this->client->get($params), $mapper);
    }

    public function search($params, MapperInterface $mapper) : Result
    {
        return new Result($this->client->search($params), $mapper);
    }
    
}