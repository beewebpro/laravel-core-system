<?php

namespace Bng\Acp\Models;

use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
  protected $table = 'user_meta';

  protected $fillable = [
    'key',
    'value',
    'user_id',
  ];
}
