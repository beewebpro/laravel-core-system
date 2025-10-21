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

class UserForm extends FormAbstract
{
  public function setup(): void
  {
    $roles = Role::query()->pluck('name', 'id');

    $defaultRole = $roles->where('is_default', 1)->first();

    $this
      ->model(User::class)
      ->setUrl(route('users.store'))
      ->setValidatorClass(CreateUserRequest::class)
      ->columns(4)
      ->add(
        'name',
        TextField::class,
        TextFieldOption::make()
          ->label(trans('core/acp::user.name'))
          ->required()
          ->maxLength(30)
          ->colspan(1)
          ->toArray()
      )
      ->add(
        'username',
        TextField::class,
        TextFieldOption::make()
          ->label(trans('core/acp::user.username'))
          ->required()
          ->maxLength(30)
          ->colspan(1)
          ->toArray()
      )
      ->add('email', TextField::class, EmailFieldOption::make()->required()->colspan(2)->toArray())
      ->add(
        'password',
        'password',
        TextFieldOption::make()
          ->label(trans('core/acp::user.password'))
          ->required()
          ->maxLength(60)
          ->colspan(2)
          ->toArray()
      )
      ->add(
        'password_confirmation',
        'password',
        TextFieldOption::make()
          ->label(trans('core/acp::user.password_confirmation'))
          ->required()
          ->maxLength(60)
          ->colspan(2)
          ->toArray()
      )
      ->add(
        'role_id',
        SelectField::class,
        SelectFieldOption::make()
          ->label(trans('core/acp::user.role'))
          ->addAttribute('class', 'form-select')
          ->choices(['' => trans('core/acp::user.select_role')] + $roles->all())
          ->when($defaultRole, fn(SelectFieldOption $option) => $option->selected($defaultRole->id))
          ->toArray()
      )
      ->setBreakFieldPoint('role_id')
      ->add('status', 'customSelect', [
        'label' => trans('core/acp::user.status'),
        'label_attr' => ['class' => 'control-label'],
        'attr' => [
          'class' => 'form-select',
        ],
        'choices'    => UserStatusEnum::labels(),
        'selected' => $this->getModel()->getKey() ? ($this->getModel()->activations()->where('completed', true)->exists() ? UserStatusEnum::ACTIVATED : UserStatusEnum::DEACTIVATED) : '',
      ]);
  }
}
