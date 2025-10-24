<?php

namespace Bng\Acp\Forms;

use Bng\Acp\Http\Requests\CreateRoleRequest;
use Bng\Acp\Models\Role;
use Bng\Base\Facades\Assets;
use Bng\Base\Forms\FieldOptions\DescriptionFieldOption;
use Bng\Base\Forms\FieldOptions\NameFieldOption;
use Bng\Base\Forms\Fields\TextareaField;
use Bng\Base\Forms\Fields\TextField;
use Bng\Base\Forms\FormAbstract;
use Illuminate\Support\Arr;

class RoleForm extends FormAbstract
{
  public function setup(): void
  {
    Assets::addScriptsDirectly('vendor/core/core/acp/js/role.js');

    $active = [];
    $flags = Role::getPermissions();
    $children = $this->getPermissionTree($flags);

    $this
      ->model(Role::class)
      ->setUrl(route('users.store'))
      ->setValidatorClass(CreateRoleRequest::class)
      ->columns(1)
      ->add(
        'name',
        TextField::class,
        NameFieldOption::make()
          ->label(trans('core/base::base.forms.name'))
          ->required()
          ->maxLength(30)
          ->toArray()
      )
      ->add(
        'description',
        TextareaField::class,
        DescriptionFieldOption::make()
          ->toArray()
      )
      ->addMetaBoxes([
        'permissions' => [
          'title' => trans('core/acp::role.forms.permissions'),
          'content' => view('core/acp::roles.permissions', compact('active', 'flags', 'children'))->render(),
          'header_actions' => view('core/acp::roles.permissions-actions')->render(),
        ],
      ]);
  }

  protected function getPermissionTree(array $permissions): array
  {
    $sortedFlag = $permissions;
    sort($sortedFlag);
    $children['root'] = $this->getChildren('root', $sortedFlag);

    foreach (array_keys($permissions) as $key) {
      $childrenReturned = $this->getChildren($key, $permissions);
      if (count($childrenReturned) > 0) {
        $children[$key] = $childrenReturned;
      }
    }
    return $children;
  }

  protected function getChildren(string $parentFlag, array $flags): array
  {
    $newFlags = [];

    foreach ($flags as $item) {
      if (Arr::get($item, 'parent_flag', 'root') === $parentFlag) {
        $newFlags[] = $item['flag'];
      }
    }

    return $newFlags;
  }
}
