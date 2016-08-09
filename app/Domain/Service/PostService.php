<?php

namespace App\Domain\Service;

use App\Domain\Model\Post\Post;

class PostService
{
    public function create(array $array)
    {
        return Post::create($array);
    }
}