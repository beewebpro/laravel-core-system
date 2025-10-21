<?php

use Bng\Base\Facades\Action;
use Bng\Base\Facades\Filter;

if (! function_exists('apply_filters')) {
  function apply_filters(...$args)
  {
    return Filter::fire(array_shift($args), $args);
  }
}

if (! function_exists('add_action')) {
  function add_action(
    string|array|null $hook,
    string|array|Closure $callback,
    int $priority = 20,
    int $arguments = 1
  ): void {
    Action::addListener($hook, $callback, $priority, $arguments);
  }
}

if (! function_exists('do_action')) {
  function do_action(...$args): void
  {
    Action::fire(array_shift($args), $args);
  }
}
