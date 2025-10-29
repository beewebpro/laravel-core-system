<?php

namespace Bng\Acp\Http\Controllers;

use Bng\Acp\Forms\RoleForm;
use Bng\Acp\Http\Requests\CreateRoleRequest;
use Bng\Acp\Models\Role;
use Bng\Acp\Tables\RoleTable;
use Bng\Base\Http\Controllers\BaseSystemController;
use Bng\Base\Supports\Breadcrumb;
use Illuminate\Http\Request;

class RoleController extends BaseSystemController
{
  protected function breadcrumb(): Breadcrumb
  {
    return parent::breadcrumb()
      ->add(
        trans('core/acp::role.roles'),
        route('roles.index')
      );
  }

  public function index(RoleTable $dataTable)
  {
    $this->pageTitle(trans('core/acp::role.roles'));
    return $dataTable->renderTable();
  }

  public function create()
  {
    $this->pageTitle(trans('core/base::base.create_new'));

    return RoleForm::create()->setUrl(route('roles.store'))->renderForm();
  }

  public function store(CreateRoleRequest $request)
  {
    $role = Role::query()->create([
      'name' => $request->input('name'),
      'permissions' => $this->cleanPermission((array) $request->input('flags', [])),
      'description' => $request->input('description'),
      'created_by' => $request->user()->getKey(),
      'updated_by' => $request->user()->getKey(),
    ]);

    return $this
      ->httpResponse()
      ->setPreviousRoute('roles.index')
      ->setNextRoute('roles.edit', $role->getKey())
      ->withCreatedSuccessMessage();
  }

  public function edit(Role $role)
  {
    $this->pageTitle(trans('core/acp::role.forms.permissions', ['name' => $role->name]));

    return RoleForm::createFromModel($role)->setUrl(route('roles.update', $role->getKey()))->setMethod('PUT')->renderForm();
  }

  public function update(Role $role, CreateRoleRequest $request)
  {
    $role->name = $request->input('name');
    $role->description = $request->input('description');
    $role->updated_by = $request->user()->getKey();
    $role->permissions = $this->cleanPermission((array) $request->input('flags', []));
    $role->save();

    return $this
      ->httpResponse()
      ->setPreviousRoute('roles.index')
      ->setNextRoute('roles.edit', $role->getKey())
      ->withUpdatedSuccessMessage();
  }

  public function getRoles(Request $request)
  {
    $roles = Role::query()->get(['id', 'name']);

    return $this->httpResponse()->setData($roles)->toApiResponse();
  }

  protected function cleanPermission(array $permissions): array
  {
    if (! $permissions) {
      return [];
    }

    $cleanedPermissions = [];
    foreach ($permissions as $permissionName) {
      $cleanedPermissions[$permissionName] = true;
    }

    return $cleanedPermissions;
  }
}
