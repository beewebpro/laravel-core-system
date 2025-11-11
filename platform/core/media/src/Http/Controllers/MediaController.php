<?php

namespace Bng\Media\Http\Controllers;

use Bng\Base\Facades\Assets;
use Bng\Base\Http\Controllers\BaseController;
use Bng\Media\Models\MediaFolder;
use Illuminate\Http\Request;

class MediaController extends BaseController
{

  public function getMedia()
  {
    $this->pageTitle(trans('core/media::media.name'));
    Assets::initVueJS();
    Assets::addScriptsDirectly('vendor/core/core/media/js/media.js?t=' . time());

    return view('core/media::index');
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

    $data = [
      'files' => $files,
      'folders' => $folders,
    ];
    return response()->json([
      'error' => false,
      'data' => $data,
      'message' => $message,
    ]);
  }
  public function getPopup(Request $request) {}
  public function download(Request $request) {}
  public function store(Request $request) {}
}
