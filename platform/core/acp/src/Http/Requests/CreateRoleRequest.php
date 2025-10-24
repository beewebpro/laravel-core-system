<?php

namespace Bng\Acp\Http\Requests;

use Bng\Support\Http\Requests\Request;

class CreateRoleRequest extends Request
{
  public function rules(): array
  {
    return [
      'name' => ['required', 'string', 'max:120', 'min:3'],
      'description' => ['nullable', 'string', 'string', 'max:255'],
    ];
  }
}
