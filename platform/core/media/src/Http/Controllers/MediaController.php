<?php

namespace Bng\Media\Http\Controllers;

use Bng\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class MediaController extends BaseController
{

  public function getMedia()
  {
    $this->pageTitle(trans('core/media::media.name'));

    return view('core/media::index');
  }

  public function getList(Request $request) {}
  public function getPopup(Request $request) {}
  public function download(Request $request) {}
  public function store(Request $request) {}
}
