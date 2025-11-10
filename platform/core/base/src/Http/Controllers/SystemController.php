<?php

namespace Bng\Base\Http\Controllers;

use Bng\Base\Facades\Assets;

class SystemController extends BaseSystemController
{
    public function index()
    {
        $this->pageTitle(trans('core/base::base.system'));

        return view('core/base::system.index');
    }
}
