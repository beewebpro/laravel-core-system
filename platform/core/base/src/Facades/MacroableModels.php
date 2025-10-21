<?php

namespace Bng\Base\Facades;

use Bng\Base\Supports\MacroableModels as MacroableModelsSupport;
use Illuminate\Support\Facades\Facade;

class MacroableModels extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return MacroableModelsSupport::class;
    }
}
