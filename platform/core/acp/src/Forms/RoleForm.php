<?php

namespace Bng\Acp\Forms;

use Bng\Base\Facades\Assets;
use Bng\Base\Forms\FormAbstract;

class RoleForm extends FormAbstract
{
  public function setup(): void
  {
    Assets::addScriptsDirectly('vendor/core/core/acp/js/role.js');
  }
}
