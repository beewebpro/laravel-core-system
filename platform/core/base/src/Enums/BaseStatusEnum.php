<?php

namespace Bng\Base\Enums;

use Bng\Base\Facades\Html;
use Bng\Base\Supports\Enum;
use Illuminate\Support\HtmlString;

class BaseStatusEnum extends Enum
{
  public const PUBLISHED = 'published';
  public const DRAFT = 'draft';
  public const PENDING = 'pending';

  public static $langPath = 'core/base::enums.statuses';

  public function toHtml(): string|HtmlString
  {
    return match ($this->value) {
      self::DRAFT => Html::tag('span', self::DRAFT()->label(), ['class' => 'badge bg-secondary text-secondary-fg']),
      self::PENDING => Html::tag('span', self::PENDING()->label(), ['class' => 'badge bg-warning text-warning-fg']),
      self::PUBLISHED => Html::tag('span', self::PUBLISHED()->label(), ['class' => 'badge bg-success text-success-fg']),
      default => parent::toHtml(),
    };
  }
}
