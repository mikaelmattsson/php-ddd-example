<?php

namespace App\Domain\Model\Post;

use App\Infrastructure\Persistence\Hibernate\AbstractDocumentRepository;

class PostRepository extends AbstractDocumentRepository
{
    /**
     * @var string
     */
    protected $documentClass = Post::class;

    /**
     * @var PostMapper
     */
    protected $mapperClass = PostMapper::class;

}