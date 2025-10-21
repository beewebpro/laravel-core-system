<?php

namespace Bng\Acp\Http\Requests;

use Bng\Acp\Models\User;
use Bng\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends Request
{
  public function rules(): array
  {
    return [
      'username' => ['required', 'string', 'min:4', 'max:30', Rule::unique((new User())->getTable(), 'username')->ignore($this->user)],
      'name' => ['required', 'string', 'max:60', 'min:2'],
      'email' => ['required', 'max:60', 'min:6', Rule::unique((new User())->getTable(), 'email')->ignore($this->user)],
    ];
  }
}
