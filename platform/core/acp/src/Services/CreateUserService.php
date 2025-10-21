<?php

namespace Bng\Acp\Services;

use Bng\Acp\Events\RoleAssignmentEvent;
use Bng\Acp\Models\Role;
use Bng\Acp\Models\User;
use Bng\Support\Services\ProduceServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CreateUserService implements ProduceServiceInterface
{
  public function __construct(protected ActivateUserService $activateUserService) {}

  public function execute(Request $request): User
  {
    $user = new User();
    $user->fill($request->input());
    $user->password = Hash::make($request->input('password'));
    $user->save();

    if (
      $this->activateUserService->activate($user) &&
      ($roleId = $request->input('role_id')) &&
      $role = Role::query()->find($roleId)
    ) {
      /**
       * @var Role $role
       */
      $role->users()->attach($user->getKey());

      event(new RoleAssignmentEvent($role, $user));
    }

    return $user;
  }
}
