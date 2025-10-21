<?php

namespace Bng\Acp\Http\Requests;

use Bng\Acp\Models\User;
use Bng\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class CreateUserRequest extends Request
{
  public function rules(): array
  {
    return [
      'name' => ['required', 'string', 'max:60', 'min:2'],
      'email' => [
        'required',
        'min:6',
        'max:60',
        'email',
        Rule::unique((new User())->getTable(), 'email'),
      ],
      'password' => ['required', 'string', 'min:6', 'confirmed'],
      'username' => [
        'required',
        'string',
        'alpha_dash',
        'min:4',
        'max:30',
        Rule::unique((new User())->getTable(), 'username'),
      ],
    ];
  }
}
