<?php

namespace App\Domain\Shared;

use Elasticquent\ElasticquentCollectionTrait;
use Illuminate\Database\Eloquent\Collection;

class ElasticCollection extends Collection
{
    use ElasticquentCollectionTrait;
}