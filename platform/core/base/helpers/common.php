<?php

use Bng\Base\Facades\AdminHelper;

if (! function_exists('platform_path')) {
    function platform_path(string|null $path = null): string
    {
        $path = ltrim($path, DIRECTORY_SEPARATOR);

        return base_path('platform' . ($path ? DIRECTORY_SEPARATOR . $path : ''));
    }
}

if (! function_exists('core_path')) {
    function core_path(string|null $path = null): string
    {
        return platform_path('core' . ($path ? DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR) : ''));
    }
}

if (! function_exists('is_in_admin')) {
    function is_in_admin(bool $force = false): bool
    {
        return AdminHelper::isInAdmin($force);
    }
}
