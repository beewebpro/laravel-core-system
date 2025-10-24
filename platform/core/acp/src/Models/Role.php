<?php

namespace Bng\Acp\Models;

use Bng\Acp\Traits\HasPermissions;
use Bng\Base\Facades\BaseHelper;
use Bng\Base\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends BaseModel
{
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

  public function users(): BelongsToMany
  {
    return $this->belongsToMany(User::class, 'role_users', 'role_id', 'user_id');
  }

  public function author(): BelongsTo
  {
    return $this->belongsTo(User::class, 'created_by')->withDefault();
  }
}
