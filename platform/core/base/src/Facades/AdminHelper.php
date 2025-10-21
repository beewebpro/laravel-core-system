<?php

namespace Bng\Base\Facades;

use Bng\Base\Helpers\AdminHelper as AdminHelperSupport;
use Illuminate\Support\Facades\Facade;

class AdminHelper extends Facade
{
  protected static function getFacadeAccessor(): string
  {
    return AdminHelperSupport::class;
  }
}
