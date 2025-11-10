<?php

namespace Bng\Base\Supports;

use Illuminate\Config\Repository;
use Illuminate\Support\Arr;

class Assets
{
  protected array $config;

  protected HtmlBuilder $htmlBuilder;

  protected array $scripts = [];

  protected array $styles = [];

  protected array $appendedScripts = [
    'header' => [],
    'footer' => [],
  ];

  protected array $appendedStyles = [];

  protected string $build = '';

  protected bool $hasVueJs = false;

  public const ASSETS_SCRIPT_POSITION_HEADER = 'header';

  public const ASSETS_SCRIPT_POSITION_FOOTER = 'footer';

  public function __construct(Repository $config, HtmlBuilder $htmlBuilder)
  {
    $this->config = $config->get('core.base.assets');
    $this->scripts = $this->config['scripts'];

    $this->styles = $this->config['styles'];

    $this->htmlBuilder = $htmlBuilder;
  }

  public function addScriptsDirectly(
    array|string $assets,
    string $location = self::ASSETS_SCRIPT_POSITION_FOOTER,
    array $attributes = []
  ): static {
    foreach ((array) $assets as &$item) {
      $item = ltrim(trim($item), '/');

      if (! in_array($item, $this->appendedScripts[$location])) {
        $this->appendedScripts[$location][$item] = [
          'src' => $item,
          'attributes' => $attributes,
        ];
      }
    }

    return $this;
  }

  public function renderHeader(array $lastStyles = []): string
  {
    $styles = $this->getStyles($lastStyles);

    $headScripts = $this->getScripts(self::ASSETS_SCRIPT_POSITION_HEADER);

    return view('core/base::assets.header', compact('styles', 'headScripts'))->render();
  }

  public function renderFooter(): string
  {
    $bodyScripts = $this->getScripts(self::ASSETS_SCRIPT_POSITION_FOOTER);

    return view('core/base::assets.footer', compact('bodyScripts'))->render();
  }

  public function getStyles(array $lastStyles = []): array
  {
    $styles = [];
    if (! empty($lastStyles)) {
      $this->styles = array_merge($this->styles, $lastStyles);
    }

    $this->styles = array_unique($this->styles);

    foreach ($this->styles as $style) {
      $configName = 'resources.styles.' . $style;

      $styles = array_merge($styles, $this->getSource($configName));
    }

    return array_merge($styles, $this->appendedStyles);
  }

  public function getScripts(?string $location = null): array
  {
    $scripts = [];

    $this->scripts = array_unique($this->scripts);

    foreach ($this->scripts as $script) {
      $configName = 'resources.scripts.' . $script;

      if (! empty($location) && $location !== Arr::get($this->config, $configName . '.location')) {
        continue; // Skip assets that don't match this location
      }

      $scripts = array_merge($scripts, $this->getScriptItem($location, $configName, $script));
    }

    return array_merge($scripts, Arr::get($this->appendedScripts, $location, []));
  }

  protected function getScriptItem(string $location, string $configName, string $script): array
  {
    $scripts = $this->getSource($configName, $location);

    if (Arr::get($this->config, $configName . '.include_style')) {
      $this->addStyles([$script]);
    }

    return $scripts;
  }

  public function addStyles(array|string $assets): static
  {
    $this->styles = array_merge($this->styles, (array) $assets);

    return $this;
  }

  protected function getSource(string $configName, ?string $location = null): array
  {
    $isUsingCdn = $this->isUsingCdn($configName);

    $attributes = $isUsingCdn ? [] : Arr::get($this->config, $configName . '.attributes', []);

    $src = $this->getSourceUrl($configName);

    $scripts = [];

    foreach ((array) $src as $s) {
      if (! $s) {
        continue;
      }

      $scripts[] = [
        'src' => $s,
        'attributes' => $attributes,
      ];
    }

    if (
      empty($src) &&
      $isUsingCdn &&
      $location === self::ASSETS_SCRIPT_POSITION_HEADER &&
      Arr::has($this->config, $configName . '.fallback')
    ) {
      $scripts[] = [
        'src' => $src,
        'fallback' => Arr::get($this->config, $configName . '.fallback'),
        'fallbackURL' => Arr::get($this->config, $configName . '.src.local'),
      ];
    }

    return $scripts;
  }

  protected function isUsingCdn(string $configName): bool
  {
    return Arr::get($this->config, $configName . '.use_cdn', false) && ! $this->config['offline'];
  }

  protected function getSourceUrl(string $configName)
  {
    if (! Arr::has($this->config, $configName)) {
      return '';
    }

    $src = Arr::get($this->config, $configName . '.src.local');

    if ($this->isUsingCdn($configName)) {
      $src = Arr::get($this->config, $configName . '.src.cdn');
    }

    return $src;
  }

  public function getHtmlBuilder(): HtmlBuilder
  {
    return $this->htmlBuilder;
  }

  public function getBuildVersion(): string
  {
    return $this->build = $this->config['enable_version'] ? '?v=' . $this->config['version'] : '';
  }

  public function initVueJS(): self
  {
    $this->addScripts(['vue-init']);

    $this->hasVueJs = true;

    return $this;
  }

  public function addScripts(array|string $assets): static
  {
    $this->scripts = array_merge($this->scripts, (array) $assets);

    return $this;
  }
}
