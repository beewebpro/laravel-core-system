<?php

namespace Bng\Media\Models;

use Bng\Base\Models\BaseModel;

class MediaFile extends BaseModel
{
  protected $table = 'media_files';

  protected $fillable = [
    'name',
    'mime_type',
    'type',
    'size',
    'url',
    'options',
    'folder_id',
    'user_id',
    'alt',
    'visibility',
  ];

  protected $casts = [
    'options' => 'json',
  ];
}
