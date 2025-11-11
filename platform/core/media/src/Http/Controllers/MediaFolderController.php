<?php

namespace Bng\Media\Http\Controllers;

use Bng\Base\Http\Controllers\BaseController;
use Bng\Media\Facades\Media;
use Bng\Media\Models\MediaFolder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MediaFolderController extends BaseController
{
  public function store(Request $request)
  {
    try {
      $name = $request->input('name');
      $parentId = $request->input('parent_id');

      MediaFolder::query()->create([
        'name' => MediaFolder::createName($name, $parentId),
        'slug' => MediaFolder::createSlug($name, $parentId),
        'parent_id' => $parentId,
        'user_id' => Auth::guard()->id(),
      ]);

      return Media::responseSuccess([], trans('core/media::media.folder_created'));
    } catch (Exception $exception) {
      return Media::responseError($exception->getMessage());
    }
  }
}
