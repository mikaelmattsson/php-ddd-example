<?php

namespace App\Infrastructure\Persistence\Hibernate;

use Elasticsearch\ClientBuilder;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class PersistenceServiceProvider extends ServiceProvider
{

    public function register()
    {
        $app = $this->app;

        $app->singleton(PersistenceService::class, function(Application $app) {
            // Todo: Extract hosts to config.

            return new PersistenceService(
                ClientBuilder::create()->setHosts(['elasticsearch'])->build()
            );
        });
    }
}