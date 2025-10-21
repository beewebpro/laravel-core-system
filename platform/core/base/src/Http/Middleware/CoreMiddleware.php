<?php

namespace Bng\Base\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Pipeline\Pipeline;

class CoreMiddleware
{
  public function handle(Request $request, Closure $next)
  {
    return app(Pipeline::class)
      ->send($request)
      ->through(App::make('core.middleware') ?: [])
      ->then(function (Request $request) use ($next) {
        return $next($request);
      });
  }
}
