<?php

namespace Bng\Acp\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
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
}
