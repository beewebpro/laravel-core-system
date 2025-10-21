<?php

namespace Bng\Base\Facades;

use Bng\Base\Supports\Breadcrumb as BreadcrumbSupport;
use Illuminate\Support\Facades\Facade;

class Breadcrumb extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return BreadcrumbSupport::class;
    }
}
