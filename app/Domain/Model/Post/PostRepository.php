<?php

namespace App\Domain\Model\Post;

use App\Infrastructure\Persistence\Hibernate\DocumentRepository;

class PostRepository extends DocumentRepository
{
    /**
     * @var string
     */
    protected $documentClass = Post::class;
}