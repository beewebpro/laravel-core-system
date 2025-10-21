<?php

namespace Bng\Media\Providers;

use Bng\Base\Facades\DashboardMenu;
use Bng\Base\Supports\ServiceProvider;
use Bng\Base\Traits\LoadAndPublishDataTrait;
use Bng\Media\Facades\Media;
use Illuminate\Foundation\AliasLoader;

class MediaServiceProvider extends ServiceProvider
{
  use LoadAndPublishDataTrait;

  public function register(): void {}

  public function boot(): void
  {
    $this
      ->setNamespace('core/media')
      ->loadHelpers()
      ->loadAndPublishConfigurations(['permissions', 'media'])
      ->loadMigrations()
      ->loadAndPublishTranslations()
      ->loadAndPublishViews()
      ->loadRoutes();


    DashboardMenu::default()->beforeRetrieving(function () {
      DashboardMenu::make()
        ->registerItem([
          'id' => 'bng-core-media',
          'priority' => 999,
          'icon' => 'bx bx-folder-open',
          'name' => trans('core/media::media.name'),
          'route' => 'media.index',
        ]);
    });
  }

  protected function registerAliases()
  {
    $aliasLoader = AliasLoader::getInstance();

    if (! class_exists('Media')) {
      $aliasLoader->alias('Media', Media::class);
    }
  }
}
