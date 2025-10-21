<?php

namespace Bng\Base\Facades;

use Bng\Base\Contracts\PanelSections\Manager;
use Illuminate\Support\Facades\Facade;

class PanelSectionManager extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return Manager::class;
    }
}
