<?php

namespace Bng\Media;

use Bng\Media\Services\ThumbnailService;
use Bng\Media\Services\UploadsManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class Media
{
  protected array $permissions = [];

  public function __construct(protected UploadsManager $uploadManager, protected ThumbnailService $thumbnailService)
  {
    $this->permissions = $this->getConfig('permissions', []);
  }

  public function getConfig(?string $key = null, string|null|array $default = null)
  {
    $configs = config('core.media.media');

    if (! $key) {
      return $configs;
    }

    return Arr::get($configs, $key, $default);
  }

  public function getUrls(): array
  {
    return [
      'base_url' => url(''),
      'base' => route('media.index'),
      'get_media' => route('media.list'),
      'create_folder' => route('media.folders.create'),
      'popup' => route('media.popup'),
      'download' => route('media.download'),
      'upload_file' => route('media.files.upload'),
      'get_breadcrumbs' => route('media.breadcrumbs'),
      'global_actions' => route('media.global_actions'),
      'media_upload_from_editor' => route('media.files.upload.from.editor'),
      'download_url' => route('media.download_url'),
    ];
  }

  public function renderHeader(): string
  {
    $urls = $this->getUrls();

    return view('core/media::header', compact('urls'))->render();
  }

  public function renderFooter(): string
  {
    return view('core/media::footer')->render();
  }

  public function renderContent(): string
  {
    $sorts = [
      'name-asc' => [
        'label' => trans('core/media::media.file_name_asc'),
        'icon' => 'ti ti-sort-ascending-letters',
      ],
      'name-desc' => [
        'label' => trans('core/media::media.file_name_desc'),
        'icon' => 'ti ti-sort-descending-letters',
      ],
      'created_at-asc' => [
        'label' => trans('core/media::media.uploaded_date_asc'),
        'icon' => 'ti ti-sort-ascending-numbers',
      ],
      'created_at-desc' => [
        'label' => trans('core/media::media.uploaded_date_desc'),
        'icon' => 'ti ti-sort-descending-numbers',
      ],
      'size-asc' => [
        'label' => trans('core/media::media.size_asc'),
        'icon' => 'ti ti-sort-ascending-2',
      ],
      'size-desc' => [
        'label' => trans('core/media::media.size_desc'),
        'icon' => 'ti ti-sort-descending-2',
      ],
    ];

    return view('core/media::content', compact('sorts'))->render();
  }

  public function getPermissions(): array
  {
    return $this->permissions;
  }

  public function setPermissions(array $permissions): void
  {
    $this->permissions = $permissions;
  }

  public function removePermission(string $permission): void
  {
    Arr::forget($this->permissions, $permission);
  }

  public function addPermission(string $permission): void
  {
    $this->permissions[] = $permission;
  }

  public function hasPermission(string $permission): bool
  {
    return in_array($permission, $this->permissions);
  }

  public function hasAnyPermission(array $permissions): bool
  {
    $hasPermission = false;
    foreach ($permissions as $permission) {
      if (in_array($permission, $this->permissions)) {
        $hasPermission = true;

        break;
      }
    }

    return $hasPermission;
  }

  public function getDefaultImage(bool $relative = false, string|null $size = null): string
  {
    $default = $this->getConfig('default_image');

    if ($placeholder = 1) {
      $filename = pathinfo($placeholder, PATHINFO_FILENAME);

      if ($size && $size = $this->getSize($size)) {
        $placeholder = str_replace($filename, $filename . '-' . $size, $placeholder);
      }

      return Storage::url($placeholder);
    }

    if ($relative) {
      return $default;
    }

    return $default ? url($default) : $default;
  }

  public function getSize(string $name): string|null
  {
    return Arr::get($this->getSizes(), $name);
  }

  public function getSizes(): array
  {
    $sizes = $this->getConfig('sizes', []);

    foreach ($sizes as $name => $size) {
      $size = explode('x', $size);

      $settingName = 'media_sizes_' . $name;

      $width = 500;

      $height = 500;

      if (! $width && ! $height) {
        continue;
      }

      if (! $width) {
        $width = 'auto';
      }

      if (! $height) {
        $height = 'auto';
      }

      $sizes[$name] = $width . 'x' . $height;
    }

    return $sizes;
  }

  public function responseSuccess(array $data, ?string $message = null): JsonResponse
  {
    return response()->json([
      'error' => false,
      'data' => $data,
      'message' => $message,
    ]);
  }

  public function responseError(
    string $message,
    array $data = [],
    ?int $code = null,
    int $status = 200
  ): JsonResponse {
    return response()->json([
      'error' => true,
      'message' => $message,
      'data' => $data,
      'code' => $code,
    ], $status);
  }
}
