<?php

namespace Bng\Acp\Providers;

use Bng\Acp\Http\Middleware\Authenticate;
use Bng\Acp\Http\Middleware\RedirectIfAuthenticated;
use Bng\Acp\Models\Activation;
use Bng\Acp\Models\Role;
use Bng\Acp\Models\User;
use Bng\Acp\Repositories\Eloquent\ActivationRepository;
use Bng\Acp\Repositories\Eloquent\RoleRepository;
use Bng\Acp\Repositories\Eloquent\UserRepository;
use Bng\Acp\Repositories\Interfaces\ActivationInterface;
use Bng\Acp\Repositories\Interfaces\RoleInterface;
use Bng\Acp\Repositories\Interfaces\UserInterface;
use Bng\Base\Facades\PanelSectionManager;
use Bng\Base\PanelSections\PanelSectionItem;
use Bng\Base\PanelSections\System\SystemPanelSection;
use Bng\Base\Supports\ServiceProvider;
use Bng\Base\Traits\LoadAndPublishDataTrait;
use Illuminate\Routing\Events\RouteMatched;

class AcpServiceProvider extends ServiceProvider
{
  use LoadAndPublishDataTrait;
  public function register(): void
  {
    $this->app->bind(UserInterface::class, function () {
      return new UserRepository(new User());
    });

    $this->app->bind(ActivationInterface::class, function () {
      return new ActivationRepository(new Activation());
    });

    $this->app->bind(RoleInterface::class, function () {
      return new RoleRepository(new Role());
    });
  }

  public function boot(): void
  {
    $this->setNamespace('core/acp')
      ->loadAndPublishViews()
      ->loadRoutes()
      ->publishAssets()
      ->loadAndPublishTranslations()
      ->loadMigrations();

    $this->app['events']->listen(RouteMatched::class, function () {
      $router = $this->app['router'];

      $router->aliasMiddleware('auth', Authenticate::class);
      $router->aliasMiddleware('guest', RedirectIfAuthenticated::class);
    });

    $this->registerPanelSections();

    $this->app->booted(function () {
      config()->set(['auth.providers.users.model' => User::class]);
    });
  }

  protected function registerPanelSections(): void
  {
    PanelSectionManager::group('system')
      ->beforeRendering(function () {
        PanelSectionManager::registerItems(
          SystemPanelSection::class,
          fn() => [
            PanelSectionItem::make('users')
              ->setTitle(trans('core/acp::user.users'))
              ->withIcon('bx bx-user')
              ->withDescription(trans('core/acp::user.users_description'))
              ->withPriority(-9999)
              ->withRoute('users.index'),
            PanelSectionItem::make('roles')
              ->setTitle(trans('core/acp::user.roles'))
              ->withIcon('bx bx-user-check')
              ->withDescription(trans('core/acp::user.roles_description'))
              ->withPriority(-9980)
              ->withRoute('roles.index')
          ]
        );
      });
  }
}
