<?php

namespace Bng\Dashboard\Providers;

use Bng\Base\Supports\ServiceProvider;
use Bng\Base\Traits\LoadAndPublishDataTrait;

class DashboardServiceProvider extends ServiceProvider
{
  use LoadAndPublishDataTrait;
  public function register(): void {}
  public function boot(): void
  {
    $this->setNamespace('core/dashboard')
      ->loadHelpers()
      ->loadRoutes()
      ->loadAndPublishTranslations()
      ->loadAndPublishViews()
      ->publishAssets()
      ->loadMigrations();
  }
}
