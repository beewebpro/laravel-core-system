<?php

namespace Bng\Base\Providers;

use Bng\Base\Commands\PublishAssetsCommand;
use Bng\Base\Supports\ServiceProvider;

class CommandServiceProvider extends ServiceProvider
{
  public function boot(): void
  {
    if (! $this->app->runningInConsole()) {
      return;
    }

    $this->commands([
      PublishAssetsCommand::class
    ]);
  }
}
