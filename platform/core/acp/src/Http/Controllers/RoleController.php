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

    return RoleForm::create()->renderForm();
  }

  public function edit(Role $role)
  {
    $this->pageTitle(trans('core/acl::permissions.details', ['name' => $role->name]));

    return RoleForm::createFromModel($role)->renderForm();
  }
}
