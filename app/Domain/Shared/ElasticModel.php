<?php

namespace App\Domain\Shared;

use Elasticquent\ElasticquentInterface;
use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Model as Eloquent;

class ElasticModel extends Eloquent implements ElasticquentInterface
{
    use ElasticquentTrait;

    protected $fillable = ['*'];
}