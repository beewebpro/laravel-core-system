<?php

namespace Bng\Base\Providers;

use Bng\Base\Events\PanelSectionsRendering;
use Bng\Base\Http\Middleware\CoreMiddleware;
use Bng\Base\Listeners\PushDashboardMenuToSystemPanel;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Routing\Events\RouteMatched;

class EventServiceProvider extends ServiceProvider
{
  public function boot(): void
  {
    $events = $this->app['events'];

    $events->listen(RouteMatched::class, function () {
      /**
       * @var Router $router
       */
      $router = $this->app['router'];
      $router->middlewareGroup('core', [CoreMiddleware::class]);
    });

    $events->listen(PanelSectionsRendering::class, PushDashboardMenuToSystemPanel::class);
  }
}
