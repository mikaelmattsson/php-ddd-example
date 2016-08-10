<?php

namespace App\Domain\Model\User;

use App\Infrastructure\Persistence\Hibernate\DocumentRepository;

class UserRepository extends DocumentRepository
{
    /**
     * @var string
     */
    protected $documentClass = User::class;
}