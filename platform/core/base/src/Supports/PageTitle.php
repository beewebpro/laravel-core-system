<?php

namespace Bng\Base\Supports;

class PageTitle
{
  protected string $title;

  protected string $siteName;

  protected string $separator = '|';

  public function setSiteName(string $siteName): void
  {
    $this->siteName = $siteName;
  }

  public function setSeparator(string $separator): void
  {
    $this->separator = $separator;
  }

  public function setTitle(string $title): void
  {
    $this->title = $title;
  }

  public function getTitle(bool $withSiteName = true): string|null
  {
    $siteName = $this->siteName ?? '';

    if (empty($this->title)) {
      return $siteName;
    }

    if (! $withSiteName) {
      return $this->title;
    }

    return implode(' ', [$this->title, $this->separator, $siteName]);
  }
}
