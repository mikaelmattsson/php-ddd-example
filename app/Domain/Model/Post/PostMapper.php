<?php

namespace App\Domain\Model\Post;

use App\Domain\Shared\AbstractMapper;
use App\Infrastructure\Persistence\DocumentInterface;
use Ramsey\Uuid\Uuid;

class PostMapper extends AbstractMapper
{

    /**
     * @param Post|DocumentInterface $document
     * @return array
     */
    public function serialize(DocumentInterface $document) : array
    {
        return [
            'uuid' => $document->getUuid(),
            'text' => $document->getText(),
        ];
    }

    /**
     * @param array $data
     * @return Post|DocumentInterface
     */
    public function deserialize(array $data) : DocumentInterface
    {
        return $this->instantiate([
            'uuid' => Uuid::fromString($data['uuid']),
            'text' => $data['text'],
        ]);
    }
}