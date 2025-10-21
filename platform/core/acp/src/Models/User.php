<?php

namespace Bng\Acp\Models;

use Bng\Acp\Contracts\HasPermissions as HasPermissionsContract;
use Bng\Acp\Traits\PermissionTrait;
use Bng\Base\Models\BaseModel;
use Bng\Base\Supports\Avatar;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Throwable;

class User extends BaseModel implements HasPermissionsContract, AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
  use Authenticatable;
  use Authorizable;
  use CanResetPassword;
  use PermissionTrait {
    PermissionTrait::hasPermission as traitHasPermission;
    PermissionTrait::hasAnyPermission as traitHasAnyPermission;
  }

  protected $table = 'users';

  protected $fillable = [
    'username',
    'email',
    'name',
    'password',
    'avatar_id',
    'permissions',
  ];

  protected $hidden = [
    'password',
    'remember_token',
  ];

  public function getAuthIdentifierName()
  {
    return 'id';
  }

  public function roles(): BelongsToMany
  {
    return $this
      ->belongsToMany(Role::class, 'role_users', 'user_id', 'role_id');
  }

  protected function activated(): Attribute
  {
    return Attribute::get(fn(): bool => $this->activations()->where('completed', true)->exists());
  }

  public function activations(): HasMany
  {
    return $this->hasMany(Activation::class, 'user_id');
  }

  public function isSuperUser(): bool
  {
    return $this->super_user || $this->traitHasPermission('superuser');
  }

  public function hasPermission(string|array $permissions): bool
  {
    if ($this->isSuperUser()) {
      return true;
    }

    return $this->traitHasPermission($permissions);
  }

  public function hasAnyPermission(string|array $permissions): bool
  {
    if ($this->isSuperUser()) {
      return true;
    }

    return $this->traitHasAnyPermission($permissions);
  }

  protected function avatarUrl(): Attribute
  {
    return Attribute::get(function () {
      if ($this->avatar && $this->avatar->url) {
        return 'aaa';
      }

      try {
        return Avatar::createBase64Image($this->name);
      } catch (Throwable) {
        return 'aaaa';
      }
    });
  }
}
