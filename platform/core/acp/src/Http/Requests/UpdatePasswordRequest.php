<?php

namespace Bng\Acp\Http\Requests;

use Bng\Support\Http\Requests\Request;

class UpdatePasswordRequest extends Request
{
  public function rules(): array
  {
    return [
      'password' => 'required|string|min:6|max:60|confirmed',
    ];
  }
}
