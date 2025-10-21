<?php

namespace Bng\Base\Facades;

use Bng\Base\Supports\DashboardMenu as DashboardMenuSupport;
use Illuminate\Support\Facades\Facade;

class DashboardMenu extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return DashboardMenuSupport::class;
    }
}
