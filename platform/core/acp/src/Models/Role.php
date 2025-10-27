<?php

namespace Bng\Acp\Models;

use Bng\Acp\Traits\HasPermissions;
use Bng\Base\Models\BaseModel;
use Bng\Base\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends BaseModel
{
  use HasSlug;
  use HasPermissions;

  protected $table = 'roles';

  protected $fillable = [
    'name',
    'slug',
    'permissions',
    'description',
    'is_default',
    'created_by',
    'updated_by',
  ];

  protected $casts = [
    'permissions' => 'json',
    'is_default' => 'bool',
  ];

  protected static function booted(): void
  {
    self::saving(function (self $model): void {
      $model->slug = self::createSlug($model->slug ?: $model->name, $model->getKey());
    });
  }

  public function users(): BelongsToMany
  {
    return $this->belongsToMany(User::class, 'role_users', 'role_id', 'user_id');
  }

  public function author(): BelongsTo
  {
    return $this->belongsTo(User::class, 'created_by')->withDefault();
  }
}
