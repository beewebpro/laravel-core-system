<?php

namespace Bng\Media\Facades;

use Bng\Media\Media as BaseMedia;
use Illuminate\Support\Facades\Facade;

class Media extends Facade
{
  protected static function getFacadeAccessor(): string
  {
    return BaseMedia::class;
  }
}
