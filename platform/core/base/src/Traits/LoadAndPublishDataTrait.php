<?php

namespace Bng\Base\Traits;

use Bng\Base\Supports\Helper;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use ReflectionClass;

trait LoadAndPublishDataTrait
{
  protected string|null $namespace = null;

  protected function setNamespace(string $namespace): self
  {
    $this->namespace = ltrim(rtrim($namespace, '/'), '/');

    $this->app['config']->set(['core.base.general.plugin_namespaces.' . File::basename($this->getPath()) => $namespace]);

    return $this;
  }

  protected function getPath(string $path = null): string
  {
    $reflection = new ReflectionClass($this);

    $modulePath = str_replace('/src/Providers', '', File::dirname($reflection->getFilename()));

    if (! Str::contains($modulePath, base_path('platform/plugins'))) {
      $modulePath = base_path('platform/' . $this->getDashedNamespace());
    }

    return $modulePath . ($path ? '/' . ltrim($path, '/') : '');
  }

  protected function getDashedNamespace(): string
  {
    return str_replace('.', '/', $this->namespace);
  }

  protected function getDotedNamespace(): string
  {
    return str_replace('/', '.', $this->namespace);
  }

  protected function loadRoutes(array|string $fileNames = ['web']): self
  {
    if (! is_array($fileNames)) {
      $fileNames = [$fileNames];
    }

    foreach ($fileNames as $fileName) {
      $this->loadRoutesFrom($this->getRouteFilePath($fileName));
    }

    return $this;
  }

  protected function getRouteFilePath(string $file): string
  {
    return $this->getPath('routes/' . $file . '.php');
  }

  protected function loadAndPublishViews(): self
  {
    $this->loadViewsFrom($this->getViewsPath(), $this->getDashedNamespace());
    if ($this->app->runningInConsole()) {
      $this->publishes(
        [$this->getViewsPath() => resource_path('views/vendor/' . $this->getDashedNamespace())],
        'cms-views'
      );
    }

    return $this;
  }

  protected function getViewsPath(): string
  {
    return $this->getPath('/resources/views');
  }

  protected function publishAssets(string $path = null): self
  {
    if (empty($path)) {
      $path = 'vendor/core/' . $this->getDashedNamespace();
    }

    $this->publishes([$this->getAssetsPath() => public_path($path)], 'bng-public');

    return $this;
  }

  protected function getAssetsPath(): string
  {
    return $this->getPath('public');
  }

  public function loadAndPublishTranslations(): self
  {
    $this->loadTranslationsFrom($this->getTranslationsPath(), $this->getDashedNamespace());
    $this->publishes(
      [$this->getTranslationsPath() => lang_path('vendor/' . $this->getDashedNamespace())],
      'bng-lang'
    );

    return $this;
  }

  protected function getTranslationsPath(): string
  {
    return $this->getPath('/resources/lang');
  }

  protected function loadMigrations(): self
  {
    $this->loadMigrationsFrom($this->getMigrationsPath());

    return $this;
  }

  protected function getMigrationsPath(): string
  {
    return $this->getPath('/database/migrations');
  }

  protected function loadHelpers(): self
  {
    Helper::autoload($this->getPath('/helpers'));

    return $this;
  }

  protected function loadAndPublishConfigurations(array|string $fileNames): static
  {
    if (! is_array($fileNames)) {
      $fileNames = [$fileNames];
    }

    foreach ($fileNames as $fileName) {
      $this->mergeConfigFrom($this->getConfigFilePath($fileName), $this->getDotedNamespace() . '.' . $fileName);

      if ($this->app->runningInConsole()) {
        $this->publishes([
          $this->getConfigFilePath($fileName) => config_path($this->getDashedNamespace() . '/' . $fileName . '.php'),
        ], 'bng-config');
      }
    }

    return $this;
  }

  protected function getConfigFilePath(string $file): string
  {
    return $this->getPath('config/' . $file . '.php');
  }
}
