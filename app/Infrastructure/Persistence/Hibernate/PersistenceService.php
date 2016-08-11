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
     * @var array
     */
    private $mappers = [];

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param DocumentInterface[] $documents
     */
    public function save(array $documents)
    {
        $body = [];
        $i = 0;
        foreach ($documents as $document) {
            $body[] = [
                'index' => [
                    '_index' => $document->getIndex(),
                    '_type' => $document->getType(),
                ]
            ];

            $body[] = $document;

            if (++$i % 1000 == 0) {
                $this->client->bulk(['body' => $body]);
                $body = [];
            }
        }

        if ($body) {
            $this->client->bulk(['body' => $body]);
        }
    }

    public function get($params)
    {
        return $this->client->get($params);
    }

    public function search($params)
    {
        return $this->client->search($params);
    }
    
}