<?php

namespace Bng\Acp\Http\Controllers;

use Bng\Acp\Forms\RoleForm;
use Bng\Acp\Models\Role;
use Bng\Acp\Tables\RoleTable;
use Bng\Base\Http\Controllers\BaseSystemController;
use Bng\Base\Supports\Breadcrumb;

class RoleController extends BaseSystemController
{
  protected function breadcrumb(): Breadcrumb
  {
    return parent::breadcrumb()
      ->add(
        trans('core/acp::user.users'),
        route('roles.index')
      );
  }

  public function index(RoleTable $dataTable)
  {
    $this->pageTitle(trans('core/acp::user.users'));
    return $dataTable->renderTable();
  }

  public function edit(Role $role)
  {
    $this->pageTitle(trans('core/acl::permissions.details', ['name' => $role->name]));

    return RoleForm::createFromModel($role)->renderForm();
  }
}
