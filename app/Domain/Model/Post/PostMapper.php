<?php

namespace App\Domain\Model\Post;

use App\Domain\Shared\AbstractMapper;
use App\Infrastructure\Persistence\DocumentInterface;

class PostMapper extends AbstractMapper
{

    /**
     * @param Post|DocumentInterface $document
     * @return array
     */
    public function serialize(DocumentInterface $document) : array
    {
        return [
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
            'text' => $data['text'],
        ]);
    }
}