<?php

namespace Bng\Base\Facades;

use Bng\Base\Supports\Assets as BaseAssets;
use Illuminate\Support\Facades\Facade;

class Assets extends Facade
{
  protected static function getFacadeAccessor(): string
  {
    return BaseAssets::class;
  }
}
