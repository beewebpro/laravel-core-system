<?php

namespace Bng\Acp\Forms;

use Bng\Acp\Enums\UserStatusEnum;
use Bng\Acp\Http\Requests\CreateUserRequest;
use Bng\Acp\Models\Role;
use Bng\Acp\Models\User;
use Bng\Base\Forms\FieldOptions\EmailFieldOption;
use Bng\Base\Forms\FieldOptions\SelectFieldOption;
use Bng\Base\Forms\FieldOptions\TextFieldOption;
use Bng\Base\Forms\Fields\SelectField;
use Bng\Base\Forms\Fields\TextField;
use Bng\Base\Forms\FormAbstract;

class ChangePasswordForm extends FormAbstract
{
  public function setup(): void
  {
    $roles = Role::query()->pluck('name', 'id');

    $defaultRole = $roles->where('is_default', 1)->first();

    $this
      ->model(User::class)
      ->template('core/base::forms.form-no-wrap')
      ->setFormOption('id', 'change-password-form')
      ->setValidatorClass(CreateUserRequest::class)
      ->setMethod('PUT')
      ->columns(4)
      ->add(
        'password',
        'password',
        TextFieldOption::make()
          ->label(trans('core/acp::user.new_password'))
          ->required()
          ->maxLength(60)
          ->toArray()
      )
      ->add(
        'password_confirmation',
        'password',
        TextFieldOption::make()
          ->label(trans('core/acp::user.confirm_new_password'))
          ->required()
          ->maxLength(60)
          ->toArray()
      )
      ->setActionButtons(view('core/acp::users.actions.actions')->render());
  }
}
