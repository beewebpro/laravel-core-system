<?php

namespace Bng\Base\Http\Controllers\Concerns;

use Bng\Base\Http\Responses\BaseHttpResponse;

trait HasHttpResponse
{
  public function httpResponse(): BaseHttpResponse
  {
    return BaseHttpResponse::make();
  }
}
