<?php

namespace Bng\Table\Providers;

use Bng\Base\Supports\ServiceProvider;
use Bng\Base\Traits\LoadAndPublishDataTrait;
use Bng\Table\ApiResourceDataTable;
use Bng\Table\CollectionDataTable;
use Bng\Table\EloquentDataTable;
use Bng\Table\QueryDataTable;

class TableServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot(): void
    {
        $this
            ->setNamespace('core/table')
            ->loadHelpers()
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadRoutes()
            ->publishAssets();

        $this->app['config']->set([
            'datatables.engines' => [
                'eloquent' => EloquentDataTable::class,
                'query' => QueryDataTable::class,
                'collection' => CollectionDataTable::class,
                'resource' => ApiResourceDataTable::class,
            ],
        ]);
    }
}
