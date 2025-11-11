<?php

namespace Bng\Media\Models;

use Bng\Base\Models\BaseModel;
use Bng\Media\Facades\Media;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class MediaFolder extends BaseModel
{
  use SoftDeletes;

  protected $table = 'media_folders';

  protected $fillable = [
    'name',
    'slug',
    'parent_id',
    'user_id',
    'color',
  ];

  public static function createSlug(string $name, int|string|null $parentId): string
  {
    $slug = Str::slug($name, '-', ! 1 ? 'en' : false);
    $index = 1;
    $baseSlug = $slug;
    while (self::query()->where('slug', $slug)->where('parent_id', $parentId)->withTrashed()->exists()) {
      $slug = $baseSlug . '-' . $index++;
    }

    return $slug;
  }

  public static function createName(string $name, int|string|null $parentId): string
  {
    $newName = $name;
    $index = 1;
    $baseSlug = $newName;
    while (self::query()->where('name', $newName)->where('parent_id', $parentId)->withTrashed()->exists()) {
      $newName = $baseSlug . '-' . $index++;
    }

    return $newName;
  }
}
