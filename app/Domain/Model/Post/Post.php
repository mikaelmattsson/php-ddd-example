<?php

namespace App\Domain\Model\Post;

use App\Domain\Shared\AbstractDocument;

class Post extends AbstractDocument
{
    protected $text;

    public function __construct(array $data)
    {
        $this->text = isset($data['text']) ? $data['text'] : '';
    }

    public function toArray() : array
    {
        return [
            'text' => $this->text,
        ];
    }
}