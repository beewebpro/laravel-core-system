<?php

namespace Bng\Acp\Enums;

use Bng\Base\Facades\Html;
use Bng\Base\Supports\Enum;
use Illuminate\Support\HtmlString;

class UserStatusEnum extends Enum
{
  public const ACTIVATED = 'activated';
  public const DEACTIVATED = 'deactivated';

  public static $langPath = 'core/acp::user.statuses';

  public function toHtml(): HtmlString|string
  {
    return match ($this->value) {
      self::ACTIVATED => Html::tag('span', self::ACTIVATED()->label(), ['class' => 'badge rounded-pill font-size-12 badge-soft-success']),
      self::DEACTIVATED => Html::tag('span', self::DEACTIVATED()->label(), ['class' => 'badge rounded-pill font-size-12 badge-soft-warning']),
      default => parent::toHtml(),
    };
  }
}
