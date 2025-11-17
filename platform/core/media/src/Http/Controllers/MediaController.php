<?php

namespace Bng\Media\Http\Controllers;

use Bng\Base\Facades\Assets;
use Bng\Base\Http\Controllers\BaseController;
use Bng\Media\Facades\Media;
use Bng\Media\Models\MediaFolder;
use Illuminate\Http\Request;

class MediaController extends BaseController
{

  public function getMedia(Request $request)
  {
    $this->pageTitle(trans('core/media::media.name'));
    Assets::initVueJS();
    Assets::addScriptsDirectly('vendor/core/core/media/js/media.js?t=' . time());

    $files = [];
    $folders = [];
    $folderId = $request->input('folder_id', 0);

    $folders = MediaFolder::query()
      ->where('parent_id', $folderId)
      ->orderBy('created_at', 'desc')
      ->get();

    return view('core/media::index', compact('folders'));
  }

  public function getList(Request $request)
  {
    $files = [];
    $folders = [];
    $message = null;

    $folderId = $request->input('folder_id', 0);

    $folders = MediaFolder::query()
      ->where('parent_id', $folderId)
      ->orderBy('created_at', 'desc')
      ->get();

    return Media::responseSuccess([
      'files' => $files,
      'folders' => $folders,
    ]);
  }

  public function getPopup(Request $request) {}
  public function download(Request $request) {}
  public function store(Request $request) {}
}
