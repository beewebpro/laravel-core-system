<?php

namespace Bng\Acp\Traits;

use Bng\Base\Facades\BaseHelper;

trait HasPermissions
{
  public static function getPermissions(): array
  {
    $permissions = [];

    $types = ['core', 'packages', 'plugins'];

    foreach ($types as $type) {
      foreach (BaseHelper::scanFolder(platform_path($type)) as $module) {
        $configuration = config(strtolower($type . '.' . $module . '.permissions'));
        if (! empty($configuration)) {
          foreach ($configuration as $config) {
            $permissions[$config['flag']] = $config;
          }
        }
      }
    }
    return apply_filters('core_acp_role_permissions', $permissions);
  }
}
