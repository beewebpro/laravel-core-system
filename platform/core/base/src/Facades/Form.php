<?php

namespace Bng\Base\Facades;

use Illuminate\Support\Facades\Facade;

class Form extends Facade
{
  protected static function getFacadeAccessor(): string
  {
    return 'form';
  }
}
