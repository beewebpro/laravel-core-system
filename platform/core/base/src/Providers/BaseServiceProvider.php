<?php

namespace Bng\Base\Providers;

use Bng\Base\Contracts\PanelSections\Manager;
use Bng\Base\Facades\BaseHelper;
use Bng\Base\PanelSections\Manager as PanelSectionManager;
use Bng\Base\Facades\Breadcrumb;
use Bng\Base\Facades\DashboardMenu;
use Bng\Base\Facades\PageTitle;
use Bng\Base\Facades\PanelSectionManager as FacadePanelSectionManager;
use Bng\Base\PanelSections\System\SystemPanelSection;
use Bng\Base\Supports\Action;
use Bng\Base\Supports\Breadcrumb as SupportsBreadcrumb;
use Bng\Base\Supports\Filter;
use Bng\Base\Supports\ServiceProvider;
use Bng\Base\Traits\LoadAndPublishDataTrait;
use Illuminate\Config\Repository;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Arr;

class BaseServiceProvider extends ServiceProvider
{
  use LoadAndPublishDataTrait;
  public function register(): void
  {
    $this->setNamespace('core/base')
      ->loadHelpers();
    $this->app->instance('core.middleware', []);

    $this->app->singleton('core.filter', Filter::class);
    $this->app->singleton('core.action', Action::class);
    $this->app->singleton(SupportsBreadcrumb::class);
    $this->app->singleton(Manager::class, PanelSectionManager::class);

    $this->registerAliases();
  }

  public function boot(): void
  {
    $this->loadAndPublishConfigurations('general')
      ->loadAndPublishViews()
      ->loadRoutes()
      ->publishAssets()
      ->loadAndPublishTranslations();

    $this->overridePackagesConfigs();

    $this->registerPanelSections();
  }

  protected function registerAliases()
  {
    $aliasLoader = AliasLoader::getInstance();

    if (! class_exists('BaseHelper')) {
      $aliasLoader->alias('BaseHelper', BaseHelper::class);
      $aliasLoader->alias('DashboardMenu', DashboardMenu::class);
      $aliasLoader->alias('PageTitle', PageTitle::class);
    }

    if (! class_exists('Breadcrumb')) {
      $aliasLoader->alias('Breadcrumb', Breadcrumb::class);
    }

    if (! class_exists('PanelSectionManager')) {
      $aliasLoader->alias('PanelSectionManager', FacadePanelSectionManager::class);
    }
  }

  protected function registerPanelSections(): void
  {
    FacadePanelSectionManager::group('system')->beforeRendering(function () {
      FacadePanelSectionManager::setGroupName(trans('core/base::layouts.platform_admin'))
        ->register(SystemPanelSection::class);
    });
  }

  protected function overridePackagesConfigs(): void
  {
    $config = $this->getConfig();

    $baseConfig = $this->getBaseConfig();

    $config->set([
      'purifier.settings' => [
        ...$config->get('purifier.settings', []),
        ...Arr::get($baseConfig, 'purifier', []),
      ],
    ]);
  }

  protected function getConfig(): Repository
  {
    return $this->app['config'];
  }

  protected function getBaseConfig(): array
  {
    return $this->getConfig()->get('core.base.general', []);
  }
}
