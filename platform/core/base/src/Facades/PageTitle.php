<?php

namespace Bng\Base\Facades;

use Bng\Base\Supports\PageTitle as PageTitleSupport;
use Illuminate\Support\Facades\Facade;

class PageTitle extends Facade
{
  protected static function getFacadeAccessor(): string
  {
    return PageTitleSupport::class;
  }
}
