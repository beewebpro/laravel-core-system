<?php

namespace Bng\Base\Http\Controllers;

use Bng\Base\Supports\Breadcrumb;

class BaseSystemController extends BaseController
{
    protected function breadcrumb(): Breadcrumb
    {
        return parent::breadcrumb()
            ->add(
                trans('core/base::base.system'),
                route('system.index')
            );
    }
}
