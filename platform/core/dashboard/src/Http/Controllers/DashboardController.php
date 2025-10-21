<?php

namespace Bng\Dashboard\Http\Controllers;

use Bng\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class DashboardController extends BaseController
{
  public function getDashboard(Request $request)
  {
    $this->pageTitle(trans('core/dashboard::dashboard.title'));
    return view('core/dashboard::index');
  }
}
