<?php

namespace Bng\Base\Facades;

use Bng\Base\Supports\MetaBox as MetaBoxSupport;
use Illuminate\Support\Facades\Facade;

class MetaBox extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return MetaBoxSupport::class;
    }
}
